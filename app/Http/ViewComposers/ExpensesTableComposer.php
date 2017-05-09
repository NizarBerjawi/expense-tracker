<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Expense;
use App\Services\PaginationService;

class ExpensesTableComposer
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
    // Get the data to be sent to the views
    $builder = Expense::where('user_id', Auth::id())
                      ->with('category')
                      ->latest();
    // Get the paginated items to be displayed
    $expenses = $this->pagination
                       ->getPaginatedData($builder, $this->currentPage);
    // Send the data to the view
    $view->with(compact('expenses'));
  }
}
