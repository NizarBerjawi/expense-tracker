<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'bank',
      'starting_balance',
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:255',
            'bank'              => 'required|max:255',
            'starting_balance'  => 'required|numeric',
        ];
    }

    /**
     * The validation messages.
     *
     * @var array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Please provide a name for the bank account',
            'name.max'                  => 'The bank account name should not exceed 255 characters',
            'bank.required'             => 'Please provide a name for the bank',
            'bank.max'                  => 'The bank name should not exceed 255 characters',
            'starting_balance.required' => 'Please provide a starting balance for your bank account',
            'starting_balance.numeric'  => 'Please provide a valid numeric starting balance',
        ];
    }

    /**
     * The name of the schema related to the model
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->table;
    }

    /***********************************************************************/
    /*************************ELOQUENT RELATIONSHIPS************************/
    /***********************************************************************/

    /**
     * Get the user that owns the bank account.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the expenses belonging to this bank account
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }

    /**
     * Get the income belonging to this bank account
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function income()
    {
        return $this->hasMany('App\Models\Income');
    }
}
