<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class BudgetItem extends Model
{

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
      'asset_id',
      'date',
      'amount',
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public function rules()
    {
        return [
            'name'        => 'required|max:255',
            'date'        => 'required|date',
            'amount'      => 'required|numeric',
            'category_id' => 'integer',
            'description' => 'nullable|max:255',
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
     * Get the category that owns the budget item.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
      return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the user that owns the budget item.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the asset that this budget item belongs to.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
      return $this->belongsTo('App\Models\Asset');
    }

    /***********************************************************************/
    /*****************************LOCAL SCOPES******************************/
    /***********************************************************************/

    /**
     * Scope a query to order the item by the date field.
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
     * Scope a query to include only items before a specified date.
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
     * Scope a query to include only income after a specified date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  \Carbon\Carbon $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAfter($query, Carbon $date)
    {
        return $query->where('date', '>=', $date);
    }
}
