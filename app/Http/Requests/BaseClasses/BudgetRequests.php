<?php

namespace App\Http\Requests\BaseClasses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class BudgetRequests extends FormRequest
{
  /**
   * The id of the category selected
   *
   * @var int
   */
  protected $categoryId;

  /**
   *
   *
   */
  public function __construct(Request $request)
  {
    $this->categoryId = $request->input('category_id');
  }

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Configure the validator instance.
   *
   * @param  \Illuminate\Validation\Validator  $validator
   * @return void
   */
  public function withValidator($validator)
  {
    $validator->after(function ($validator) {
      if (!$this->categoryIsAvailable()) {
        $validator->errors()
                  ->add('category_id', 'Please select a valid category from the list');
      }
    });
  }

  /**
   * Check if the selected category is valid
   *
   * @return boolean
   */
  protected function categoryIsAvailable()
  {
    // Check if the category exists
    $category = Category::byId($this->categoryId)
                        ->byUser(Auth::id())
                        ->first();
    return $category or false;
  }
}
