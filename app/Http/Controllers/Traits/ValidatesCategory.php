<?php

namespace App\Controllers\Traits;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

trait ValidatesCategory
{
    /**
     * Check if the selected category is valid
     *
     * @return boolean
     */
    protected function categoryExists($request)
    {
      // Check if the category exists
      $category = Category::where('id', $request->input('category_id'))
                          ->where('user_id', Auth::id())
                          ->whereHas('tag', function($query) {
                              $query->where('tags.name', 'expense');
                          })
                          ->first();
      return $category or false;
    }

    /**
     * Check if the updated category name is already taken
     *
     * @return boolean
     */
    private function nameAvailable($request)
    {
        // If the user is updating an existing category,
        // get its current name
        if ($request->exists('categoryId')) {
            $currentName = Category::find($request->categoryId)->name;
        }
        // Get the new category name
        $newName = $request->input('name');
        // The name was not updated
        if (!strcmp($newName, $currentName = null)) {
            return true;
        }
        $category = Category::where('name', $newName)->first();
        return !$category;
    }
}
