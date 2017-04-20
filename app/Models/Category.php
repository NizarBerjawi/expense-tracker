<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
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
    protected $fillable = ['name', 'description', 'tag_id', 'user_id'];

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

    /**
     * Get the tag that this category belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag() {
        return $this->belongsTo('App\Models\Tag');
    }

    /**
     * Attach a tag to this category if it exists. Otherwise,
     * create a new tag and attach it.
     *
     * @param  mixed
     * @return void
     */
    public function attachTag($tagData) {
        // Attempt to find the tag
        $tag = Tag::find($tagData);

        // If there is no tag available, create it
        if (!$tag) {
            $tag = Tag::create([
                'name'    => $tagData,
                'user_id' => Auth::id(),
            ]);
        }

        // Attach the tag to the category
        $this->tag_id = $tag->id;
        $this->save();
    }
}
