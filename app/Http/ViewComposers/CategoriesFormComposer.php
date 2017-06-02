<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\FormBaseComposer;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use Auth;

class CategoriesFormComposer extends FormBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request, Category $category)
    {
        $this->id = $request->categoryId;
        $this->model = $category;
    }

    /**
     * Get the data to be sent to the view based on the
     * current route name.
     *
     * @param  string $routeName
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function getViewData(string $routeName)
    {
        // Prepare the data to be sent to the views
        switch($routeName) {
            case "categories.create":
                $tags = Tag::all();
                return compact('tags');
            case "categories.show":
                $category = Category::where('id', $this->id)
                                    ->where('user_id', Auth::id())
                                    ->with('tag')
                                    ->first();
                return compact('category');
            case "categories.edit":
                $category = Category::where('id', $this->id)
                                    ->where('user_id', Auth::id())
                                    ->with('tag')
                                    ->first();
                $tags = Tag::all();
                return compact('category', 'tags');
        }
    }
}
