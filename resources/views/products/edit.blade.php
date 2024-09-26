@extends('admin/main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Edit Product</div>
                    <div class="card-body card-block">
                        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-control">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" id="sku" name="sku" value="{{ $product->sku }}" class="form-control">
                                        @error('sku')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" id="slug" name="slug" value="{{ $product->slug }}" class="form-control">
                                        @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>
                                            Brand
                                        </label>
                                        <select class="form-control" name="brand_id">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>
                                            Category
                                        </label>
                                        <select class="form-control" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" id="description" name="description" class="form-control">{{ $product->description }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <input type="text" id="short_description" name="short_description" value="{{ $product->short_description }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="form-control">
                                        @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" id="price" name="price" value="{{ $product->price }}" class="form-control">
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="number" class="form-control" name="discount" value="{{ $product->discount}}" id="discount">
                                        @error('discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control">
                                            @foreach(App\Enums\ProductStatus::cases() as $status)
                                                <option {{ $product->status == $status->value ? 'selected' : '' }} value="{{ $status->value }}">{{ $status->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Featured</label>
                                        <select id="featured" name="featured" class="form-control">
                                            <option {{ $product->featured == 1 ? 'selected' : '' }} value="1">Yes</option>
                                            <option {{ $product->featured == 0 ? 'selected' : '' }} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Images</label>
                                        <input type="file" id="images" name="images[]" class="form-control" multiple>
                                        @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @foreach ($errors->get('images.*') as $message)
                                            <span class="text-danger">{{ $message[0] }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Uploaded Images</label>
                                        <br>
                                        @foreach ($product->images as $image)
                                            <div class="image-container" style="position: relative; display: inline-block; margin: 10px;" id="image-container-{{ $image->id }}">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="" height="100" width="100" style="padding: 10px;">
                                                <input type="hidden" value="{{ $product->id }}" id="product-id">
                                                <!-- Cross icon (Font Awesome) -->
                                                <span class="delete-image-icon" data-image-id="{{ $image->id }}" style="position: absolute; top: -2px; right: -2px; cursor: pointer; font-size: 20px; color: red;">&times;</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    $(document).on('click', '.delete-image-icon', function() {
        var imageId = $(this).data('image-id');
        var productId = $('#product-id').val();
        var container = '#image-container-' + imageId;
        var url = `{{ route("product.images.delete", ['product' => ':id']) }}`;
        url = url.replace(':id', productId);

        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                     image_id: imageId
                },
                success: function(response) {
                        alert(response.message);
                        $(container).remove();
                },
                error: function(xhr) {
                     alert(xhr.responseJson.errors.error)
                }
            });
        }
    });
</script>

