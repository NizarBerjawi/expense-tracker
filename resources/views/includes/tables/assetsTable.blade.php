<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="width:15%;">ID
                @include('includes.partials.tableSort', [
                    'columnName' => 'assets.id'
                ])
            </th>
            <th style="width:25%;">Name
                @include('includes.partials.tableSort', [
                    'columnName' => 'assets.name'
                ])
            </th>
            <th style="width:30%;">Balance
                @include('includes.partials.tableSort', [
                    'columnName' => 'assets.balance'
                ])
            </th>
            <th style="width:10%;"></th>
        </tr>
    </thead>
    <tbody>
        @if ($assets->isEmpty())
            <tr>
              <td colspan="6">{{ $emptyTableMessage }}</td>
            </tr>
        @else
            @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->id }}</td>
                    <td><a href="{{ route($showAssetRouteName, $asset->id) }}">{{ $asset->name }}</td>
                    <td><span class="label label-default">{{ $asset->balance }}</span></td>

                    <td class="text-right">
                        <div class="btn-group btn-hspace">
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="{{ route($showAssetRouteName, $asset->id) }}">View</a></li>
                                <li><a href="{{ route($editAssetRouteName, $asset->id) }}">Edit</a></li>
                                <li class="divider"></li>
                                <li><a class="actions" data-target="#delete-modal" type="button" href="{{ route($deleteAssetRouteName, $asset->id) }}">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
