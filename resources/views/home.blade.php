@extends('layouts.dashboard')

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Latest Expenses</div>
                    <div class="panel-body">
                        <ul class="user-timeline user-timeline-compact">
                            @foreach($latestExpenses as $expense)
                            <li class="{{ $loop->first ? 'latest' : '' }}">
                                <div class="user-timeline-date">{{ $expense->date }}</div>
                                <div class="user-timeline-title">
                                    <a href="{{ route('expenses.show', $expense->id) }}">{{ $expense->name }}</a>
                                </div>
                                <div class="user-timeline-description">{{ $expense->description }}</div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Latest Income</div>
                    <div class="panel-body">
                        <ul class="user-timeline user-timeline-compact">
                            @foreach($latestIncome as $income)
                            <li class="{{ $loop->first ? 'latest' : '' }}">
                                <div class="user-timeline-date">{{ $income->date }}</div>
                                <div class="user-timeline-title">
                                    <a href="{{ route('income.show', $income->id) }}">{{ $income->name }}</a>
                                </div>
                                <div class="user-timeline-description">{{ $income->description }}</div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">Current Progress<span class="panel-subtitle">This is the user current progress widget</span></div>
                    <div class="panel-body">
                        @foreach($expenseCategories as $category)
                        <div class="row user-progress">
                            <div class="col-md-10"><span class="title">{{ $category->name }}</span>
                                <div class="progress">
                                    <div style="width: {{ $category->getPercentage() }}%" class="progress-bar progress-bar-primary"></div>
                                </div>
                            </div>
                            <div class="col-md-2"><span class="value">{{ $category->getPercentage() }}%</span></div>
                        </div>
                        @endforeach

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
<script src="{{ asset('lib/jquery-flot/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery-flot/jquery.flot.pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery-flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery-flot/plugins/jquery.flot.orderBars.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery-flot/plugins/curvedLines.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery.sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/countup/countUp.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jqvmap/jquery.vmap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app-dashboard.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    //initialize the javascript
    App.init();
    App.dashboard();

});
</script>
@endsection
