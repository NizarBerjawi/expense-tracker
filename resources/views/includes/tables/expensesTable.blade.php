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
        @if ($expenses->isEmpty())
            <tr>
              <td colspan="6">{{ $emptyTableMessage }}</td>
            </tr>
        @else
            <form action="{{ $deleteExpensesRoute }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <input id="delete" class="hidden" type="submit" name="action" value="delete">

                @foreach($expenses as $expense)
                    <tr>
                        <td>
                            <div class="be-checkbox be-checkbox-sm">
                                <input id="expense-{{ $expense->id }}" type="checkbox" name="expense_ids[]" value="{{ $expense->id }}">
                                <label for="expense-{{ $expense->id }}"></label>
                            </div>
                        </td>
                        <td><a href="{{ route($showExpenseRouteName, $expense->id) }}">{{ $expense->name }}</td>
                        <td>${{ $expense->amount }}</td>
                        <td>{{ $expense->date }}</td>
                        @if (isset($expense->category))
                          <td class="text-center"><span class="label label-default">{{ $expense->category->name }}</span></td>
                        @else
                          <td class="text-center"><span class="label label-danger">None</span></td>
                        @endif
                        <td class="text-right">
                            <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                    <li><a href="{{ route($showExpenseRouteName, $expense->id) }}">View</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route($editExpenseRouteName, $expense->id) }}">Edit</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </form>
        @endif
    </tbody>
</table>
