<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id'];

    /**
     * Get the categories that belong to this tag.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany('App\Models\Category');
    }
}
