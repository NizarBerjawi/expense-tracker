<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:5%;">
                <div class="be-checkbox be-checkbox-sm">
                    <input id="check1" type="checkbox">
                    <label for="check1"></label>
                </div>
            </th>
            @if($page == 'expenses' or $page == 'income')
                <th style="width:20%;">Name</th>
                <th style="width:17%;">Amount</th>
                <th style="width:15%;">Date</th>
                <th class="text-center" style="width:10%;">Category</th>
                <th style="width:10%;"></th>
            @elseif ($page == 'categories')
                <th style="width:20%;">Name</th>
                <th class="text-center" style="width:20%;">Tag</th>
                <th style="width:10%;"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if($page == 'expenses' or $page == 'income')
            @if ($items->isEmpty())
                <tr>
                  <td colspan="6">{{ $empty_message }}</td>
                </tr>
            @else
              <form>
                {{ method_field('DELETE') }}
                @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="be-checkbox be-checkbox-sm">
                                <input id="check2" type="checkbox">
                                <label for="check2"></label>
                            </div>
                        </td>
                        <td><a href="{{ route($routeShow, $item->id) }}">{{ $item->name }}</td>
                        <td>${{ $item->amount }}</td>
                        <td>{{ $item->date }}</td>
                        @if (isset($item->category))
                          <td class="text-center"><span class="label label-default">{{ $item->category->name }}</span></td>
                        @else
                          <td class="text-center"><span class="label label-danger">None</span></td>
                        @endif
                        <td class="text-right">
                            <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                    <li><a href="{{ route($routeShow, $item->id) }}">View</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route($routeEdit, $item->id) }}">Edit</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
              </form>
            @endif
        @elseif ($page == 'categories')
            @if ($items->isEmpty())
                <tr>
                    <td colspan="4">{{ $empty_message }}</td>
                </tr>
            @else
              <form action="{{ route('categories.destroy') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <input id="delete" class="hidden" type="submit" name="action" value="delete">

                @foreach($items as $category)
                    <tr>
                        <td>
                            <div class="be-checkbox be-checkbox-sm">
                                <input id="category-{{ $category->id }}" type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                                <label for="category-{{ $category->id }}"></label>
                            </div>
                        </td>
                        <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                        <td class="text-center"><span class="label label-default">{{ $category->tag->name }}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                    <li><a href="{{ route('categories.show', $category->id) }}">View</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('categories.edit', $category->id) }}">Edit</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endif
    </tbody>
</table>
