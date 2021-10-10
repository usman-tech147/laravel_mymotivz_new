<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Plan;
use PayPal\Api\PlanList;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PHPUnit\Util\Exception;

class PaypalController extends Controller
{
    public $apiContext;

    public function __construct()
    {

        $paypal_conf = Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->apiContext->setConfig($paypal_conf['settings']);

//        $this->apiContext = new \PayPal\Rest\ApiContext(
//            new \PayPal\Auth\OAuthTokenCredential(
//                env('PAYPAL_SANDBOX_CLIENT_ID'),
//                env('PAYPAL_SANDBOX_CLIENT_SECRET'),
//                env('PAYPAL_MODE')
//            )
//        );
    }

    public function createPayment()
    {
//        $payer = new Payer();
//        $payer->setPaymentMethod("paypal");
//        $plan = Plan::get('P-8EE52815BY995843KMFRQ5VY', $this->apiContext);
        dd($this->apiContext);
    }

    public function storePayment(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123")// Similar to `item_number` in Classic API
            ->setPrice(20);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321")// Similar to `item_number` in Classic API
            ->setPrice(10);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $details = new Details();
        $details->setShipping(1)
            ->setTax(1)
            ->setSubtotal(70);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(72)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $baseUrl = 'http://localhost:8000';
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/success/payment")
            ->setCancelUrl("$baseUrl/cancel/payment");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($this->apiContext);
//        dd($payment);
        return redirect($payment->getApprovalLink());
        dd($request->all());
    }

    public function successPayment()
    {
//        if (isset($_GET['success']) && $_GET['success'] == 'true') {
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);
        $result = $payment->execute($execution, $this->apiContext);
        if ($result->getState() == 'approved') {
            return redirect()->route('payment.details');
        }
//            dd($result);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(2.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        $amount->setCurrency('USD');
        $amount->setTotal(21);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        try {
            $result = $payment->execute($execution, $this->apiContext);

//                ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);

            try {
                $payment = Payment::get($paymentId, $this->apiContext);
            } catch (Exception $ex) {

//                    ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
                exit(1);
            }
        } catch (Exception $ex) {

//                ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
            exit(1);
        }

//            ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);

        return $payment;
//        }
//        else {
//            ResultPrinter::printResult("User Cancelled the Approval", null);
//            exit;
//        }
    }


    public function cancelPayment()
    {
        dd("cancel payment");
    }

    public function createPlan()
    {
        $plan = new Plan();
        $plan->setName('Diamond')
            ->setDescription('Diamond Plan')
            ->setType('fixed');

        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval("1")
            ->setCycles("12")
            ->setAmount(new Currency(array('value' => 200, 'currency' => 'USD')));


        $chargeModel = new ChargeModel();
        $chargeModel->setType('SHIPPING')
            ->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));

        $paymentDefinition->setChargeModels(array($chargeModel));


        $merchantPreferences = new MerchantPreferences();
        $baseUrl = $this->getBaseUrl();

        $merchantPreferences->setReturnUrl("$baseUrl/execute-agreement/true")
            ->setCancelUrl("$baseUrl/execute-agreement/false")
            ->setAutoBillAmount("yes")
            ->setInitialFailAmountAction("CONTINUE")
            ->setMaxFailAttempts("0")
            ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        $output = $plan->create($this->apiContext);

        dd($output);
    }

    public function getPlanDetails()
    {
        $plan = Plan::get('P-6GR671137A924900YNMI2EIY',$this->apiContext);
        dd($plan);
    }

    public function getListPlans()
    {
        $params = array('page_size' => '10');
        $planList = Plan::all($params, $this->apiContext);
        dd($planList->toArray());
    }

    public function executeAgreementTrue()
    {
        dd('true');
    }

    public function executeAgreementFalse()
    {
        dd('false');
    }

    public function getBaseUrl()
    {
        return 'http://localhost:8000';
    }


}
