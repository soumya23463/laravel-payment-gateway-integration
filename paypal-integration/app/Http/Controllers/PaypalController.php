<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Paypal;

class PaypalController extends Controller
{
    public function paypal(Request $request)
{
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $token = $provider->getAccessToken();

    $provider->setAccessToken($token);

    $response = $provider->createOrder([
        "intent" => "CAPTURE",
        "application_context" => [
            "return_url" => route('success'),
            "cancel_url" => route('cancel'),
        ],
        "purchase_units" => [
            [
                "amount" => [
                    "currency_code"=> "USD",
                    "value" => $request->price
                ]
            ]
        ]
    ]);

   if (isset($response['id']) && $response['status'] === 'CREATED') {
        foreach ($response['links'] as $link) {
            if ($link['rel'] === 'approve') {
                session()->put('product_name',$request->product_name);
                session()->put('quantity',$request->quantity);

                return redirect()->away($link['href']);
            }
        }
    }
    return redirect()->route('cancel')->with('error', 'Something went wrong!');

    }

   public function success(Request $request)
{
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $token = $provider->getAccessToken();
    $provider->setAccessToken($token);

    $response = $provider->capturePaymentOrder($request->token);

    if ($response['status'] == 'COMPLETED') {
        $purchase_unit = $response['purchase_units'][0];
        $payer = $response['payer'];

        $payment = new Paypal();
        $payment->payment_id = $response['id'];
        $payment->product_name = session()->get('product_name');
        $payment->quantity = session()->get('quantity');
       $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
$payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];

        $payment->payer_name = $payer['name']['given_name'] . ' ' . $payer['name']['surname'];
        $payment->payer_email = $payer['email_address'];
        $payment->payer_status = $payer['status'] ?? 'UNKNOWN';
        $payment->save();

        session()->forget('product_name');
        session()->forget('quantity');

        return view('success');
    } else {
        return redirect()->route('cancel')->with('error', 'Payment not completed.');
    }
}

    public function cancel(){
        return "payment is canceled";
    }
}