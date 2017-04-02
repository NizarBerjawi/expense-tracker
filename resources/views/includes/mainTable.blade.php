<div class="panel panel-default panel-table">
    <div class="panel-heading">{{ $panelHeading }}
        <div class="tools"><span class="icon mdi mdi-download"></span></div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width:5%;">
                        <div class="be-checkbox be-checkbox-sm">
                            <input id="check1" type="checkbox">
                            <label for="check1"></label>
                        </div>
                    </th>
                    <th style="width:20%;">Expense</th>
                    <th style="width:17%;">Amount</th>
                    <th style="width:15%;">Date</th>
                    <th style="width:10%;">Category</th>
                    <th style="width:10%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="be-checkbox be-checkbox-sm">
                            <input id="check2" type="checkbox">
                            <label for="check2"></label>
                        </div>
                    </td>
                    <td class="cell-detail"><span>Penelope Thornton</span><span class="cell-detail-description">Developer</span></td>
                    <td>$100</td>
                    <td>02/04/2017</td>
                    <td>Food</td>
                    <td class="text-right">
                        <div class="btn-group btn-hspace">
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
