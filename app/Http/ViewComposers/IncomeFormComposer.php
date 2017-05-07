<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Income;
use App\Models\Category;

class IncomeFormComposer
{
  /**
   * The expense ID
   *
   * @var int
   */
  private $incomeId;

  /**
  * Create a new view composer instance.
  *
  * @param  Illuminate\Http\Request $request
  */
  public function __construct(Request $request) {
    $this->incomeId = $request->incomeId;
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
      case 'income.create':
        $categories = Category::where('user_id', Auth::id())->get();
        return compact('categories');
      case 'income.show':
        $income = Income::where('id', $this->incomeId)
                        ->where('user_id', Auth::id())
                        ->with('category')
                        ->first();
        return compact('income');
      case 'income.edit':
        $income = Income::where('id', $this->incomeId)
                        ->where('user_id', Auth::id())
                        ->with('category')
                        ->first();
        $categories = Category::where('user_id', Auth::id())->get();
        return compact('income', 'categories');
    }
  }
}
