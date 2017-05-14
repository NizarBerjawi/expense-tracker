<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCategory extends FormRequest
{
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
        'category_ids' => 'array|required_without:id',
        'id'           => 'integer'
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
        'category_ids.required_without' => 'Please Select one or more categories to delete.',
        'category_ids.array'            => 'Oops, something went wrong. Please try again.',
        'id.integer'                    => 'Oops, something went wrong. Please try again.',
      ];
    }
}
