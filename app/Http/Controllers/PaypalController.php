<?php

namespace App\Http\Controllers;

use App\Models\PayPal\Package;
use App\Models\PayPal\PaypalAgreement;
use App\Models\PayPal\Plan;
use App\Models\PayPal\Product;
use App\NewClient;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    public $context;

    public function getApiContext()
    {
        return $apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_CLIENT_SECRET')
            )
        );
    }

    public function getToken()
    {
        $response = Http::withBasicAuth(env('PAYPAL_CLIENT_ID'), env('PAYPAL_CLIENT_SECRET'))
            ->asForm()
            ->post(env('PAYPAL_MODE') . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);
        $responseDecode = json_decode($response);
        return $token = $responseDecode->token_type . ' ' . $responseDecode->access_token;
    }

    public function createProduct()
    {
        $p_name = "Mymotivz product 5";
        $p_details = "this is Mymotivz product 5 description";
        $p_type = "SERVICE";
        $P_category = "SOFTWARE";
        $url = env('APP_URL');
        $createProduct = Http::withHeaders(
            [
                'Content-type' => 'application/json',
                'Authorization' => $this->getToken(),
            ]
        )->post(env('PAYPAL_MODE') . '/v1/catalogs/products',
            [
                'name' => $p_name,
                'description' => $p_details,
                'type' => $p_type,
                'category' => $P_category,
                'home_url' => $url,
            ]
        );
        dd(json_decode($createProduct));
//        return json_decode($createProduct);
    }

    public function createPlan()
    {
        $productId = 'PROD-60526952HD3017901';
        $name = 'office Plan 5';
        $description = 'this is office Plan 5 description';
        $interval = 'month';
        $intervalCount = '1';
        $price = '100';
        $plan = Http::withHeaders(
            [
                "Accept" => "application/json",
                "Authorization" => $this->getToken(),
                "Content-Type" => "application/json",
            ])
            ->post(env('PAYPAL_MODE') . '/v1/billing/plans',
                array(
                    'product_id' => $productId,
                    'name' => $name,
                    'description' => $description,
                    'status' => 'Active',
                    'billing_cycles' =>
                        array(
                            0 =>
                                array(
                                    'frequency' =>
                                        array(
                                            'interval_unit' => strtoupper($interval),
                                            'interval_count' => $intervalCount,
                                        ),
                                    'tenure_type' => 'REGULAR',
                                    'sequence' => 1,
                                    'total_cycles' => 0,
                                    'pricing_scheme' =>
                                        array(
                                            'fixed_price' =>
                                                array(
                                                    'value' => $price,
                                                    'currency_code' => 'USD',
                                                ),
                                        ),
                                ),
                        ),
                    'payment_preferences' =>
                        array(
                            'auto_bill_outstanding' => false,
                            'setup_fee' =>
                                array(
                                    'value' => '0',
                                    'currency_code' => 'USD',
                                ),
                            'setup_fee_failure_action' => 'CANCEL',
                            'payment_failure_threshold' => 1,
                        ),
                    'taxes' =>
                        array(
                            'percentage' => '0',
                            'inclusive' => false,
                        ),
                )
            );
        dd(json_decode($plan));
    }

    public function subscribeNow(Request $request)
    {
        $plan = Plan::find($request->plan);
        $subscription = $this->subscription($plan,
            env('APP_URL') . '/process-subscription?success=true&plan_id=' . $plan->id,
            env('APP_URL'));
        try {
            $link = $this->getApprovalLink($subscription);
            try {
                $agreement = new PaypalAgreement();
                $agreement->new_client_id = session('c_email.id');
                $agreement->plan_id = $plan->id;
                $agreement->agreement_id = $subscription->id;
                $agreement->save();
            } catch (\Exception $ex) {

            }
            return redirect($link);
        } catch (\Exception $ex) {

        }
        return redirect($link);
    }
    public function subscription($plan, $successURL, $cancelURL)
    {
        $company = NewClient::find(session()->get('c_email.id'));
        $subscription = Http::withHeaders([
            "Authorization" => $this->getToken(),
            "Content-Type" => "application/json",
        ])->post(env('PAYPAL_MODE') . '/v1/billing/subscriptions',
            array(
                'plan_id' => $plan->plan_id,
                'start_time' => Carbon::now()->addSeconds(60),
//                'quantity' => '10',
                'shipping_amount' =>
                    array(
                        'currency_code' => 'USD',
                        'value' => '0',
                    ),
                'subscriber' =>
                    array(
                        'name' =>
                            array(
                                'given_name' => $company->company_name,
                                'surname' => $company->name,
                            ),
                        'email_address' => $company->email,
                        'shipping_address' =>
                            array(
                                'name' =>
                                    array(
                                        'full_name' => $company->company_name,
                                    ),
                                'address' =>
                                    array(
                                        'address_line_1' => $company->complete_address,
                                        'address_line_2' => $company->complete_address,
                                        'admin_area_2' => $company->complete_address,
                                        'admin_area_1' => $company->complete_address,
                                        'postal_code' => '11111',
                                        'country_code' => 'US',
                                    ),
                            ),
                    ),
                'application_context' =>
                    array(
                        'brand_name' => $company->company_name,
                        'locale' => 'en-US',
                        'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                        'user_action' => 'SUBSCRIBE_NOW',
                        'payment_method' =>
                            array(
                                'payer_selected' => 'PAYPAL',
                                'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED',
                            ),
                        'return_url' => $successURL,
                        'cancel_url' => $cancelURL,
                    ),
            )
        );
        return json_decode($subscription);
    }

    public function getApprovalLink($subscription)
    {
        foreach ($subscription->links as $link) {
            if ($link->rel == 'approve') {
                return $link->href;
            }
        }
    }
