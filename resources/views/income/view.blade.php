@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <!-- Main table -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('includes.mainForm', [
                    'panelHeading'  => 'View Income',
                    'panelSubtitle' => 'View this income\'s details',
                    'formAction'    => '',
                    'methodField'   => '',
                    'page'          => 'income',
                    'disabled'      => true,
                ])
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            @include('includes.deleteItem', [
                'deleteRoute' => route('income.destroy', $income->id)
            ])
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    //initialize the form
    App.formElements();
});
</script>
@endsection
