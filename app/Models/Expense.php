<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expense extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'description',
      'category_id',
      'user_id',
      'date',
      'amount'
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public $rules = [
      'name'          => 'required|max:255',
      'date'          => 'required|date',
      'amount'        => 'required|numeric',
      'category_id'   => 'integer',
      'description'   => 'nullable|max:255',
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public $messages = [
      'name.required'       => 'Please provide a name for the expense item',
      'name.max'            => 'The expense name should not exceed 255 characters',
      'date.required'       => 'Please provide a date for your expense item',
      'date.date'           => 'Please provide a valid date for your expense item',
      'amount.required'     => 'Please provide an amount for your expense item',
      'amount.numeric'      => 'Please provide a valid numeric amount for your expense item',
      'category_id.integer' => 'Please select a valid category for your expense from the list',
      'description.max'     => 'The expense description should not exceed 255 characters'
    ];

    /***********************************************************************/
    /*************************ELOQUENT RELATIONSHIPS************************/
    /***********************************************************************/

    /**
     * Get the category that owns the expense.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
      return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the user that owns the expense.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    /***********************************************************************/
    /*****************************LOCAL SCOPES******************************/
    /***********************************************************************/

    /**
     * Scope a query to only include a specific expense by ID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  int $expenseId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeById($query, int $expenseId)
    {
        $query->where('expenses.id', $expenseId);
    }

    /**
     * Scope a query to only include a specific user's expenses.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  int $userID
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to order the expenses by the date field.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByDate($query, string $direction)
    {
        return $query->orderBy('date', $direction);
    }

    /**
     * Scope a query to include only expenses before a specified date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  \Carbon\Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBefore($query, Carbon $date)
    {
        return $query->where('date', '<=', $date);
    }

    /**
     * Scope a query to include only expenses after a specified date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  \Carbon\Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAfter($query, Carbon $date)
    {
        return $query->where('date', '>=', $date);
    }

    /***********************************************************************/
    /****************************STATIC METHODS*****************************/
    /***********************************************************************/

    /**
     * Delete one or mor specified expenses.
     *
     * @param array $expenseIds
     * @return int
     */
    public static function discard(Array $expenseIds)
    {
        return Expense::whereIn('id', $expenseIds)->delete();
    }
}
