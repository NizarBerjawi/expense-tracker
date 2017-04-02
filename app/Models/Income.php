<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'income';

    /**
     * Get the category that owns the income.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
