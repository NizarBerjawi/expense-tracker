@extends('layouts.dashboard')

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <!-- Error Messages -->
        @include('includes.errorMessages')

        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Income
                        <div class="tools">
                            <span class="icon mdi mdi-download"></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('includes.partials.actions', [
                            'newItemRoute' => route('income.create')
                        ])

                        @include('includes.tables.incomeTable', [
                            'deleteIncomeRoute'   => route('income.destroy'),
                            'showIncomeRouteName'  => 'income.show',
                            'editIncomeRouteName'  => 'income.edit',
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

@section('modals')
    @include('includes.modals.confirmDelete', [
        'confirmation_text' => 'Are you sure you want to delete the selected income?'
    ])
@endsection
