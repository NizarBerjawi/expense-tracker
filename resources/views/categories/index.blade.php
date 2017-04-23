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
                        <div class="col-sm-12 pull-right">
                          <div class="btn-group">
                            <label for="delete" type="button" class="btn btn-space btn-danger">Delete</label>
                            <a href="{{ route('categories.create') }}" class="btn btn-space btn-primary">New</a>
                          </div>
                        </div>

                        @include('includes.mainTable', [
                            'page' => 'categories',
                            'empty_message' => 'You have not created any categories yet'
                        ])

                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
