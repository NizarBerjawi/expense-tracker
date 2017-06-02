<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetBaseController;
use App\Http\Traits\ValidatesInputTrait;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpensesController extends BudgetBaseController
{
    use ValidatesInputTrait;

    /**
     * Create a new controller instance.
     *
     * @param  App\Models\Expense $expense
     * @return void
     */
    public function __construct(Expense $expense)
    {
        $this->model = $expense;
        $this->middleware('auth');
    }

    /**
     * The resource name
     *
     * @return string
     */
    protected function resourceName() : string
    {
        return 'expenses';
    }

    /**
     * Validates the input for any store or update actions
     * related to the expense resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Validator
     */
    protected function validateInput(Request $request) : Validator
    {
        // Create the validator
        $validator = $this->makeValidator($request, $this->model);
        // Add additional category check
        $validator = $this->addCheck(
                            $validator,
                            !$this->categoryExists($request),
                            'Please select a valid category for the expense'
                        );
        return $validator;
    }
}
