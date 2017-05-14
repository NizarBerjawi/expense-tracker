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
        <link rel="stylesheet" type="text/css" href="assets/lib/morrisjs/morris.css"/>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"/>



        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div class="be-wrapper">
            @include('includes.navigation.topNav')

            @include('includes.navigation.leftNav')

            @yield('content')

            @include('includes.navigation.rightNav')

            <!-- Common Scripts -->
            <script src="{{ asset('lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
            <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>

            @yield('scripts')

            <script type="text/javascript">
                $(document).ready(function(){
                    //initialize the javascript
                    App.init();
                });
            </script>
        </div>

        @yield('modals')

    </body>
</html>
