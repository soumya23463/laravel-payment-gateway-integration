<?php

namespace App\Http\Controllers;

use App\Models\Razorpay;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function razorpay(Request $request)
{


    if (isset($request->razorpay_payment_id) && $request->razorpay_payment_id != '') {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        $response = $payment->capture(['amount' => $payment->amount]);



        // Save payment to database
        $savePayment = new Razorpay();
        $savePayment->payment_id      = $response['id'];
        $savePayment->product_name    = $response['notes']['product_name'] ?? 'Unknown';
        $savePayment->quantity        = $response['notes']['quantity'] ?? 1;
        $savePayment->amount          = $response['amount'] ;
        $savePayment->currency        = $response['currency'];
        $savePayment->customer_name   = $response['notes']['customer_name'] ?? 'Guest';
        $savePayment->customer_email  = $response['notes']['customer_email'] ?? 'guest@example.com';
        $savePayment->payment_status  = $response['status'];
        $savePayment->payment_method  = 'Razorpay';

        $savePayment->save();

        return redirect()->route('success');
    } else {
        return redirect()->route('cancel');
    }



}
public function success()
{
    return view('success');
}

public function cancel(){
        return "payment is canceled";
    }
}
