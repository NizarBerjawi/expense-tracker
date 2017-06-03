<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Auth;

trait StatisticsTrait
{
    /**
     * Get the total income or expenses for every month in
     * a specific year.
     *
     * @param  int $year
     * @return Collection
     */
    private function monthlyTotalsByYear(Model $model, int $year)
    {
        $table = $model->getSchema();
        return $model->where('user_id', Auth::id())
                     ->whereYear("$table.date", $year)
                     ->select(
                        DB::raw("DATE_FORMAT($table.date, '%Y-%m') as month"),
                        DB::raw("SUM($table.amount) as total")
                     )
                     ->groupBy('month')
                     ->orderBy('month', 'asc')
                     ->get();
    }

    /**
     * Get the daily income or expenses data by a specific
     * month and year
     *
     * @param  int $year
     * @return Collection
     */
    public function getDailydata(Model $model)
    {
        return $model->where('user_id', Auth::id())
                     ->with('category')
                     ->select(
                         'id',
                         'name as title',
                         'date as start',
                         'description',
                         'category_id',
                         'amount'
                     )
                     ->get();
    }

    /**
     * Get the latest budget items by date. The budget items
     * can either be expenses or income.
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @param  int $limit
     * @return Collection
     */
    private function getLatest(Model $model, int $limit)
    {
        return $model->where('user_id', Auth::id())
                     ->orderByDate('desc')
                     ->take($limit)
                     ->get();
    }

    /**
     * Get the total of either the income or the expenses
     * between two specified dates.
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @param  Carbon\Carbon $first
     * @param  Carbon\Carbon $last
     * @return Collection
     */
    private function totalBetween(Model $model, $first, $last)
    {
        return $model->where('user_id', Auth::id())
                     ->before($last)
                     ->after($first)
                     ->sum('amount');
    }

    /**
     * Get the years that the specified model spans.
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @return Collection
     */
    private function getYears(Model $model)
    {
        return $model->where('user_id', Auth::id())
                     ->select(DB::raw('DATE_FORMAT(date, "%Y") as year'))
                     ->orderBy('year')
                     ->distinct()
                     ->get();
    }

    /**
     * Get category totals based on the specified model. For example,
     * if an Income model is provided, get all the income categories
     * with their income total.
     *
     * @param  Illuminate\Database\Eloquent\Model
     * @param  Carbon\Carbon $first
     * @param  Carbon\Carbon $last
     * @param  int $limit
     * @return Collection
     */
    public function getCategoryTotals(Model $model, $first, $last, $limit)
    {
        return Category::withTotalAmount($model)
                       ->before($last)
                       ->after($first)
                       ->where('categories.user_id', Auth::id())
                       ->orderBy('amount', 'desc')
                       ->take($limit)
                       ->get();
    }

    /**
     * Calculates the percentage of each category total and appends the
     * percentage to each category model.
     *
     * @param Collection $categoriesTotals
     * @param int $total
     * @return Collection
     */
    public function calculatePercentages($categoriesTotals, $total)
    {
        // Calculate the percentage of each category
        $categoryPercentages = $categoriesTotals->map(
            function($category, $key) use ($total) {
                $category->percentage = round($category->amount / $total * 100, 2);
                return $category;
            }
        );
        return $categoryPercentages;
    }
}
