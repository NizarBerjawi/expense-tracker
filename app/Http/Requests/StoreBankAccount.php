<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BankAccount;

class StoreBankAccount extends FormRequest
{
    /**
     *
     *
     */
    protected $bank;

    /**
     *
     *
     */
    public function __construct(BankAccount $bank)
    {
        $this->bank = $bank;
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
        return $this->bank->rules();
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return $this->bank->messages();
    }
}
