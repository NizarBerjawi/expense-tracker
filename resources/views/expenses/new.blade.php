@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Expenses',
            'levels'    => [
                            'Home'       => route('dashboard'),
                            'Expenses'   => route('expenses.index'),
                            'Create'       => '',
                           ]
        ])
        <div class="main-content container-fluid">
            <!-- Messages -->
            @include('includes.partials.messages')

            <!-- Main Form -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('includes.mainForm', [
                        'resource'      => 'expenses',
                        'panelHeading'  => 'New Expense',
                        'formAction'    => route('expenses.store'),
                        'cancelRoute'   => route('expenses.index'),
                        'methodField'   => method_field('POST'),
                        'disabled'      => false,
                        'button'        => 'Add'
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the form
            App.formElements();
        });
    </script>
@endsection
