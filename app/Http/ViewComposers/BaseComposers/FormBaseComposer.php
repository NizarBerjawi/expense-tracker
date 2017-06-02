<?php

namespace App\Http\ViewComposers\BaseComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

abstract class FormBaseComposer
{
    /**
     * The model used to display the data on the page.
     *
     * @var int
     */
    protected $model;

    /**
     * The id of the resource
     *
     * @var int
     */
    protected $id;

    /**
     * Bind data to the view
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
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
     * @param string $routeName
     * @return Array
     */
    abstract protected function getViewData(string $routeName);
}
