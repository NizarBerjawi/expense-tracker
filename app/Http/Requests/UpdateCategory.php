<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class UpdateCategory extends FormRequest
{
  /**
  * The id of the category being updated
  *
  * @var int
  */
  private $categoryId;

  /**
  * The new updated category name
  *
  * @var string
  */
  private $updatedName;

  /**
  * Create a new request instance.
  *
  * @param
  */
  public function __construct(Request $request) {
    $this->categoryId = $request->categoryId;
    $this->updatedName = $request->name;
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
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
  public function rules()
  {
    return [
      'name'          => 'required|max:255',
      'description'   => 'nullable|max:255',
      'tag'           => 'nullable|max:255',
    ];
  }

  /**
  * Get the error messages for the defined validation rules.
  *
  * @return array
  */
  public function messages()
  {
    return [
      'name.required'     => 'A name is required for your category',
      'name.max'          => 'The category name should not be more than 255 characters',
      'description.max'   => 'The category description should not be more than 255 characters',
      'tag.max'           => 'The category tag should not be more than 255 characters',
    ];
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
      if ($this->nameIsTaken($this->updatedName)) {
        $validator->errors()->add('name', 'This category name is already taken!');
      }
    });
  }

  /**
   * Check if the updated category name is already taken
   *
   * @return boolean
   */
  private function nameIsTaken($request)
  {
    // Get the current name of the category being updated
    $currentName = Category::find($request->categoryId)->name;
    // Get the updated name
    $updatedName = $request->input('name');
    // Check if the name was updated and if it is already taken
    if (!strcmp($updatedName, $currentName)) {
      $category = Category::where('name', $updatedName)->first();
      return $category or false;
    }
    return false;
  }
}
