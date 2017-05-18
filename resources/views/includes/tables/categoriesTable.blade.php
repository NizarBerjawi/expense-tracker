<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:5%;">
                <div class="be-checkbox be-checkbox-sm">
                    <input id="check1" type="checkbox">
                    <label for="check1"></label>
                </div>
            </th>
            <th style="width:20%;">Name</th>
            <th class="text-center" style="width:20%;">Tag</th>
            <th style="width:10%;"></th>
        </tr>
    </thead>

    <tbody>
        @if ($categories->isEmpty())
            <tr>
                <td colspan="4">{{ $emptyTableMessage }}</td>
            </tr>
        @else
          <form action="{{ $deleteCategoryRoute }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <input id="delete" class="hidden" type="submit" name="action" value="delete">

            @foreach($categories as $category)
                <tr>
                    <td>
                        <div class="be-checkbox be-checkbox-sm">
                            <input id="category-{{ $category->id }}" type="checkbox" name="ids[]" value="{{ $category->id }}">
                            <label for="category-{{ $category->id }}"></label>
                        </div>
                    </td>
                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td class="text-center"><span class="label label-default">{{ $category->tag->name }}</span></td>
                    <td class="text-right">
                        <div class="btn-group btn-hspace">
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="{{ route($showCategoryRouteName, $category->id) }}">View</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route($editCategoryRouteName, $category->id) }}">Edit</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
