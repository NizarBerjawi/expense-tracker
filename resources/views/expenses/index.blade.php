@extends('layouts.dashboard')

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <!--Responsive table-->
        <div class="row">
            <div class="col-sm-12">
                @include('includes.mainTable', [
                    'panelHeading'  => 'Expenses',
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
<script type="text/javascript">
$(document).ready(function(){
    //initialize the javascript
    App.init();
});
</script>
@endsection
