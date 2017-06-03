@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.gritter/css/jquery.gritter.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Income',
            'levels'    => [
                            'Home'   => route('dashboard'),
                            'Income' => '',
                           ]
        ])
        <div class="main-content container-fluid">
            <!-- Messages -->
            @include('includes.partials.messages')

            <!-- Main table-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Income
                            <div class="tools">
                                <a href="{{ route('income.create') }}" class="btn btn-space btn-primary pull-right">New</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('includes.tables.incomeTable', [
                                'deleteIncomeRoute'     => route('income.destroy'),
                                'showIncomeRouteName'   => 'income.show',
                                'editIncomeRouteName'   => 'income.edit',
                                'deleteIncomeRouteName' => 'income.destroy',
                                'emptyTableMessage'     => 'You have not added any income yet',
                            ])
                        </div>
                    </div>

                    <div class="col-sm-12 text-center">
                        {{ $income->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/table-actions.js" type="text/javascript"></script>
    <script src="{{ asset('lib/jquery.gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/app-ui-notifications.js') }}" type="text/javascript"></script>
@endsection

@section('modals')
    @if (!$income->isEmpty())
        @include('includes.modals.confirmDelete', [
            'confirmation_text' => 'Are you sure you want to delete the selected income?'
        ])
    @endif
@endsection
