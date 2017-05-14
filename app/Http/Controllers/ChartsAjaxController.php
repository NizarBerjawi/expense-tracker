<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;
use Carbon\Carbon;
use Auth;

class ChartsAjaxController extends Controller
{
    public function monthlyExpenseData()
    {
        $today = Carbon::today();
        $year = $today->year;

        $expenses = Expense::byUser(Auth::id())
                           ->whereYear('date', $year)
                           ->select(
                               DB::raw('DATE_FORMAT(date, "%Y-%m") as date'),
                               DB::raw('SUM(amount) as amount'))
                           ->groupBy('date')
                           ->orderBy('date', 'desc')
                           ->get();

       $income = Income::byUser(Auth::id())
                        ->whereYear('date', $year)
                        ->select(
                            DB::raw('DATE_FORMAT(date, "%Y-%m") as date'),
                            DB::raw('SUM(amount) as amount'))
                        ->groupBy('date')
                        ->orderBy('date', 'desc')
                        ->get();

        // $data;
        // foreach($expenses as $expense) {
        //     if($income->contains('date', $expense->date)) {
        //         $temp[] = ['date' $expense ]
        //         $data['date']
        //     }
        // }

        return response()->json($expenses);
    }
}
