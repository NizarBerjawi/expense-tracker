<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\FormBaseComposer;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\Category;
use App\Models\Income;
use Auth;

class BankAccountFormComposer extends FormBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->id = $request->account_id;
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
            case 'user.banks.create':
                return null;
            case 'user.banks.show':
                $bankAccount = BankAccount::where('id', $this->id)
                                     ->where('user_id', Auth::id())
                                     ->first();
                return compact('bankAccount');
            case 'user.banks.edit':
                $bankAccount = BankAccount::where('id', $this->id)
                                ->where('user_id', Auth::id())
                                ->first();
                return compact('bankAccount');
        }
    }
}
