<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="{{URL::asset('/')}}" target="_top">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('layouts.partials._navigation')
        @yield('content')
        @include('layouts.partials._footer')
        <!-- Scripts -->
        <script type="text/javascript">
            json_rpc_server = '{{ env('JSON_RPC_SERVER') }}';
            token           = '{{ env('JSON_RPC_SERVER_TOKEN') }}';
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
