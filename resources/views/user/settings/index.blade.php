@extends('layouts.dashboard')

@section('styles')
@endsection

@section('content')
<div class="be-content">
    @include('includes.partials.breadcrumbs', [
        'pageTitle' => 'Account Settings',
        'levels'    => [
                        'Home'       => route('dashboard'),
                        'Settings'   => ''
                       ]
    ])
    <div class="main-content container-fluid">
        <!-- Messages -->
        @include('includes.partials.messages')

        <!-- Password Reset Form -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">
                    Change Password
                </div>
                <div class="panel-body">
                    @include('includes.forms.passwordResetForm', [
                        'formAction'  => route('user.accounts.update'),
                        'methodField' => method_field('PUT'),
                        'csrfField'   => csrf_field(),
                        'cancelRoute' => route('dashboard'),
                        'submit'      => 'Update Password'
                    ])
                </div>
            </div>
        </div>

        <!-- Account Deactivation Form -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-border-color panel-border-color-danger">
                <div class="panel-heading panel-heading-divider">
                    Danger Zone
                </div>
                <div class="panel-body">
                    @include('includes.forms.deactivationForm', [
                        'formAction'  => route('user.accounts.destroy'),
                        'methodField' => method_field('DELETE'),
                        'csrfField'   => csrf_field(),
                        'submit'      => 'Deactivate Account'
                    ])
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection

@section('modals')
@endsection
