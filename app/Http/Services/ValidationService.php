<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\LiquidAsset;
use App\Models\Category;
use Validator;
use Auth;

class ValidationService
{
    /**
     * Creates an instance of the validator using the user
     * input, the model rules, and the customized error messages.
     *
     * @param   \Illuminate\Http\Request  $request
     * @return  \Illuminate\Validation\Validator
     */
    public function makeValidator(Request $request, Model $model)
    {
        return Validator::make(
            $request->all(),
            $model->rules(),
            $model->messages()
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
    public function addChecks($validator, Array $checks)
    {
        foreach($checks as $check) {
            // Get the check result from the array
            $result  = $check['check'];
            // Get the check message from the array
            $message = $check['message'];
            // Check if the category exists
            $validator->after(function ($validator) use ($result, $message) {
                // This method is in the ValidatesCategory Trait
                if ($result) {
                    $validator->errors()
                              ->add('errors', $message);
                }
            });
        }

        return $validator;
    }

    /**
     * Check if the selected category exists for the specified Model
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function categoryExists(Request $request, String $resource)
    {
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
    public function nameAvailable(Request $request)
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

    /**
     * Check if the selected bank account is valid
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function assetExists(Request $request)
    {
        // Attempt to find the category
        $asset = LiquidAsset::where('id', $request->input('liquid_asset_id'))
                               ->where('user_id', Auth::id())
                               ->first();
        return $asset;
    }
}
