<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Income extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'income';

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
      'amount',
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
      'category_id'   => 'required|integer|exists:income,category_id',
      'description'   => 'nullable|max:255',
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public $messages = [
      'name.required'       => 'Please provide a name for the income item',
      'name.max'            => 'The income name should not exceed 255 characters',
      'date.required'       => 'Please provide a date for your income item',
      'date.date'           => 'Please provide a valid date for your income item',
      'amount.required'     => 'Please provide an amount for your income item',
      'amount.numeric'      => 'Please provide a valid numeric amount for your income item',
      'category_id.integer' => 'Please select a valid category for your income from the list',
      'description.max'     => 'The income description should not exceed 255 characters'
    ];

    /***********************************************************************/
    /*************************ELOQUENT RELATIONSHIPS************************/
    /***********************************************************************/

    /**
     * Get the category that owns the income.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
      return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the user that owns the income.
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
     * Scope a query to only include a specific income by ID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  int $incomeId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeById($query, int $incomeId)
    {
        $query->where('income.id', $incomeId);
    }

    /**
     * Scope a query to only include a specific user's income.
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
     * Scope a query to order the income by the date field.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByDate($query, string $direction)
    {
        return $query->orderBy('date', $direction);
    }

    /***********************************************************************/
    /****************************STATIC METHODS*****************************/
    /***********************************************************************/

    /**
     * Delete one or mor specified income.
     *
     * @param array
     * @return void
     */
    public static function discard(Array $incomeIds)
    {
        return Income::whereIn('id', $incomeIds)->delete();
    }
}
