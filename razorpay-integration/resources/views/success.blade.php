<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light text-center py-5">

    <div class="container">
        <div class="alert alert-success">
            <h2 class="mb-3">🎉 Payment Successful!</h2>
            <p>Thank you for your purchase. Your payment has been received.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
        </div>
    </div>

</body>

</html>
