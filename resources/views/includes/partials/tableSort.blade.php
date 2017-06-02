
<a href="{{ route(Route::currentRouteName(), ['dir' => 'desc', 'col' => $columnName]) }}" class="@if ($col == $columnName and $dir == 'desc') text-danger @endif">
    <span class="icon mdi mdi-triangle-up"></span>
</a>
<a href="{{ route( Route::currentRouteName(), ['dir' => 'asc', 'col' => $columnName]) }}" class="@if ($col == $columnName and $dir == 'asc') text-danger @endif">
    <span class="icon mdi mdi-triangle-down"></span>
</a>
