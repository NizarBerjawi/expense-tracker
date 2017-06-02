@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.fullcalendar/fullcalendar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Calendar',
            'levels'    => [
                            'Home'       => route('dashboard'),
                            'Calendar'   => ''
                           ]
        ])
        <div class="main-content container-fluid">
            <div class="col-md-12">
                <div class="full-calendar">
                    <div class="panel panel-default panel-fullcalendar">
                        <div class="panel-body">
                            <div id="cal-loader"></div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/jquery.fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-page-calendar.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            App.init();
            App.pageCalendar();
            App.formElements();
        });
    </script>
@endsection

@section('modals')
    @include('includes.modals.showExpense')
@endsection
