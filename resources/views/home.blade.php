@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/morrisjs/morris.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-divider">
                            <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div><span class="title">Line Chart</span><span class="panel-subtitle">This is a line chart description</span>
                        </div>
                        <div class="panel-body">
                            <div id="line-chart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-divider">Latest Expenses</div>
                        <div class="panel-body">
                            @if($latestExpenses->isEmpty())
                                <div>You have not added any expenses recently!</div>
                            @else
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
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-divider">Top Expense Categories of {{ $month }}
                            <!-- <span class="panel-subtitle">This is the user current progress widget</span> -->
                        </div>
                        <div class="panel-body">
                            @if($expenseCategories->isEmpty())
                                <div>You have not added any expenses recently!</div>
                            @else
                                @foreach($expenseCategories as $category)
                                    <div class="row user-progress">
                                        <div class="col-md-10"><span class="title">{{ $category->name }}</span>
                                            <div class="progress">
                                                <div style="width: {{ $category->percentage }}%" class="progress-bar progress-bar-primary"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><span class="value">{{ $category->percentage }}%</span></div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- <script src="{{ asset('js/app-dashboard.js') }}" type="text/javascript"></script> -->
    <script src="{{ asset('lib/raphael/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/morrisjs/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-charts-morris.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        App.init();
        //initialize the javascript
        App.chartsMorris();
    });
    </script>
@endsection
