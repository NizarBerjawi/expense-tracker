<?php

namespace App\Http\Requests;

class StoreIncome extends BudgetRequests
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
