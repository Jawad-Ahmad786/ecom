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
                <strong class="card-title">Brands List</strong>
                <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm">Add Brand</a>
            </div>
            <div class="table-stats order-table ov-h">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td> {{ $brand->name }} </td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#editBrandModal_{{ $brand->id }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                <button onclick="deleteBrand({{ $brand->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                        <div class="modal fade" id="editBrandModal_{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="staticModalLabel">Edit</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" id="name_{{ $brand->id }}" name="name" value="{{ $brand->name }}" class="form-control">
                                            </div>
                                            <div id="validation-errors_{{ $brand->id }}">
                                            </div>
                                            <div class="form-actions form-group"><button type="button" onclick="editBrand({{ $brand->id }})" class="btn btn-success btn-sm">Submit</button></div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    function deleteBrand(brandId){
        if(confirm('Are you sure to delete?')) {
            let url = `{{ route('brands.destroy', ['brand' => ':id']) }}`;
            url = url.replace(':id', brandId);
            $.ajax({
                url: url,
                type: 'post',
                data: {
                  _token : '{{ csrf_token() }}'},
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