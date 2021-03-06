<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Income;
use App\Models\Expense;
use Auth;

class Asset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'starting_balance',
      'balance'
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
            'name.required'             => 'Please provide a name for the asset',
            'name.max'                  => 'The asset name should not exceed 255 characters',
            'starting_balance.required' => 'Please provide a starting balance for your asset',
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

    /**
     * Set the balance of this bank account
     *
     * @return null
     */
    public function updateBalance()
    {
        // The total expenses of the authenticated user
        $expenses = $this->expenses->sum('amount');
        // The total income of the authenticated user
        $income = $this->income->sum('amount');
        // // Update the balance
        $this->balance = $this->starting_balance + $income - $expenses;
        // Save the new balance to the database
        $this->save();
    }

    /**
     * Delete one or more specified expenses.
     *
     * @param array
     * @return void
     */
    public static function discard(Array $assetIds)
    {
        return Asset::whereIn('id', $assetIds)->delete();
    }

    /**
     * Get the asset's balance.
     *
     * @param  string  $value
     * @return string
     */
    public function getBalanceAttribute($value)
    {
        // Add a dollar sign and separators to the balance
        $balance = sprintf("$ %s", number_format($value, 2));
        return $balance;
    }
}
