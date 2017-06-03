@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.gritter/css/jquery.gritter.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    @include('includes.partials.breadcrumbs', [
        'pageTitle' => 'Expenses',
        'levels'    => [
                        'Home'       => route('dashboard'),
                        'Expenses'   => '',
                       ]
    ])
    <div class="main-content container-fluid">
        <!-- Messages -->
        @include('includes.partials.messages')

        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Expenses
                        <div class="tools">
                            <a href="{{ route('expenses.create') }}" type="button" class="btn btn-space btn-primary pull-right" data-target="#create-resource">New</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('includes.tables.expensesTable', [
                            'deleteExpensesRoute'    => route('expenses.destroy'),
                            'showExpenseRouteName'   => 'expenses.show',
                            'editExpenseRouteName'   => 'expenses.edit',
                            'deleteExpenseRouteName' => 'expenses.destroy',
                            'emptyTableMessage'      => 'You have not added any expenses yet',
                        ])
                    </div>
                </div>

                <div class="col-sm-12 text-center">
                    {{ $expenses->links() }}
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
    @if (!$expenses->isEmpty())
        @include('includes.modals.confirmDelete', [
            'confirmation_text' => 'Are you sure you want to delete the selected expenses?'
        ])
    @endif
@endsection
