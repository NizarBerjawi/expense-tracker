<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * Get the category that owns the expense.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
