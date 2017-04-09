@extends('layouts.dashboard')

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Expenses
                        <div class="tools">
                            <span class="icon mdi mdi-download"></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12 btn-group btn-space">
                            <a href="{{ route('expenses.create') }}" class="btn btn-space btn-primary pull-right">New</a>
                            <button class="btn btn-space btn-default pull-right">Delete</button>
                        </div>

                        @include('includes.mainTable', [
                            'type'          => 'expense',
                            'empty_message' => 'You have not created any expenses yet'
                        ])

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    //initialize the javascript
    App.init();
});
</script>
@endsection
