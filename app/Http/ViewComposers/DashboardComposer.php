<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Category;

class DashboardComposer
{
    /**
    * Bind data to the view
    *
    * @param View $view
    * @return void
    */
    public function compose(View $view)
    {
        // Get the latest three expenses
        $latestExpenses = Expense::where('user_id', Auth::id())
                                 ->orderBy('date', 'desc')
                                 ->take(3)
                                 ->get();
        // Get the latest three expenses
        $latestIncome = Income::where('user_id', Auth::id())
                              ->orderBy('date', 'desc')
                              ->take(3)
                              ->get();


        $expenseCategories = Category::whereHas('tag', function($query) {
                                         $query->where('name', 'Expense');
                                     })
                                     ->where('user_id', Auth::id())
                                     ->with('expenses')
                                     ->get();
        // Send the data to the view
        $view->with(compact('latestExpenses', 'latestIncome', 'expenseCategories'));
    }
}
