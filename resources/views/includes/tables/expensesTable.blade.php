<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:5%;">ID
                @include('includes.partials.tableSort', [
                    'columnName' => 'expenses.id'
                ])
            </th>
            <th style="width:20%;">Name
                @include('includes.partials.tableSort', [
                    'columnName' => 'expenses.name'
                ])
            </th>
            <th style="width:17%;">Amount
                @include('includes.partials.tableSort', [
                    'columnName' => 'expenses.amount'
                ])
            </th>
            <th style="width:15%;">Date
                @include('includes.partials.tableSort', [
                    'columnName' => 'expenses.date'
                ])
            </th>
            <th class="text-center" style="width:10%;">Category
                @include('includes.partials.tableSort', [
                    'columnName' => 'expenses.category_id'
                ])
            </th>
            <th style="width:10%;"></th>
        </tr>
    </thead>
    <tbody>
        @if ($expenses->isEmpty())
            <tr>
              <td colspan="6">{{ $emptyTableMessage }}</td>
            </tr>
        @else
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
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
                                <li><a href="{{ route($editExpenseRouteName, $expense->id) }}">Edit</a></li>
                                <li class="divider"></li>
                                <li><a class="actions" data-target="#delete-modal" type="button" href="{{ route($deleteExpenseRouteName, $expense->id) }}">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
