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
