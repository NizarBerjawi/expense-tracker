<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetResourceController;
use App\Models\Income;

class IncomeController extends BudgetResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Income $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    /**
     * The resource name
     *
     * @return string
     */
    protected function resourceName()
    {
        return 'income';
    }
}
