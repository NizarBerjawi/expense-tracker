@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.gritter/css/jquery.gritter.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Categories',
            'levels'    => [
                            'Home'       => route('dashboard'),
                            'Categories' => ''
                           ]
        ])
        <div class="main-content container-fluid">
            <!-- Messages -->
           @include('includes.partials.messages')

            <!-- Main table-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Categories
                            <div class="tools">
                                <a href="{{ route('user.categories.create') }}" class="btn btn-space btn-primary pull-right">New</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('includes.tables.categoriesTable', [
                                'deleteCategoryRoute'     => route('user.categories.destroy'),
                                'showCategoryRouteName'   => 'user.categories.show',
                                'editCategoryRouteName'   => 'user.categories.edit',
                                'deleteCategoryRouteName' => 'user.categories.destroy',
                                'emptyTableMessage'       => 'You have not created any categories yet'
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

@section('scripts')
    <script src="/js/table-actions.js" type="text/javascript"></script>
    <script src="{{ asset('lib/jquery.gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/app-ui-notifications.js') }}" type="text/javascript"></script>
@endsection

@section('modals')
    @if (!$categories->isEmpty())
        @include('includes.modals.confirmDelete', [
            'confirmation_text' => 'Are you sure you want to delete the selected category?'
        ])
    @endif
@endsection
