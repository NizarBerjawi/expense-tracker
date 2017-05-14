<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Income;

class IncomeTableComposer
{
  /**
  * The current page being displayed to the user.
  *
  * @var int
  */
  private $currentPage;

  /**
  * Create a new view composer instance.
  *
  * @param  Illuminate\Http\Request $request
  */
  public function __construct(Request $request) {
    $this->currentPage = $request->page;
  }

  /**
  * Bind data to the view
  *
  * @param View $view
  * @return void
  */
  public function compose(View $view) {
    // Get the data to be sent to the views
    $income = Income::where('user_id', Auth::id())
                     ->with('category')
                     ->latest()
                     ->paginate(10);

    // Send the data to the view
    $view->with(compact('income'));
  }
}
