<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetBaseController;
use App\Http\Traits\ValidatesInputTrait;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends BudgetBaseController
{
    use ValidatesInputTrait;

    /**
     * Create a new controller instance.
     *
     * @param  App\Models\Income $income
     * @return void
     */
    public function __construct(Income $income)
    {
        $this->model = $income;
        $this->middleware('auth');
    }

    /**
     * The resource name
     *
     * @return string
     */
    protected function resourceName() : string
    {
        return 'income';
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
     * Validates the input for any store or update actions
     * related to the income resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Validator
     */
    protected function validateInput(Request $request) : Validator
    {
        $checks = array([
                'check'   => !$this->categoryExists($request),
                'message' => 'Please select a valid category for the income'
            ],
            [
                'check'   => !$this->bankAccountExists($request),
                'message' => 'Please select a valid bank account for the income'
            ]
        );
        // Create the validator
        $validator = $this->makeValidator($request, $this->model);
        // Add additional category check
        $validator = $this->addChecks($validator, $checks);
        return $validator;
    }
}
