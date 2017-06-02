<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use App\Http\Traits\StatisticsTrait;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;

class ChartsAjaxController extends Controller
{
    use StatisticsTrait;

    /**
     * An expense instance
     *
     * @var App\Models\Expense
     */
    protected $expense;

    /**
     * An income instance
     *
     * @var App\Models\Income
     */
    protected $income;

    /**
     * Create a new controller instance.
     *
     * @param App\Models\Expense
     * @param App\Models\Income
     * @return void
     */
    public function __construct(Expense $expense, Income $income)
    {
        $this->expense = $expense;
        $this->income = $income;
    }

    /**
     * Get the total expenses and income for every month in a specific
     * year. If a year is not specified, get the data for the
     * current year.
     *
     * @param int $year
     * @return Response
     */
    public function monthlyExpenseData(int $year = null)
    {
        // If a year is not provided, use the current year
        if (!$year) {
            $year = Carbon::today()->year;
        }
        // Get the monthly expense totals for a specific year
        $expenseTotals = $this->monthlyTotalsByYear($this->expense, $year);
        // Get the monthly income totals for a specific year
        $incomeTotals = $this->monthlyTotalsByYear($this->income, $year);

        // The array that will contain all the data
        $data = array();

        for($month = 1; $month <= 12; $month++) {
            // Date string
            $date = sprintf("%d-%02d", $year, $month);
            $temp = [
                "month"     => $date,
                "expenses"  => 0,
                "income"    => 0
            ];

            // Try to find the expense total by date
            $expenses = $expenseTotals->where('month', $date)->first();
            // Try to find the income total by date
            $income = $incomeTotals->where('month', $date)->first();

            if ($expenses) {
                $temp['expenses'] = $expenses->total;
            }

            if ($income) {
                $temp['income'] = $income->total;
            }

            $data[] = $temp;
        }

        return response()->json($data);
    }

    /**
     *
     *
     *
     */
    public function dailyExpenses(int $month = null, int $year = null)
    {
        // Get the daily expenses
        $expenses = $this->getDailydata($this->expense)
                         ->toArray();
        return response()->json($expenses);
    }
}
