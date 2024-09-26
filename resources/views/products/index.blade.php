@extends('admin/main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
@section('content')

    @if(Session::has('message'))
        <div class="card" id="alert-card">
            <div class="card-header">
                <strong class="card-title">Dismissing Alerts</strong>
            </div>
            <div class="card-body">
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hideCard()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

        <script>
            function hideCard() {
                document.getElementById('alert-card').style.display = 'none';
            }
        </script>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong class="card-title">Products List</strong>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Add Product</a>
            </div>
            <div class="table-stats order-table ov-h">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->sku }} </td>
                            <td> {{ $product->slug }} </td>
                            <td> {{ $product->description ?? 'N/A' }} </td>
                            <td> {{ $product->price }} </td>
                            <td> {{ $product->discount }} </td>
                            <td> {{ $product->stock }} </td>
                            <td>
                                 <span class="badge {{ $product->status == App\Enums\ProductStatus::INACTIVE ? 'badge-danger' : 'badge-success' }}">
                                    {{ App\Enums\ProductStatus::from($product->status->value)->label() }}
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('products.edit', ['product' => $product->id]) }}"><i class="fa fa-edit"></i></a>
                                <button onclick="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $products->links() }}
    </div>
@endsection
<script>
    function deleteProduct(productId){
        if(confirm('Are you sure to delete?')) {
            let url = `{{ route('products.destroy', ['product' => ':id']) }}`;
            url = url.replace(':id', productId);
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    _token : '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    }
    function editBrand(brandId){
        let url = `{{ route('brands.update', ['brand' => ':id']) }}`;
        url = url.replace(':id', brandId);
        let name = $('#name_' + brandId).val();
        $.ajax({
            url: url,
            type: 'post',
            data: {
                    _token : '{{ csrf_token() }}',
                    'name': name
            },
            success: function (response) {
                alert(response.message);
                location.reload();
            },
            error: function (xhr) {
                $('#validation-errors_' + brandId).html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#validation-errors_' + brandId).append('<div class="alert alert-danger">'+value+'</div');
                });
            },
        });
    }
</script>