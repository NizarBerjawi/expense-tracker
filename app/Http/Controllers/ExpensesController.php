<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetBaseController;
use App\Http\Services\ValidationService;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpensesController extends BudgetBaseController
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
     * @param  App\Models\Expense $expense
     * @param  App\Http\Services\ValidationService $validation
     * @return void
     */
    public function __construct(Expense $expense, ValidationService $validation)
    {
        $this->model = $expense;
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
                'check'   => !$this->validate->categoryExists($request, $this->resourceName()),
                'message' => 'Please select a valid category for the expense'
            ],
            [
                'check'   => !$this->validate->assetExists($request),
                'message' => 'Please select a valid asset for the expense'
            ]
        );
        // Create the validator
        $validator = $this->validate->makeValidator($request, $this->model);
        // Add additional category check
        $validator = $this->validate->addChecks($validator, $checks);
        return $validator;
    }
}
