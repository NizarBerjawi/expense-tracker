<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'tag_id',
        'user_id'
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public $rules = [
        'name'          => 'required|unique:categories,name|max:255',
        'tag_id'        => 'required|integer',
        'description'   => 'nullable|max:255',
    ];

    /**
     * The validation messages.
     *
     * @var array
     */
    public $messages = [
        'name.required'     => 'A name is required for your category',
        'name.unique'       => 'This category name has already been created',
        'name.max'          => 'The category name should not be more than 255 characters',
        'tag_id.required'   => 'A tag is required for this category',
        'description.max'   => 'The category description should not be more than 255 characters',
    ];

    /***********************************************************************/
    /*************************ELOQUENT RELATIONSHIPS************************/
    /***********************************************************************/

    /**
     * Get the expenses belonging to the category
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }

    /**
     * Get the income belonging to the category
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function income()
    {
        return $this->hasMany('App\Models\Income');
    }

    /**
     * Get the tag that this category belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    /***********************************************************************/
    /*****************************LOCAL SCOPES******************************/
    /***********************************************************************/

    /**
     * Scope a query to only include a specific category by ID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  int $categoryId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeById($query, int $categoryId)
    {
        $query->where('categories.id', $categoryId);
    }

    /**
     * Scope a query to only include a specific user's categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  int $userID
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, int $userId)
    {
        $query->where('categories.user_id', $userId);
    }

    /**
     * Scope a query to only include categories by specified tag names.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array  $tagNames
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTagName($query, Array $tagNames)
    {
        return $query->whereHas('tag', function($query) use ($tagNames){
            $query->whereIn('name', $tagNames);
        });
    }

    /**
     * Scope a query to include the total expense amount of the categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithExpenseTotal($query)
    {
        return $query->join('expenses', 'categories.id', '=', 'expenses.category_id')
                     ->select(
                         'categories.id',
                         'categories.name',
                         'categories.description',
                         DB::raw('SUM(expenses.amount) as amount'),
                         'categories.tag_id',
                         'categories.user_id',
                         'categories.created_at',
                         'categories.updated_at'
                     )
                     ->groupBy('categories.id');
    }

    /**
     * Scope a query to include only expense or income amounts before
     * a specified date.
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
     * Scope a query to include only expense or income amounts after
     * a specified date.
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
     * Delete one or mor specified categories.
     *
     * @param array $categoryIds
     * @return int
     */
    public static function discard(Array $categoryIds)
    {
        return Category::whereIn('id', $categoryIds)->delete();
    }
}
