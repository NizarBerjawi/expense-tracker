<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Income;
use App\Models\Expense;
use App\Services\PaginationService;

class MainTableComposer
{
  /**
  * The current page being displayed to the user.
  *
  * @var int
  */
  private $currentPage;

  /**
  * An instance of the pagination service
  *
  * @var App\Services\PaginationService
  */
  private $pagination;

  /**
  * Create a new view composer instance.
  *
  * @param  Illuminate\Http\Request $request
  */
  public function __construct(Request $request, PaginationService $pagination) {
    $this->currentPage = $request->page;
    $this->pagination = $pagination;
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
    $builder = $this->getViewData($currentRoute);
    // Get the paginated items to be displayed
    $items = $this->pagination->getPaginatedData($builder, $this->currentPage);
    // Send the data to the view
    $view->with(compact('items'));
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
      case 'categories.index':
        $builder = Category::where('user_id', Auth::id())->with('tag');
        break;
      case 'expenses.index':
        $builder = Expense::where('user_id', Auth::id())->with('category');
        break;
      case 'income.index':
        $builder = Income::where('user_id', Auth::id())->with('category');
        break;
    }
    return $builder;
  }
}
