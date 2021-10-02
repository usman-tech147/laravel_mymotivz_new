<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function payment()
    {
        $paypal_config = Config::get('paypal');
        $config = [
            'mode' => $paypal_config['mode'],
            'sandbox' => [
                'client_id' => $paypal_config['sandbox']['client_id'],
                'client_secret' => $paypal_config['sandbox']['client_secret'],
                'app_id' => 'APP-80W284485P519543T',
            ],
            'payment_action' => $paypal_config['payment_action'],
            'currency' => $paypal_config['currency'],
            'notify_url' => $paypal_config['notify_url'],
            'locale' => $paypal_config['locale'],
            'validate_ssl' => $paypal_config['validate_ssl'],
        ];
        $provider = new PaypalClient;
        $provider->setApiCredentials($config);
//        dd($provider->getAccessToken());
//        dd($provider);
//        $plan = $provider->createPlan($data);
        $fields = ['id', 'product_id', 'name', 'description'];
        $plans = $provider->listPlans();
        dd($plans);
//        access_token = A21AAKUVoMIvGS2AkcXG9SQVrYBNUnKT3ilMK00A22_T-Gl2SWaM7q8BKklQ6xjJ5ymoGX5ZqBogIpncHjqAow5OAfF2vpS4A;
        dd($provider->getAccessToken());
    }
}
