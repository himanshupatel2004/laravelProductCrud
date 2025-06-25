
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Product List</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>

    <div class="container mt-2">
        @include('error_message')
        <div class="row">
            <div class="col-6">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
            </div>
            <div class="col-6">
                <form action="{{ route('products.list') }}" class="row">
                    <div class="col-10">
                        <input type="text" name="search" placeholder="Search Here" class="form-control"
                            value="{{ $search }}">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                @include('products.ajax-list', ['products' => $products])
            </tbody>
        </table>
        {{-- {{ $products->links() }} --}}
        {!! $products->appends(['search' => $search])->links() !!}
    </div>
    <!-- The Modal -->
    <div class="modal" id="product-create-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Product Create</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        style="margin-left: 279px;">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="products-create-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Description:</label>
                            <textarea name="textarea" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" step="0.01" id="price" name="price">
                        </div>
                        <button type="button" class="btn btn-primary" id="product-create">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') // ✅ correct
            }
        });

        $(document).on('click', '#products-create', function() {
            var formData = $("#products-create-form").serialize();
            console.log(formData);
            $.ajax({
                url: '{{ route("products.store") }}',
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        alert("Product created successfully.");
                        $("#products-create-form")[0].reset();
                        productList();
                        $("#products-create-modal").modal('hide');
                    }
                    // console.log(response);
                },
                error: function(error) {
                    console.log("Error:", error);
                    alert("An error occurred while creating the product.");
                }
            });
        });

        $(document).on('click', '.products-delete', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("products.destroy") }}',
                type: "GET",
                data: {id},
                success: function(response) {
                    productList();
                },

                error: function(error) {
                    console.log(error);
                }
            });
        });
        function productList() {
            $.ajax({
                url: '{{ route("products.list") }}',
                type: "GET",
                success: function(response) {
                    $('#product-table-body').html(response);
                },
                error: function(error) {
                    console.log("Error:", error);
                    alert("An error occurred while loading the product list.");
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
