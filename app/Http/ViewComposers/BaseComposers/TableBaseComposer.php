<?php

namespace App\Http\ViewComposers\BaseComposers;

use Illuminate\View\View;
use Auth;

abstract class TableBaseComposer
{
    /**
     * The model used to display the data on the page.
     *
     * @var int
     */
    protected $model;

    /**
     * The current page being displayed to the user.
     *
     * @var int
     */
    protected $currentPage;

    /**
     * The direction of sort
     *
     * @var string
     */
    protected $dir;

    /**
     * The column being sorted
     *
     * @var strin
     */
    protected $col;

    /**
     * The name of the resource being queried
     *
     * @return string
     */
    abstract protected function resourceName() : string;

    /**
     * The name of the resource being returned with the
     * main resource. For example, Tags are queried with categories.
     *
     * @return string
     */
    abstract protected function with() : string;

    /**
     * Bind data to the view
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view) {
        // Get the sort criteria, if any
        $col = $this->col;
        $dir = $this->dir;
        // If col and dir are set, order data; otherwise order by date created
        ${$this->resourceName()} =
                $this->model->where('user_id', Auth::id())
                            ->with($this->with())
                            ->when($col and $dir, function ($query) use ($col, $dir) {
                                return $query->orderBy($col, $dir);
                            }, function($query) {
                                return $query->latest();
                            })
                            ->paginate(10)
                            ->appends(['col'=> $col, 'dir' => $dir]);
        // Send the data to the view
        $view->with($this->resourceName(), ${$this->resourceName()});
    }
}
