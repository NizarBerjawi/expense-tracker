@extends('layouts.dashboard')

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        @include('includes.errorMessages')
        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Categories
                        <div class="tools">
                            <span class="icon mdi mdi-download"></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('includes.partials.actions', [
                            'newItemRoute' => route('categories.create')
                        ])

                        @include('includes.tables.categoriesTable', [
                            'deleteCategoryRoute'   => route('categories.destroy'),
                            'showCategoryRouteName' => 'categories.show',
                            'editCategoryRouteName' => 'categories.edit',
                            'emptyTableMessage'     => 'You have not created any categories yet'
                        ])
                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @include('includes.modals.confirmDelete', [
        'confirmation_text' => 'Are you sure you want to delete the selected categories?'
    ])
@endsection
