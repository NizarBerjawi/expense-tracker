<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetBaseController;
use App\Http\Services\ValidationService;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends BudgetBaseController
{
    /**
     * An instance of the validation service
     *
     * @var App\Http\Services\ValidationService
     */
    protected $validate;

    /**
     * Create a new controller instance.
     *
     * @param  App\Models\Income $income
     * @param  App\Http\Services\ValidationService $validation
     * @return void
     */
    public function __construct(Income $income, ValidationService $validation)
    {
        $this->model = $income;
        $this->validate = $validation;
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
                'check'   => !$this->validate->categoryExists($request, $this->resourceName()),
                'message' => 'Please select a valid category for the income'
            ],
            [
                'check'   => !$this->validate->assetExists($request),
                'message' => 'Please select a valid asset for the income'
            ]
        );
        // Create the validator
        $validator = $this->validate->makeValidator($request, $this->model);
        // Add additional category check
        $validator = $this->validate->addChecks($validator, $checks);
        return $validator;
    }
}
