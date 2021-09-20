@extends('layout.master')

@section('title', 'Order Details')

@section('content')

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">Order Details</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-borderd table-striped">
                                <tbody>
                                    <tr>
                                        <td width="70%">Customer Name</td>
                                        <td width="30%">{{ $order->order_name }}</td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Address</td>
                                        <td width="30%">{{ $order->order_address }}</td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Total Invoice</td>
                                        <td width="30%">{{ $order->order_total }} L.E</td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Payment Status</td>
                                        <td width="30%">
                                            @if ($order->payment_status == 1)
                                                {{ "Cash" }}
                                            @else
                                                {{ "Credit Card" }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Created At</td>
                                        <td width="30%">{{ $order->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Added By</td>
                                        <td width="30%">{{ $order->user->full_name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-borderd table-striped">
                                <thead>
                                    <td>Product Name</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Tax</td>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ $product->product_price }} L.E</td>
                                            <td>{{ $product->product_tax }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection
