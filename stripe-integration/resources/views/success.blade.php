<!DOCTYPE html>
<html>

<head>
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-success">Payment Successful</h2>
        <p>Session ID: {{ $session->id }}</p>
        <p>Customer Email: {{ $session->customer_details->email ?? 'N/A' }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to Home</a>
    </div>
</body>

</html>
