<?php

namespace App\Http\Requests\BaseRequests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * The model being validated
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

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
        return $this->model->rules();
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return $this->model->messages();
    }
}
