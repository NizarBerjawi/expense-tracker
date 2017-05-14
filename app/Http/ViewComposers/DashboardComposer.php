<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Category;
use Carbon\Carbon;

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
        $today = Carbon::today();
        $month = $today->format('F');
        $firstDay = new Carbon('first day of this month');
        $lastDay = new Carbon('last day of this month');

        // Get the latest five expenses
        $latestExpenses = Expense::byUser(Auth::id())
                                 ->orderByDate('desc')
                                 ->take(5)
                                 ->get();

        // Get the user's top five categories by expense amount for this month
        $expenseCategories = Category::withExpenseTotal()
                                     ->before($lastDay)
                                     ->after($firstDay)
                                     ->byUser(Auth::id())
                                     ->orderBy('amount', 'desc')
                                     ->take(5)
                                     ->get();

        // Get the authenticated user's total Expenses
        $totalExpenses = Expense::byUser(Auth::id())
                                ->before($lastDay)
                                ->after($firstDay)
                                ->sum('amount');

        // Calculate the percentage of each category
        $expenseCategories = $expenseCategories->map(
            function($category, $key) use ($totalExpenses) {
                $category->percentage = round($category->amount / $totalExpenses * 100, 2);
                return $category;
            }
        );

        // Send the data to the view
        $view->with(compact('latestExpenses', 'expenseCategories', 'month'));
    }
}
