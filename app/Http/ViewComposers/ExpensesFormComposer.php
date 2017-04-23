<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Expense;
use App\Models\Category;

class ExpensesFormComposer
{
  /**
   * The expense ID
   *
   * @var int
   */
  private $expenseId;

  /**
  * Create a new view composer instance.
  *
  * @param  Illuminate\Http\Request $request
  */
  public function __construct(Request $request) {
    $this->expenseId = $request->expenseId;
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
      case 'expenses.create':
        $categories = Category::where('user_id', Auth::id())->get();
        return compact('categories');
      case 'expenses.show':
        $expense = Expense::where('id', $this->expenseId)
                          ->where('user_id', Auth::id())
                          ->with('category')
                          ->first();
        return compact('expense');
      case 'expenses.edit':
        $expense = Expense::where('id', $this->expenseId)
                            ->where('user_id', Auth::id())
                            ->with('category')
                            ->first();
        $categories = Category::where('user_id', Auth::id())->get();
        return compact('expense', 'categories');
    }
  }
}
