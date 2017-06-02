<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\TableBaseComposer;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpensesTableComposer extends TableBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request, Expense $expense)
    {
        $this->currentPage = $request->page;
        $this->dir = $request->dir;
        $this->col = $request->col;
        $this->model = $expense;
    }

    /**
     * The name of the resource being queried
     *
     * @return string
     */
    protected function resourceName() : string
    {
        return 'expenses';
    }

    /**
     * The name of the relationship being returned with the
     * main resource. For example, a category is queried with expense.
     *
     * @return string
     */
    protected function with() : string
    {
        return 'category';
    }
}
