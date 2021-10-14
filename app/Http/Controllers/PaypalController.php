<?php

namespace App\Http\Controllers;

use App\Models\PayPal\Package;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaypalController extends Controller
{
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

    public function createPackage()
    {
        $package = new Package();
        $name = 'THE DEPARTMENT';
        $description = "10 Active Job,Unlimited Applicants,“MM” Traffic Booster,Instant Email Alerts,Dashboard Access & Hiring Tools";
        $description .= "Customer Support,+Add Team Members";
        $package->name = $name;
        $package->details = $description;
        $package->price = 600;
        if ($package->save()) {
            try {
                $productPaypal = $this->createProduct($name, $description);
                $planPaypal = $this->createPlan($productPaypal->id, $package->name, 'month', 1, $package->price);
                $package->paypal_product_id = $productPaypal->id;
                $package->paypal_plan_id = $planPaypal->id;
                $package->save();
//                dd("product created successfully");
            } catch (\Exception $ex) {
                dd($ex->getCode(), $ex->getLine(), $ex->getMessage());
            }
        }
        $this->productsList();
    }

    public function createProduct($p_name, $p_details)
    {
        $createProduct = Http::withHeaders(
            [
                'Content-type' => 'application/json',
                'Authorization' => $this->getToken(),
            ]
        )->post(env('PAYPAL_MODE') . '/v1/catalogs/products',
            [
                'name' => $p_name,
                'description' => substr($p_details, 0, 500),
                'type' => 'SERVICE',
                'category' => 'SOFTWARE',
                'home_url' => env('APP_URL'),
            ]
        );
        return json_decode($createProduct);
    }

    public function createPlan($productId, $name, $interval, $intervalCount, $price)
    {
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
                    'description' => "$interval $name For $price",
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

        return json_decode($plan);
    }

    public function productsList()
    {
        $list = Http::withHeaders(
            ['Content-Type' => 'application/json', 'Authorization' => $this->getToken()]
        )->get(env('PAYPAL_MODE') . '/v1/catalogs/products');

        $productsList = json_decode($list);
        dd($productsList);
    }

    public function plansList()
    {
        $list = Http::withHeaders(
            ['Content-Type' => 'application/json', 'Authorization' => $this->getToken()]
        )->get(env('PAYPAL_MODE') . '/v1/billing/plans?status=ACTIVE');

        dd(json_decode($list));
    }

    public function subscribeNow(Request $request)
    {
        $package = Package::find($request->package_id);
        $subscription = $this->subscription($package->paypal_plan_id, env('APP_URL') . '/process-subscription?success=true&package_id=' . $package->id, env('APP_URL'));
        $link = $this->getApprovalLink($subscription);
        return redirect($link);
    }

    public function subscription($planId, $successURL, $cancelURL)
    {
        $subscription = Http::withHeaders([
            "Accept" => "application/json",
            "Authorization" => $this->getToken(),
            "Content-Type" => "application/json",
//                "PayPal-Request-Id" => "SUBSCRIPTION-" . uniqid() . time() . date('d-m-y')
        ])->post(env('PAYPAL_MODE') . '/v1/billing/subscriptions',
            array(
                'plan_id' => $planId,
                'start_time' => Carbon::now()->addSeconds(60),
                'quantity' => '1',
                'shipping_amount' =>
                    array(
                        'currency_code' => 'USD',
                        'value' => '0',
                    ),
                'subscriber' =>
                    array(
                        'name' =>
                            array(
                                'given_name' => 'John',
                                'surname' => 'Doe',
                            ),
                        'email_address' => 'customer@example.com',
                        'shipping_address' =>
                            array(
                                'name' =>
                                    array(
                                        'full_name' => 'John Doe',
                                    ),
                                'address' =>
                                    array(
                                        'address_line_1' => '2211 N First Street',
                                        'address_line_2' => 'Building 17',
                                        'admin_area_2' => 'San Jose',
                                        'admin_area_1' => 'CA',
                                        'postal_code' => '95131',
                                        'country_code' => 'US',
                                    ),
                            ),
                    ),
                'application_context' =>
                    array(
                        'brand_name' => 'Mymotivz',
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
        try {
            $link=PayPalController::getApprovalLink($subscription);
            try {
                PayPalAgreement::create([
                    'user_id'=>auth()->guard('user')->user()->id,
                    'package_id'=>$package->id,
                    'agreement_id'=>$subscription->id
                ]);
            }
            catch (\Exception $ex){

            }
            return redirect($link);
        }
        catch (\Exception $ex){

        }
    }
    public function paypalSuccess(Request $request)
    {
        dd($request->all());
    }
}
