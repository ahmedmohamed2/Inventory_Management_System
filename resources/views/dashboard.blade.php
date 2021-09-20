@extends('layout.master')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Users</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $users_count }}</h1>  
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Categories</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $categories_count }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Brands</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $brands_count }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Products In Stock</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $products_count }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Order Value Today</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $today_order_total }} L.E</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Order Value Yesterday</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $yesterday_order_total }} L.E</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Order Value Last 7 Days</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $week_order_total }} L.E</h1>
                    </div>  
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Order Value</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $order_total }} L.E</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Cash Order Value</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $cash_total }} L.E</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Total Credit Order Value</h4>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $credit_total }} L.E</h1>
                    </div>  
                </div>
            </div>

        </div>



    </div>

@endsection