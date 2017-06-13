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
    protected $bankAccount;

    /**
     *
     *
     */
    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
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
        return $this->bankAccount->rules();
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return $this->bankAccount->messages();
    }
}