//
    public function subscriptionDetails($agreementId)
    {
        $subscriptionDetails = Http::withHeaders(
            [
                "Accept" => "application/json",
                "Authorization" => $this->getToken(),
                "Content-Type" => "application/json",
            ])->get(env('PAYPAL_MODE') . '/v1/billing/subscriptions/' . $agreementId);

        return json_decode($subscriptionDetails);
    }

    public function paypalSuccess(Request $request)
    {
        dd($request->all());
    }
    public function planDetails($id)
    {
        $plan = Http::withHeaders(
            [
                "Accept" => "application/json",
                "Authorization" => $this->getToken(),
                "Content-Type" => "application/json",
            ])->get(env('PAYPAL_MODE') . "/v1/billing/plans/$id");

        return json_decode($plan);
    }


//    public function createPackage()
//    {
//        $package = new Package();
//        $name = 'plan 3';
//        $description = "this is plan 3";
//        $package->name = $name;
//        $package->details = $description;
//        $package->price = 300;
//        if ($package->save()) {
//            try {
//                $productPaypal = $this->createProduct($name, $description);
//                $planPaypal = $this->createPlan($productPaypal->id, $package->name, 'month', 1, $package->price);
//                $package->paypal_product_id = $productPaypal->id;
//                $package->paypal_plan_id = $planPaypal->id;
//                $package->save();
//                dd($package->toArray());
//            } catch (\Exception $ex) {
//                dd($ex->getCode(), $ex->getLine(), $ex->getMessage());
//            }
//        }
//    }


//    public function productsList()
//    {
//        $list = Http::withHeaders(
//            ['Content-Type' => 'application/json', 'Authorization' => $this->getToken()]
//        )->get(env('PAYPAL_MODE') . '/v1/catalogs/products');
//
//        $productsList = json_decode($list);
//        dd($productsList);
//    }
//
//    public function plansList()
//    {
//        $list = Http::withHeaders(
//            ['Content-Type' => 'application/json', 'Authorization' => $this->getToken()]
//        )->get(env('PAYPAL_MODE') . '/v1/billing/plans?status=ACTIVE');
//
//        dd(json_decode($list));
//    }
//

//
}
