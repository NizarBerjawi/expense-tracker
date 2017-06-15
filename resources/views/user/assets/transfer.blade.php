@extends('layouts.dashboard')

@section('styles')
@endsection

@section('content')
<div class="be-content">
    @include('includes.partials.breadcrumbs', [
        'pageTitle' => 'Transfer Asset',
        'levels'    => [
                        'Home'       => route('dashboard'),
                        'Profile'    => route('user.profiles.index'),
                        'Edit'     => ''
                       ]
    ])
    <div class="main-content container-fluid">
        <!-- Messages -->
        @include('includes.partials.messages')

        <!-- Main Form -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">Transfer Asset</div>
                <div class="panel-body">
                    @include('includes.forms.transferAmountForm', [
                        'formAction'    => route('user.assets.doTransfer'),
                        'csrfField'     => csrf_field(),
                        'methodField'   => method_field('PUT'),
                        'cancelRoute'   => route('user.profiles.index'),
                        'submit'        => 'Update Asset',
                        'disabled'      => false
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
