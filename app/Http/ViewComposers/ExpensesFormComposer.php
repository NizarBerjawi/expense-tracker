<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\FormBaseComposer;
use Illuminate\Http\Request;
use App\Models\LiquidAsset;
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
            case 'user.expenses.create':
                // All the user categories to be displayed in select
                $categories = Category::where('user_id', Auth::id())
                                      ->byTagName(['expenses'])
                                      ->get();
                // All the user bank accounts to be displayed in select
                $assets = LiquidAsset::where('user_id', Auth::id())
                                           ->get();
                return compact('categories', 'assets');
            case 'user.expenses.show':
                // The expense being edited
                $expense = Expense::where('id', $this->id)
                                  ->where('user_id', Auth::id())
                                  ->with(['category', 'liquidAsset'])
                                  ->first();
                return compact('expense');
            case 'user.expenses.edit':
                // The expense being edited
                $expense = Expense::where('id', $this->id)
                                  ->where('user_id', Auth::id())
                                  ->with(['category', 'liquidAsset'])
                                  ->first();
                // All the user bank accounts to be displayed in select
                $assets = LiquidAsset::where('user_id', Auth::id())
                                           ->get();
                // All the user categories to be displayed in select
                $categories = Category::where('user_id', Auth::id())
                                      ->byTagName(['expenses'])
                                      ->get();
                return compact('expense', 'categories', 'assets');
        }
    }
}
