<?php

namespace App\Models;

use App\Models\Expense;

class Expense extends BudgetItem
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The validation messages.
     *
     * @var array
     */
    public function messages()
    {
        return [
            'name.required'       => 'Please provide a name for the expense item',
            'name.max'            => 'The expense name should not exceed 255 characters',
            'date.required'       => 'Please provide a date for your expense item',
            'date.date'           => 'Please provide a valid date for your expense item',
            'amount.required'     => 'Please provide an amount for your expense item',
            'amount.numeric'      => 'Please provide a valid numeric amount for your expense item',
            'category_id.integer' => 'Please select a valid category for your expense from the list',
            'description.max'     => 'The expense description should not exceed 255 characters'
        ];
    }

    /**
     * Delete one or more specified expenses.
     *
     * @param array
     * @return void
     */
    public static function discard(Array $expenseIds)
    {
        return Expense::whereIn('id', $expenseIds)->delete();
    }
}
