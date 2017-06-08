<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Auth;

trait ValidatesInputTrait
{
    /**
     * Creates an instance of the validator using the user
     * input, the model rules, and the customized error messages.
     *
     * @param   \Illuminate\Http\Request  $request
     * @return  \Illuminate\Validation\Validator
     */
    private function makeValidator(Request $request)
    {
        return Validator::make(
            $request->all(),
            $this->model->rules(),
            $this->model->messages()
        );
    }

   /**
    * Add an additional "after validation" check to the validator.
    *
    * @param  \Illuminate\Validation\Validator  $validator
    * @param  Boolean  $check
    * @param  string  $message
    * @return \Illuminate\Validation\Validator
    */
    protected function addCheck($validator, $check, $message)
    {
        // Check if the category exists
        $validator->after(function ($validator) use ($check, $message) {
            // This method is in the ValidatesCategory Trait
            if ($check) {
                $validator->errors()
                          ->add('errors', $message);
            }
        });

        return $validator;
    }

    /**
     * Check if the selected category is valid
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function categoryExists(Request $request)
    {
        $resource = $this->resourceName();
        // Attempt to find the category
        $category = Category::where('id', $request->input('category_id'))
                          ->where('user_id', Auth::id())
                          ->whereHas('tag', function($query) use ($resource) {
                              $query->where('tags.name', 'like', $resource);

                          })
                          ->first();
        return $category;
    }

    /**
     * Check if the updated or created category name is available.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function nameAvailable(Request $request)
    {
        // Attempt to find a category with the same name and tag
        $category = Category::where('name', $request->input('name'))
                            ->where('user_id', Auth::id())
                            ->whereHas('tag', function($query) use ($request) {
                                $query->where('tags.id', $request->input('tag_id'));
                            })
                            ->first();
        // If a category with the same name is found, check if it is the
        // same one being updated. If it is, then the user didn't make any
        // changes. Otherwise, the name is already taken
        if (isset($request->categoryId) && $category) {
            return $request->categoryId == $category->id;
        }
        // The user updated the resource
        return !$category;
    }
}
