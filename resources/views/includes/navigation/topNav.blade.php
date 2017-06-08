<nav class="navbar navbar-default navbar-fixed-top be-top-header">
    <div class="container-fluid">
        <div class="navbar-header"><a href="{{ route('dashboard') }}" class="navbar-brand"></a></div>
        <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
                <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{ asset('img/avatar.png') }}" alt="Avatar"><span class="user-name">{{ Auth::user()->name }}</span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-position online">Available</div>
                            </div>
                        </li>
                        <li><a href="{{ route('user.profile.index') }}"><span class="icon mdi mdi-face"></span> Profile</a></li>
                        <li><a href="{{ url('/logout') }}" class="sc-color-text" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon mdi mdi-power"></span> Logout
                        </a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            </ul>
            <div class="page-title"><span>Expense Tracker</span></div>
        </div>
    </div>
</nav>
