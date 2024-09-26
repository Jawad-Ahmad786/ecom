@extends('admin/main')
@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add Product</div>
                    <div class="card-body card-block">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                          <div class="row">
                              <div class="col-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                          </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" id="sku" name="sku" value="{{ old('sku') }}" class="form-control">
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
                                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control">
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
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <textarea type="text" id="description" name="description" class="form-control">{{ old('description') }}</textarea>
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
                                        <input type="text" id="short_description" name="short_description" value="{{ old('short_description') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control">
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
                                        <input type="number" id="price" name="price" value="{{ old('price') }}" class="form-control">
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="number" class="form-control" name="discount" id="discount" value="0">
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
                                                <option value="{{ $status->value }}">{{ $status->label() }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Featured</label>
                                        <select id="featured" name="featured" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
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
                            </div>
                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
