<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
            'name'          => 'required|unique:categories,name|max:255',
            'tag_id'        => 'required|integer',
            'description'   => 'nullable|max:255',
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
            'name.unique'       => 'This category name has already been created',
            'name.max'          => 'The category name should not be more than 255 characters',
            'tag_id.required'   => 'A tag is required for this category',
            'description.max'   => 'The category description should not be more than 255 characters',
        ];
    }
}
