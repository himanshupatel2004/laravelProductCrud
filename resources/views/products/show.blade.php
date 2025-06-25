<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        @include('error_message')

        <div class="card" style="width:400px">
            <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text"><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
                <a href="{{ route('products.list', $product->id) }}" class="btn btn-secondary">Back to List</a>

            </div>
        </div>
    </div>
</body>

</html>
