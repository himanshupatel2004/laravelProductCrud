<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        @include('error_message')

        <form>
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" value="{{ $product->name }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" rows="4" readonly>{{ $product->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="price">Price:</label>
                <input type="text" class="form-control" value="₹{{ number_format($product->price, 2) }}" readonly>
            </div>

            <a href="{{ route('products.list') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
</body>

</html>
