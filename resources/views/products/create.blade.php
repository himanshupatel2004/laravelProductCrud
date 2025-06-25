<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        @include('error_message')

        <h2><strong>Add Product</strong></h2>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Enter Name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description: </label>
                <textarea name="description" id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="4">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price') }}" placeholder="Enter Price">
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            {{-- <a href="{{ route('products.list') }}" class="btn btn-secondary">Back to List</a> --}}
            <a href="{{ route('products.list') }}" class="btn btn-danger">See Product List</a>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
