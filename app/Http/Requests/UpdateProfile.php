<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Profile;

class UpdateProfile extends FormRequest
{
    /**
     *
     */
    protected $profile;

    /**
     *
     *
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
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
        return $this->profile->rules();
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return $this->profile->messages();
    }
}
