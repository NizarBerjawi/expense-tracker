<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;

class ProfileComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {

    }


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
     * @param  string $routeName
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function getViewData(string $routeName)
    {
        // Prepare the data to be sent to the views
        switch($routeName) {
            case "user.profile.index":
                // Get an instance of the authenticated user with profile
                $user = Auth::user()->load('profile');
                return compact('user');
            case "categories.show":
                return;
            case "categories.edit":
                return;
        }
    }
}
