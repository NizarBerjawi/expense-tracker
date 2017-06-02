<?php

namespace App\Http\ViewComposers;

use App\Http\Traits\StatisticsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Auth;

class DashboardComposer
{
    use StatisticsTrait;

    /**
     * An instance of the Expense model
     *
     * @var App\Models\Expense
     */
    private $expense;

    /**
     * Instantiate an instance of the dashboard composer
     *
     * @param App\Models\Expense $expense
     * @return void
     */
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

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
        $latestExpenses = $this->getLatest($this->expense, 5);
        // Get the user's top five categories by expense amount for this month
        $expenseCategoriesTotals = $this->getCategoryTotals(
                                                    $this->expense,
                                                    $firstDay,
                                                    $lastDay,
                                                    5
                                                );
        // Get the authenticated user's total expenses
        $totalExpenses = $this->totalBetween(
                                            $this->expense,
                                            $firstDay,
                                            $lastDay
                                        );
        // Calculate the percentage of each category,
        // and add to the category object
        $categories = $this->calculatePercentages(
                                        $expenseCategoriesTotals,
                                        $totalExpenses
                                    );

        // Get the available expense years in the database
        // for the authenticated user
        $years =$this->getYears($this->expense);

        // Send the data to the view
        $view->with(compact('latestExpenses', 'categories', 'month', 'years', 'today'));
    }




}
