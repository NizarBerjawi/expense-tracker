<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetBaseController;
use App\Http\Traits\ValidatesInputTrait;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends BudgetBaseController
{
    use ValidatesInputTrait;

    /**
     * Create a new controller instance.
     *
     * @param  App\Models\Category $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
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
     * Validates the input for any store or update action
     * related to the categories resources.
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
                                !$this->nameAvailable($request),
                                'This category name has already been created'
                            );
        return $validator;
    }
}
