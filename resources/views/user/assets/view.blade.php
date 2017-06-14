@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    @include('includes.partials.breadcrumbs', [
        'pageTitle' => 'View Asset',
        'levels'    => [
                        'Home'       => route('dashboard'),
                        'Profile'    => route('user.profiles.create'),
                        'Edit'     => ''
                       ]
    ])
    <div class="main-content container-fluid">
        <!-- Messages -->
        @include('includes.partials.messages')

        <!-- Main Form -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">View Asset
                    <div class="tools">
                        <a href='{{ route("user.accounts.edit", $account->id) }}' type="submit" class="btn btn-space btn-primary">Edit</a>
                    </div>
                </div>
                <div class="panel-body">
                    @include('includes.forms.liquidAssetsForm', [
                        'formAction'    => '',
                        'csrfField'     => '',
                        'methodField'   => '',
                        'cancelRoute'   => route('user.profiles.index'),
                        'submit'        => 'View Asset',
                        'disabled'      => true
                    ])
                </div>
            </div>

            @include('includes.partials.deleteItem', [
                'deleteRoute' => route('user.assets.destroy', $asset->id),
                'itemId'      => $asset->id
            ])
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
