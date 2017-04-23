<?php

namespace App\Http\Requests;

class UpdateIncome extends BudgetRequests
{
  /**
  * Get the error messages for the defined validation rules.
  *
  * @return array
  */
  public function messages()
  {
    return parent::incomeMessages();
  }
}
