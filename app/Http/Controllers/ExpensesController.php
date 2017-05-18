<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetResourceController;
use App\Controllers\Traits\ValidatesCategory;
use Illuminate\Http\Request;
use App\Models\Expense;
use Validator;

class ExpensesController extends BudgetResourceController
{
    use ValidatesCategory;

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
     *
     *
     * @return string
     */
    protected function resourceName()
    {
        return 'expenses';
    }
}
