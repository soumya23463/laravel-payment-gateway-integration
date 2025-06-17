<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel – PayPal Integration</title>

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
                        <p class="card-text">Price: <strong>$5</strong></p>

                        <form action="{{ route('paypal') }}" method="POST">
                            @csrf
                            <input type="hidden" name="price" value="5">
                            <input type="hidden" name="product_name" value="Laptop">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-paypal"></i> Pay with PayPal
                            </button>
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
