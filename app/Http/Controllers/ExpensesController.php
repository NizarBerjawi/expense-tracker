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
     * The role of the user
     *
     * @return string
     */
    protected function userRole() : string
    {
        return 'user';
    }

    /**
     * Validates the input for any store or update action
     * related to the expense resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Validator
     */
    protected function validateInput(Request $request) : Validator
    {
        $checks = array([
                'check'   => !$this->categoryExists($request),
                'message' => 'Please select a valid category for the expense'
            ],
            [
                'check'   => !$this->assetExists($request),
                'message' => 'Please select a valid asset for the expense'
            ]
        );
        // Create the validator
        $validator = $this->makeValidator($request, $this->model);
        // Add additional category check
        $validator = $this->addChecks($validator, $checks);
        return $validator;
    }
}
