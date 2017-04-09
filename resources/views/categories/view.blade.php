@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                @include('includes.mainForm', [
                    'panelHeading'  => 'View Category',
                    'panelSubtitle' => 'View this category\'s details',
                    'formAction'    => '',
                    'methodField'   => '',
                    'type'          => 'category',
                    'disabled'      => true,
                ])
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    //initialize the form
    App.formElements();
});
</script>
@endsection
