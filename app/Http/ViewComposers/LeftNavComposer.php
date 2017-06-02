<?php

namespace App\Http\ViewComposers;

use App\Http\Traits\StatisticsTrait;
use Illuminate\View\View;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;

class LeftNavComposer
{
    use StatisticsTrait;

    /**
     * An instance of the Expense model
     *
     * @var App\Models\Expense
     */
    private $expense;

    /**
     * An instance of the Income model
     *
     * @var App\Models\Income
     */
    private $income;

    /**
     * Instantiate an instance of the dashboard composer
     *
     * @param App\Models\Expense $expense
     * @return void
     */
    public function __construct(Expense $expense, Income $income)
    {
        $this->expense = $expense;
        $this->income = $income;
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
        // Get the total expenses for the month
        $expensesTotal = $this->totalBetween($this->expense, $firstDay, $lastDay);
        // Get the total expenses for the month
        $incomeTotal = $this->totalBetween($this->income, $firstDay, $lastDay);
        // Percentage of income spent
        $percentage = round($expensesTotal/$incomeTotal * 100, 2);
        // Send the data to the view
        $view->with(compact('percentage'));
    }
}
