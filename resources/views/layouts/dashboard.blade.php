<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/jqvmap/jqvmap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
        @yield('styles')

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div class="be-wrapper">
            @include('includes.topNav')

            @include('includes.leftNav')

            @yield('content')

            @include('includes.rightNav')

            @yield('scripts')
        </div>
    </body>
</html>
