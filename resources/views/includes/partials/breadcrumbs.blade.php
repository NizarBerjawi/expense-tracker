<div class="page-head">
    <h2 class="page-head-title">{{ $pageTitle }}</h2>
    <ol class="breadcrumb page-head-nav">
        @foreach($levels as $level => $route)
            @if (empty($route))
                <li class="active">{{ $level }}</li>
            @else
                <li><a href="{{ $route }}">{{ $level}}</a></li>
            @endif
        @endforeach
    </ol>
</div>
