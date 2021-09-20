@extends('layout.master')

@section('title', 'Orders Page')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Manage Orders</h4>
            </div>
            <div class="panel-body">
                <a href="orders/create" class="addNewbtn btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Order</a>
                <div class="table-responsive">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <th>Customer Name</th>
                            <th>Total Invoice</th>
                            <th>Payment Status</th>
                            <th>Order Date</th>
                            <th>Details</th>
                            <th>Print</th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_name }}</td>
                                    <td>{{ $order->order_total }} L.E</td>
                                    <td>
                                        @if ($order->payment_status == 1)
                                            {{ "Cash" }}
                                        @else
                                            {{ "Credit Card" }}
                                        @endif
                                    </td>   
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="/orders/details/{{ $order->id }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-list-alt"></i> Details</a>
                                    </td>
                                    <td>
                                        <a href="/orders/invoice/{{ $order->id }}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-print"></i> Print Invoice</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>
    $(function() {
        $(".table").DataTable();
    });
</script>

@endsection
