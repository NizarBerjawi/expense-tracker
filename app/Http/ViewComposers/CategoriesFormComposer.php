<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Tag;
use App\Models\Category;

class CategoriesFormComposer
{
  /**
   * The Category ID
   *
   * @var int
   */
  private $categoryId;

  /**
  * Create a new view composer instance.
  *
  * @param  Illuminate\Http\Request $request
  */
  public function __construct(Request $request) {
    $this->categoryId = $request->categoryId;
  }

  /**
  * Bind data to the view
  *
  * @param View $view
  * @return void
  */
  public function compose(View $view) {
    // Get the current route name
    $currentRoute = Route::currentRouteName();
    // Get the data to be sent to the views
    $data = $this->getViewData($currentRoute);
    // Send the data to the view
    $view->with($data);
  }

  /**
  * Get the data to be sent to the view based on the
  * current route name.
  *
  * @param  string $routeName
  * @return Illuminate\Database\Eloquent\Builder
  */
  private function getViewData($routeName) {
    // Prepare the data to be sent to the views
    switch($routeName) {
      case 'categories.create':
        $tags = Tag::all();
        return compact('tags');
      case 'categories.show':
        $category = Category::where('id', $this->categoryId)
                            ->where('user_id', Auth::id())
                            ->with('tag')
                            ->first();
        return compact('category');
      case 'categories.edit':
        $category = Category::where('id', $this->categoryId)
                            ->where('user_id', Auth::id())
                            ->with('tag')
                            ->first();
        $tags = Tag::all();
        return compact('category', 'tags');
    }
  }
}
