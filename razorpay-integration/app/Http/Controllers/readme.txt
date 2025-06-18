🔹 Step 1: Install Razorpay PHP SDK

bash
Copy
Edit
composer require razorpay/razorpay
🔹 Step 2: Add API Credentials to .env (https://dashboard.razorpay.com/app/account-settings >
Website and app settings > API keys)

env

RAZORPAY_KEY_ID=your_key_id
RAZORPAY_KEY_SECRET=your_key_secret


🔹 Step 3: Create Blade View with Razorpay Checkout Script
🔹 Step 3: Create Blade View with Razorpay Checkout Script

blade
<form action="{{ route('razorpay') }}" method="POST">
    @csrf
    <script src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{ env('RAZORPAY_KEY_ID') }}"
        data-amount="2000"
        data-currency="INR"
        data-buttontext="Pay Now"
        data-name="Laravel Razorpay"
        data-description="Test Transaction"
        data-image="{{ asset('razorpay.svg') }}"
        data-notes.product_name="Laptop"
        data-notes.customer_name="John Doe"
        data-notes.customer_email="john@example.com">
    </script>
</form>
🔹 Step 4: Create Controller Logic
Use Razorpay’s SDK to capture and store payment:


use Razorpay\Api\Api;

public function razorpay(Request $request)
{
    if ($request->razorpay_payment_id) {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
        $payment = $api->payment->fetch($request->razorpay_payment_id);
        $response = $payment->capture(['amount' => $payment->amount]);

        $pay = new Razorpay(); // your model
        $pay->payment_id = $response['id'];
        $pay->amount = $response['amount'] / 100;
        $pay->customer_email = $response['notes']['customer_email'] ?? 'guest@example.com';
        $pay->save();

        return redirect()->route('success');
    }
    return redirect()->route('cancel');
}
🔹 Step 5: Setup Routes



Route::post('/razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');
Route::get('/success', [RazorpayController::class, 'success'])->name('success');
Route::get('/cancel', [RazorpayController::class, 'cancel'])->name('cancel');
