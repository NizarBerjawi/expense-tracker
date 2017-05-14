<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseClasses\BudgetRequests;

class StoreExpense extends BudgetRequests
{

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
      return parent::expenseMessages();
  }
}
