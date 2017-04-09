<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Income;
use App\Models\Expense;

class MainTableComposer
{
    /**
     * The number of items displayed on each page of the table.
     *
     * @var int
     */
    private $PER_PAGE = 2;

    /**
     * The current page being displayed to the user.
     *
     * @var int
     */
    private $current_page;

    /**
     * Create a new composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request) {
        $this->current_page = $request->page;
    }

    /**
     * Bind data to the view
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view) {
        // Get the current route name
        $current_route = Route::currentRouteName();

        // Get the data to be sent to the views
        $items = $this->getViewData($current_route);

        // Get the last available page to display
        $last_page = $items->lastPage();

        // If the current page is more than the last available page
        if ($this->current_page > $last_page) {
            // Show the data in the last available page
            $items = $this->getViewData($current_route, $last_page);
        }

        // Send the data to the view
        $view->with(compact('items'));
    }

    /**
     * Get the data to be sent to the view based on the
     * current route name.
     *
     * @param string
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    private function getViewData($route_name, $page = null) {
        // Prepare the data to be sent to the views
        switch($route_name) {
            case 'categories.index':
                $items = Category::paginate($this->PER_PAGE, ['*'], 'page', $page);
                break;
            case 'expenses.index':
                $items = Expense::paginate($this->PER_PAGE, ['*'], 'page', $page);
                break;
            case 'income.index':
                $items = Income::paginate($this->PER_PAGE, ['*'], 'page', $page);
                break;
        }
        return $items;
    }
}
