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
    private $category;

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
        $this->category = Category::find($request->category);
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
            if ($this->nameIsTaken()) {
                $validator->errors()->add('name', 'This category name is already taken' . $this->category->name);
            }
        });
    }

    /**
     * Check if the updated is already taken
     *
     */
    private function nameIsTaken()
    {
        // Get the name of the category being updated
        $categoryName = $this->category->name;

        // Compare the old name to the new name. If the name hasn't been
        // updated there is no problem. Otherwise, we check if the new
        // name is unique
        if ($this->updatedName == $categoryName) {
            return false;
        } else if (Category::where('name', $this->updatedName)->first()){
            return true;
        }
        return false;
    }
}
