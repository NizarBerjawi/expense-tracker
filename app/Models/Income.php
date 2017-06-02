<?php

namespace App\Models;

use App\Models\Income;

class Income extends BudgetItem
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'income';

    /**
     * The validation messages.
     *
     * @var array
     */
    public function messages()
    {
        return [
            'name.required'       => 'Please provide a name for the income item',
            'name.max'            => 'The income name should not exceed 255 characters',
            'date.required'       => 'Please provide a date for your income item',
            'date.date'           => 'Please provide a valid date for your income item',
            'amount.required'     => 'Please provide an amount for your income item',
            'amount.numeric'      => 'Please provide a valid numeric amount for your income item',
            'category_id.integer' => 'Please select a valid category for your income from the list',
            'description.max'     => 'The income description should not exceed 255 characters'
        ];
    }

    /**
     * Delete one or more specified income.
     *
     * @param array
     * @return void
     */
    public static function discard(Array $incomeIds)
    {
        return Income::whereIn('id', $incomeIds)->delete();
    }
}
