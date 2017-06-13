<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:5%;">ID
                @include('includes.partials.tableSort', [
                    'columnName' => 'categories.id'
                ])
            </th>
            <th style="width:20%;">Name
                @include('includes.partials.tableSort', [
                    'columnName' => 'categories.name'
                ])
            </th>
            <th class="text-center" style="width:20%;">Tag
                @include('includes.partials.tableSort', [
                    'columnName' => 'categories.tag_id'
                ])
            </th>
            <th style="width:10%;"></th>
        </tr>
    </thead>

    <tbody>
        @if ($categories->isEmpty())
            <tr>
                <td colspan="4">{{ $emptyTableMessage }}</td>
            </tr>
        @else
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('user.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td class="text-center"><span class="label label-default">{{ $category->tag->name }}</span></td>
                    <td class="text-right">
                        <div class="btn-group btn-hspace">
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="{{ route($showCategoryRouteName, $category->id) }}">View</a></li>
                                <li><a href="{{ route($editCategoryRouteName, $category->id) }}">Edit</a></li>
                                <li class="divider"></li>
                                <li><a class="actions" data-target="#delete-modal" type="button" href="{{ route($deleteCategoryRouteName, $category->id) }}">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
