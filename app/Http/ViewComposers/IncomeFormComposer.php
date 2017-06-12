<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\FormBaseComposer;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\Category;
use App\Models\Income;
use Auth;

class IncomeFormComposer extends FormBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request, Income $income)
    {
        $this->id = $request->incomeId;
        $this->model = $income;
    }

    /**
     * Get the data to be sent to the view based on the
     * current route name.
     *
     * @param  string $routeName
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function getViewData(string $routeName)
    {
        // Prepare the data to be sent to the views
        switch($routeName) {
            case 'income.create':
                $categories = Category::where('user_id', Auth::id())
                                      ->byTagName(['income'])
                                      ->get();
                $bankAccounts = BankAccount::where('user_id', Auth::id())
                                         ->get();
                return compact('categories', 'bankAccounts');
            case 'income.show':
                $income = Income::where('id', $this->id)
                                ->where('user_id', Auth::id())
                                ->with(['category', 'bankAccount'])
                                ->first();
                return compact('income');
            case 'income.edit':
                $income = Income::where('id', $this->id)
                                ->where('user_id', Auth::id())
                                ->with(['category', 'bankAccount'])
                                ->first();
                $bankAccounts = BankAccount::where('user_id', Auth::id())
                                         ->get();
                $categories = Category::where('user_id', Auth::id())
                                      ->byTagName(['income'])
                                      ->get();
                return compact('income', 'categories', 'bankAccounts');
        }
    }
}
