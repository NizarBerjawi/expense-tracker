@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Categories',
            'levels'    => [
                            'Home'       => route('dashboard'),
                            'Categories' => route('categories.index'),
                            $category->id => '',
                            'View'       => '',
                           ]
        ])
        <div class="main-content container-fluid">
            <!-- Main Form -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('includes.mainForm', [
                        'resource'      => 'categories',
                        'model'         => $category,
                        'panelHeading'  => 'View Category',
                        'formAction'    => '',
                        'methodField'   => '',
                        'disabled'      => true,
                    ])
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                @include('includes.partials.deleteItem', [
                    'deleteRoute' => route('categories.destroy', $category->id),
                    'itemId'      => $category->id
                ])
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
