@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <!-- Messages -->
            @include('includes.partials.messages')

            <!-- Main Form -->
            <div class="row">
                <div class="col-sm-12">
                    @include('includes.mainForm', [
                        'page'          => 'income',
                        'panelHeading'  => 'Edit Income',
                        'panelSubtitle' => 'Edit this income\'s details',
                        'formAction'    => route('income.update', $income->id),
                        'cancelRoute'   => route('income.index'),
                        'methodField'   => method_field('PUT'),
                        'disabled'      => false,
                        'button'        => 'Update'
                    ])
                </div>
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
