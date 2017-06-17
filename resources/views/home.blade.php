@extends('layouts.dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/morrisjs/morris.css') }}"/>
@endsection

@section('content')
    <div class="be-content">
        @include('includes.partials.breadcrumbs', [
            'pageTitle' => 'Dashboard',
            'levels'    => [
                            'Home'       => route('dashboard'),
                           ]
        ])
        <div class="main-content container-fluid">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">
                        <div class="tools">
                            @if (!$years->isEmpty())
                            <select id="expenses-year" class="form-control">
                                @foreach($years as $year)
                                    <option {{ $year->year == $today->year ? 'selected' : '' }}> {{ $year->year }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div><span class="title">Line Chart</span>
                        <span class="panel-subtitle">Monthly variation of expenses against income</span>
                    </div>
                    <div class="panel-body">
                    @if ($years->isEmpty())
                        <div>You have not added any expenses recently!</div>
                    @else
                        <div id="line-loader"></div>
                        <div id="line-chart" style="height: 250px;"></div>
                    @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">Top Expense Categories of {{ $month }}</div>
                    <div class="panel-body">
                        @if ($categories->isEmpty())
                            <div>You have not added any expenses recently!</div>
                        @else
                            @foreach($categories as $category)
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
                                            <a href="{{ route('user.expenses.show', $expense->id) }}">{{ $expense->name }}</a>
                                        </div>
                                        <div class="user-timeline-description">{{ $expense->description }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
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
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            if ($('#expenses-year').length) {
                App.chartsMorris();
            }
            App.formElements();
        });
    </script>
@endsection
