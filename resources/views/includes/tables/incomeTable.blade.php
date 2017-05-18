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
            <th style="width:17%;">Amount</th>
            <th style="width:15%;">Date</th>
            <th class="text-center" style="width:10%;">Category</th>
            <th style="width:10%;"></th>
        </tr>
    </thead>
    <tbody>
        @if ($income->isEmpty())
            <tr>
              <td colspan="6">{{ $emptyTableMessage }}</td>
            </tr>
        @else
            <form action="{{ $deleteIncomeRoute }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <input id="delete" class="hidden" type="submit" name="action" value="delete">

                @foreach($income as $income)
                    <tr>
                        <td>
                            <div class="be-checkbox be-checkbox-sm">
                                <input id="income-{{ $income->id }}" type="checkbox" name="ids[]" value="{{ $income->id }}">
                                <label for="income-{{ $income->id }}"></label>
                            </div>
                        </td>
                        <td><a href="{{ route($showIncomeRouteName, $income->id) }}">{{ $income->name }}</td>
                        <td>${{ $income->amount }}</td>
                        <td>{{ $income->date }}</td>
                        @if (isset($income->category))
                          <td class="text-center"><span class="label label-default">{{ $income->category->name }}</span></td>
                        @else
                          <td class="text-center"><span class="label label-danger">None</span></td>
                        @endif
                        <td class="text-right">
                            <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                    <li><a href="{{ route($showIncomeRouteName, $income->id) }}">View</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route($editIncomeRouteName, $income->id) }}">Edit</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </form>
        @endif
    </tbody>
</table>
