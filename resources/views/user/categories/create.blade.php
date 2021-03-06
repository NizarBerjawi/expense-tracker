@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/jquery.gritter/css/jquery.gritter.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Categories',
            'levels'    => [
                            'Home'       => route('dashboard'),
                            'Categories' => route('user.categories.index'),
                            'Create'     => ''
                           ]
        ])
        <div class="main-content container-fluid">
            <!-- Messages -->
            @include('includes.partials.messages')

            <!-- Main Form -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('includes.mainForm', [
                        'resource'      => 'categories',
                        'panelHeading'  => 'New Category',
                        'formAction'    => route('user.categories.store'),
                        'cancelRoute'   => route('user.categories.index'),
                        'methodField'   => method_field('POST'),
                        'disabled'      => false,
                        'button'        => 'Add'
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
  <script src="{{ asset('lib/jquery.gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/js/app-ui-notifications.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
      $(document).ready(function(){
          App.formElements();
          App.uiNotifications();
      });
  </script>
@endsection
