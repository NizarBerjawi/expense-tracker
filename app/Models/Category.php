<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;
use Auth;

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

    /**
     * Delete one or mor specified categories.
     *
     * @param array
     * @return void
     */
    public static function discard(Array $categoryIds)
    {
        return Category::whereIn('id', $categoryIds)->delete();
    }


    public function getPercentage()
    {
        if ($this->tag->name == 'Expense') {
            $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');
            $categoryExpenses = $this->expenses->sum('amount');

            return round($categoryExpenses/$totalExpenses * 100, 2);
        } else if ($this->tag->name == 'Income') {
            $totalIncome = Income::where('user_id', Auth::id())->sum('amount');
            $categoryIncome = $this->income->sum('amount');

            return round($categoryIncome/$totalIncome * 100, 2);
        }
    }
}
