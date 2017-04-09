@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                @include('includes.mainForm', [
                    'panelHeading'  => 'New Expense',
                    'panelSubtitle' => 'Create a new expense to add to your budget',
                    'formAction'    => route('expenses.store'),
                    'type'          => 'expense',
                    'disabled_form' => false,
                ])
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
<script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    //initialize the javascript
    App.init();
    App.formElements();
});
</script>
@endsection
