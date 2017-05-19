<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetResourceController;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoriesController extends BudgetResourceController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    /**
     * The resource name
     *
     * @return string
     */
    protected function resourceName()
    {
        return 'categories';
    }

    /**
     * Validates the input for any store or update actions
     * related to the categories resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Validator
     */
    protected function validateInput(Request $request)
    {    
        $validator = Validator::make(
                    $request->all(),
                    $this->model->rules(),
                    $this->model->messages()
                );

        $validator->after(function ($validator) use ($request) {
            if (!$this->nameAvailable($request)) {
              $validator->errors()
                        ->add('errors', 'This category name has already been created');
            }
        });

        return $validator;
    }
}
