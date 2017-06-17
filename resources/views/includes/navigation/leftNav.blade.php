<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    @if (!Auth::user()->isFirstLogin())
                    <ul class="sidebar-elements">
                        <li class="divider">Home</li>
                        <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a></li>
                        <li class="{{ Route::currentRouteName() == 'calendar' ? 'active' : '' }}"><a href="{{ route('calendar') }}"><i class="icon mdi mdi-calendar"></i><span>Calendar</span></a></li>
                        <li class="divider">Budget</li>
                        <li class="{{ Route::currentRouteName() == 'user.categories.index' ? 'active' : '' }}">
                            <a href="{{ route('user.categories.index') }}">
                                <i class="icon mdi mdi-collection-bookmark"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'user.expenses.index' ? 'active' : '' }}"><a href="{{ route('user.expenses.index') }}"><i class="icon mdi mdi-money-off"></i><span>Expenses</span></a></li>
                        <li class="{{ Route::currentRouteName() == 'user.income.index' ? 'active' : '' }}"><a href="{{ route('user.income.index') }}"><i class="icon mdi mdi-money-box"></i><span>Income</span></a></li>
                        <li class="divider">Summary</li>
                        <li>
                            @if (!Auth::user()->isFirstLogin())
                                <div class="progress-widget">
                                    <div class="progress-data"><span class="progress-value">{{ $percentage }}%</span><span class="name">Spendings</span></div>
                                    <div class="progress">
                                        <div style="width: {{ $percentage }}%;" class="progress-bar progress-bar-primary"></div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
