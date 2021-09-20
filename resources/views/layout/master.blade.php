<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Inventory System')</title>
        <link rel="stylesheet" href="{{ URL::asset("css/bootstrap.min.css") }}" />
        <link rel="stylesheet" href="{{ URL::asset("css/bootstrap-toggle.min.css") }}" />
        <link rel="stylesheet" href="{{ URL::asset("css/datatables.min.css") }}" />
        <link rel="stylesheet" href="{{ URL::asset("css/style.css") }}" />
        <link rel="stylesheet" href="{{ URL::asset("css/bootstrap-select.min.css") }}" />
    </head>
    <body>
        

        @if (!Request::is('login'))
            
            @include('layout.navbar')

            @include('layout.jumbotron')

        @endif


        @yield("content")

        <script src="{{ URL::asset("js/jquery-3.4.0.min.js") }}"></script>
        <script src="{{ URL::asset("js/bootstrap.min.js") }}"></script>
        <script src="{{ URL::asset("js/bootstrap-toggle.min.js") }}"></script>
        <script src="{{ URL::asset("js/sweetalert.min.js") }}"></script>
        <script src="{{ URL::asset("js/datatables.min.js") }}"></script>
        <script src="{{ URL::asset("js/bootstrap-select.min.js") }}"></script>

        @yield('js')
    </body>
</html>