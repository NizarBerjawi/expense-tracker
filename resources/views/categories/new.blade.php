@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        @include('includes.errorMessages')

        <!-- Main table-->
        <div class="row">
            <div class="col-sm-12">
                @include('includes.mainForm', [
                    'panelHeading'  => 'New Category',
                    'panelSubtitle' => 'Create a new category to group your income and expenses',
                    'formAction'    => route('categories.store'),
                    'methodField'   => method_field('POST'),
                    'page'          => 'categories',
                    'disabled'      => false,
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
