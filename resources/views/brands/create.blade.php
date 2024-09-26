@extends('admin/main')
@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body card-block">
                        <form action="{{ route('brands.store') }}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
