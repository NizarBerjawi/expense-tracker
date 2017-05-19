<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetResourceController;
use App\Models\Expense;

class ExpensesController extends BudgetResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Expense $model)
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
        return 'expenses';
    }
}
