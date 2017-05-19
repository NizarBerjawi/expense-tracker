<?php

namespace App\Controllers\Traits;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Auth;

trait ValidatesCategory
{
    /**
     * Validates the input for any store or update actions
     * related to the income and expense resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Validator
     */
    protected function validateInput(Request $request)
    {
        // Validate the input, use the model rules and messages
        $validator = Validator::make(
                    $request->all(),
                    $this->model->rules(),
                    $this->model->messages()
                );

        // Check if the category exists
        $validator->after(function ($validator) use ($request) {
            // This method is in the ValidatesCategory Trait
            if (!$this->categoryExists($request)) {
                $validator->errors()
                          ->add('errors', 'Please select a valid category from the list');
            }
        });

        return $validator;
    }

    /**
     * Check if the selected category is valid
     *
     * @return boolean
     */
    protected function categoryExists(Request $request)
    {
      // Check if the category exists
      $category = Category::where('id', $request->input('category_id'))
                          ->where('user_id', Auth::id())
                          ->whereHas('tag', function($query) {
                              $query->where('tags.name', 'expense');
                          })
                          ->first();
      return $category or false;
    }

    /**
     * Check if the updated category name is already taken
     *
     * @return boolean
     */
    protected function nameAvailable(Request $request)
    {
        // Get the new category name
        $newName = $request->input('name');
        // If the user is updating an existing category, get its old name
        if (isset($request->categoryId)) {
            $currentName = $request->old('name');;
            // The name was not updated
            if (!strcmp($newName, $currentName)) {
                return true;
            }
        }
        // Attempt to find an existing category with the same name
        $category = Category::where('name', $newName)->first();
        return !$category;
    }
}
