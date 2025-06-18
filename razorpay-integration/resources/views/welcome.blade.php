<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel – Razorpay Integration</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Product Checkout</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Product: <strong>Laptop</strong></h5>
                        <p class="card-text">Price: <strong>₹20 (INR)</strong></p>

                        <form action="{{ route('razorpay') }}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY_ID') }}" data-amount="2000"
                                {{-- 2000 paise = ₹20 --}} data-currency="INR" data-buttontext="Pay with Razorpay" data-name="Laravel Razorpay"
                                data-description="Test payment" data-image="{{ asset('razorpay.svg') }}" data-prefill.name="John Doe"
                                data-prefill.email="john@example.com" data-prefill.contact="8765235232" data-theme.color="#528FF0"
                                data-notes.product_name="Laptop" data-notes.quantity="1" data-notes.customer_name="John Doe"
                                data-notes.customer_email="john@example.com"></script>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Bootstrap Icons (Optional) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>

</html>
