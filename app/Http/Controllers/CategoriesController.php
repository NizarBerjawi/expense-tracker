<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetBaseController;
use App\Http\Services\ValidationService;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends BudgetBaseController
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
     * @param  App\Models\Category $category
     * @return void
     */
    public function __construct(Category $category, ValidationService $validation)
    {
        $this->model = $category;
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
        return 'categories';
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
     * related to the categories resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Validator
     */
    protected function validateInput(Request $request) : Validator
    {
        $checks = array([
                'check'   => !$this->validate->nameAvailable($request),
                'message' => 'This category name has already been created'
            ]
        );
        // Create the validator
        $validator = $this->validate->makeValidator($request, $this->model);
        // Add additional category check
        $validator = $this->validate->addChecks($validator, $checks);
        return $validator;
    }
}
