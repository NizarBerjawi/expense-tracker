<?php

namespace App\Http\Requests;

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
    $this->categoryId = $request->input('categoryId');
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
      'date'          => 'required|date',
      'amount'        => 'required|numeric',
      'description'   => 'nullable|max:255',
    ];
  }

  /**
  * Get the error messages for the defined validation rules.
  *
  * @return array
  */
  protected function expenseMessages()
  {
    return [
      'name.required'      => 'A name is required for your expense',
      'name.max'           => 'The expense name should not be more than 255 characters',
      'date.required'      => 'A date is required for your expense',
      'date.date'          => 'The date provided should be a valid date',
      'amount.required'    => 'The expense should have a valid amount',
      'description.max'    => 'The expense description should not be more than 255 characters'
    ];
  }

  /**
  * Get the error messages for the defined validation rules.
  *
  * @return array
  */
  protected function incomeMessages()
  {
    return [
      'name.required'      => 'A name is required for your income',
      'name.max'           => 'The income name should not be more than 255 characters',
      'date.required'      => 'A date is required for your income',
      'date.date'          => 'The date provided should be a valid date',
      'amount.required'    => 'The income should have a valid amount',
      'description.max'    => 'The income description should not be more than 255 characters'
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
      if (!$this->categoryIsAvailable()) {
        $validator->errors()->add('categoryId', 'Please select a valid category from the list');
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
    $category = Category::where('id', $this->categoryId)
                        ->where('user_id', Auth::id())
                        ->first();
    return $category or false;
  }
}
