<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:15%;">ID
                @include('includes.partials.tableSort', [
                    'columnName' => 'bank_accounts.id'
                ])
            </th>
            <th style="width:25%;">Name
                @include('includes.partials.tableSort', [
                    'columnName' => 'bank_accounts.name'
                ])
            </th>
            <th style="width:20%;">Bank
                @include('includes.partials.tableSort', [
                    'columnName' => 'bank_accounts.bank'
                ])
            </th>
            <th style="width:30%;">Balance
                @include('includes.partials.tableSort', [
                    'columnName' => 'bank_accounts.balance'
                ])
            </th>
            <th style="width:10%;"></th>
        </tr>
    </thead>
    <tbody>
        @if ($bankAccounts->isEmpty())
            <tr>
              <td colspan="6">{{ $emptyTableMessage }}</td>
            </tr>
        @else
            @foreach($bankAccounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td><a href="{{ route($showBankAccountRouteName, $account->id) }}">{{ $account->name }}</td>
                    <td>{{ $account->bank }}</td>
                    <td><span class="label label-default">{{ $account->balance }}</span></td>

                    <td class="text-right">
                        <div class="btn-group btn-hspace">
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="{{ route($showBankAccountRouteName, $account->id) }}">View</a></li>
                                <li><a href="{{ route($editBankAccountRouteName, $account->id) }}">Edit</a></li>
                                <li class="divider"></li>
                                <li><a class="actions" data-target="#delete-modal" type="button" href="{{ route($deleteBankAccountRouteName, $account->id) }}">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
