@extends('layouts.dashboard')

@section('styles')
@endsection

@section('content')
<div class="be-content">
    @include('includes.partials.breadcrumbs', [
        'pageTitle' => 'Profile',
        'levels'    => [
                        'Home'       => route('dashboard'),
                        'Profile'    => ''
                       ]
    ])
    <div class="main-content container-fluid">
        <!-- Messages -->
        @include('includes.partials.messages')

        <div class="user-profile">
            <div class="row">

                @if (!$user->profile)
                    <div class="col-md-5">
                        <div class="user-info-list panel panel-default">
                            <div class="panel-heading panel-heading-divider">About Me</div>
                            <div class="panel-body">
                                <div class="row text-center">
                                    <a href="{{ route('user.profiles.create') }}" class="btn btn-space btn-primary">Create Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-5">
                        <div class="user-display">
                            <div class="user-display-bg">
                                <img src="{{ asset('img/user-profile-display.png') }}" alt="Profile Background">
                            </div>
                            <div class="user-display-bottom">
                                <div class="user-display-avatar"><img src="{{ asset('img/avatar-150.png') }}" alt="Avatar"></div>
                                <div class="user-display-info">
                                    <div class="name">{{ $user->profile->first_name . ' ' . $user->profile->last_name }}</div>
                                    <div class="nick"><span class="mdi mdi-account"></span> KDonny</div>
                                </div>
                                <div class="row user-display-details">
                                    <div class="col-xs-4">
                                        <div class="title">Expenses</div>
                                        <div class="counter">{{ $user->expenses->count() }}</div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="title">Income</div>
                                        <div class="counter">{{ $user->income->count() }}</div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="title">Categories</div>
                                        <div class="counter">{{ $user->categories->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="user-info-list panel panel-default">
                            <div class="panel-heading panel-heading-divider">About Me
                                <div class="tools"><a href="{{ route('user.profiles.edit') }}" class="icon mdi mdi-edit"></a></div>
                            </div>
                            <div class="panel-body">
                                <table class="no-border no-strip skills">
                                    <tbody class="no-border-x no-border-y">
                                        <tr>
                                            <td class="icon"><span class="mdi mdi-case"></span></td>
                                            <td class="item">Full Name<span class="icon s7-portfolio"></span></td>
                                            <td>{{ $user->profile->first_name . ' ' . $user->profile->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="icon"><span class="mdi mdi-case"></span></td>
                                            <td class="item">Ocupation<span class="icon s7-portfolio"></span></td>
                                            <td>{{ $user->profile->occupation }}</td>
                                        </tr>
                                        <tr>
                                            <td class="icon"><span class="mdi mdi-cake"></span></td>
                                            <td class="item">Birthday<span class="icon s7-gift"></span></td>
                                            <td>{{ $user->profile->date_of_birth }}</td>
                                        </tr>
                                        <tr>
                                            <td class="icon"><span class="mdi mdi-smartphone-android"></span></td>
                                            <td class="item">Phone<span class="icon s7-phone"></span></td>
                                            <td>{{ $user->profile->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-7">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Bank Accounts
                            <div class="tools">
                                <a href="{{ route('user.banks.create') }}" type="button" class="btn btn-space btn-primary pull-right" data-target="#create-bank-account">New</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('includes.tables.bankAccountsTable', [
                                'showBankAccountRouteName'   => 'user.banks.show',
                                'editBankAccountRouteName'   => 'user.banks.edit',
                                'deleteBankAccountRouteName' => 'user.banks.destroy',
                                'emptyTableMessage'          => 'You have not added any bank accounts yet',
                            ])
                        </div>
                    </div>

                    <div class="col-sm-12 text-center">
                        {{ $bankAccounts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection

@section('modals')
@endsection
