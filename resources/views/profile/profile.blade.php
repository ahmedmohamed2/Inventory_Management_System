@extends('layout.master')

@section('title', 'Profile Page')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel panel-heading text-center">
                <h4>Main Information</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table table-borderd table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-user"></i>
                                            Username : {{ $user->user_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-user"></i>
                                            Fullname : {{ $user->full_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-check"></i>
                                            User Status :
                                            @if ($user->user_status == 1)
                                                {{ "Activated" }}
                                            @else
                                                {{ "Unactivated" }}
                                            @endif
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-calendar"></i>
                                            Registration Date : {{ $user->created_at }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-usd"></i>
                                            Total Sales : {{ $total_sales }} L.E
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-usd"></i>
                                            Today Sales : {{ $today_sales }} L.E
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="glyphicon glyphicon-usd"></i>
                                            Last 7 Days Sales : {{ $week_sales }} L.E
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img class="img-thumbnail" src="{{ asset("uploads/profile_images/" . session("user_image")) }}" />
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel panel-heading text-center">
                <h4>Added Orders</h4>
            </div>
            <div class="panel-body">
                <table class="table table-borderd table-striped added_orders">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Order Total</th>
                            <th>Order Address</th>
                            <th>Order Date</th>
                            <th>Payment Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_name }}</td>
                                <td>{{ $order->order_total }} L.E</td>
                                <td>{{ $order->order_address }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    @if ($order->payment_status == 1)
                                        {{ "Cash" }}
                                    @else
                                        {{ "Credit Card" }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/orders/details/{{ $order->id }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-list-alt"></i> Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <script>
        $(function() {
            $(".added_orders").DataTable();

        });
    </script>

@endsection
