<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Get the expenses belonging to the category
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses() {
        return $this->hasMany('App\Models\Expense');
    }

    /**
     * Get the income belonging to the category
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function income() {
        return $this->hasMany('App\Models\Income');
    }


}
