@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    @include('includes.partials.breadcrumbs', [
        'pageTitle' => 'Bank Accounts',
        'levels'    => [
                        'Home'       => route('dashboard'),
                        'Profile'    => route('user.banks.create'),
                        'Create'     => ''
                       ]
    ])
    <div class="main-content container-fluid">
        <!-- Messages -->
        @include('includes.partials.messages')

        <!-- Main Form -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Create Bank Accounts</div>
                <div class="panel-body">
                    @include('includes.forms.bankAccountsForm', [
                        'formAction'    => route('user.banks.store'),
                        'csrfField'     => csrf_field(),
                        'methodField'   => method_field('POST'),
                        'cancelRoute'   => route('user.profiles.index'),
                        'submit'        => 'Add Account'
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

@section('modals')
@endsection
