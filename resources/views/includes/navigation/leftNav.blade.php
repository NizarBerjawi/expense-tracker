<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Home</li>
                        <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a></li>
                        <li class="divider">Budget</li>
                        <li class="{{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="icon mdi mdi-money-off"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'expenses.index' ? 'active' : '' }}"><a href="{{ route('expenses.index') }}"><i class="icon mdi mdi-money-off"></i><span>Expenses</span></a></li>
                        <li class="{{ Route::currentRouteName() == 'income.index' ? 'active' : '' }}"><a href="{{ route('income.index') }}"><i class="icon mdi mdi-money-box"></i><span>Income</span></a></li>
                        <li class="divider">Summary</li>
                        <li class="{{ Route::currentRouteName() == 'calendar' ? 'active' : '' }}"><a href="{{ route('calendar') }}"><i class="icon mdi mdi-calendar"></i><span>Calendar</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-widget">
            <div class="progress-data"><span class="progress-value">{{ $percentage }}%</span><span class="name">Spendings</span></div>
            <div class="progress">
                <div style="width: {{ $percentage }}%;" class="progress-bar progress-bar-primary"></div>
            </div>
        </div>
    </div>
</div>
