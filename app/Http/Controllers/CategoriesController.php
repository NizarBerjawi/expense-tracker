<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\BudgetResourceController;
use App\Controllers\Traits\ValidatesCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoriesController extends BudgetResourceController
{
    use ValidatesCategory;

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
     * @return string
     */
    protected function resourceName()
    {
        return 'categories';
    }

    /**
     *
     *
     */
    protected function validateInput(Request $request)
    {
        $validator = Validator::make(
                    $request->all(),
                    $this->model->rules,
                    $this->model->messages
                );

        $validator->after(function ($validator) use ($request) {
            if (!$this->nameAvailable($request)) {
              $validator->errors()
                        ->add('errors', 'Please select a valid category from the list');
            }
        });

        return $validator;
    }
}
