<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Expense Tracker') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"/>

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body class="be-splash-screen">
        @yield('content')
        @yield('scripts')

        <script src="{{ asset('lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    </body>
</html>
