<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\FormBaseComposer;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expense;
use Auth;

class ExpensesFormComposer extends FormBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request, Expense $expense)
    {
        $this->id = $request->expenseId;
        $this->model = $expense;
    }

    /**
     * Get the data to be sent to the view based on the
     * current route name.
     *
     * @param  string $routeName
     * @return Array
     */
    protected function getViewData(string $routeName)
    {
        // Prepare the data to be sent to the views
        switch($routeName) {
            case 'expenses.create':
                $categories = Category::where('user_id', Auth::id())
                                      ->byTagName(['expense'])
                                      ->get();
                return compact('categories');
            case 'expenses.show':
                $expense = Expense::where('id', $this->id)
                                  ->where('user_id', Auth::id())
                                  ->with('category')
                                  ->first();
                return compact('expense');
            case 'expenses.edit':
                $expense = Expense::where('id', $this->id)
                                  ->where('user_id', Auth::id())
                                  ->with('category')
                                  ->first();
                $categories = Category::where('user_id', Auth::id())
                                      ->byTagName(['expense'])
                                      ->get();
                return compact('expense', 'categories');
        }
    }
}
