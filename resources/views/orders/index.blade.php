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
            <div class="card-header">
                <strong class="card-title">Orders List</strong>
            </div>
            <div class="table-stats order-table ov-h">
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Tracking #</th>
                        <th>Total Products</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td> {{ $order->user->name ?? 'N/A' }} </td>
                        <td> {{ $order->user->email ?? 'N/A' }} </td>
                        <td> {{ $order->tracking_no ?? 'N/A' }} </td>
                        <td> {{ count($order->items) }} </td>
                        <td> {{ $order->grand_total }} </td>
                        @php
                             $status = $order->statuses()->orderBy('pivot_created_at', 'desc')->first()->name;
                        @endphp
                        <td>
                         <span class="badge {{ $status == 'pending' ? 'badge-warning' : ($status == 'completed' ? 'badge-success' : ($status == 'cancelled' ? 'badge-danger' : ($status == 'processing' ? 'badge-info' : ''))) }}">
                            {{ $status }}
                        </span>
                        </td>
                        <td>
                            <button onclick="deleteOrder({{ $order->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $orders->links() }}
    </div>
@endsection
<script>
    function deleteOrder(orderId){
        if(confirm('Are you sure to delete?')) {
            let url = `{{ route('orders.delete', ['order' => ':id']) }}`;
            url = url.replace(':id', orderId);
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
</script>