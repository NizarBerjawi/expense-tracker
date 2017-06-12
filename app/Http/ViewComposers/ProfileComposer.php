<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;

class ProfileComposer
{
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
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->dir = $request->dir;
        $this->col = $request->col;
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
        // Get the sort criteria, if any
        $col = $this->col;
        $dir = $this->dir;
        // Prepare the data to be sent to the views
        switch($routeName) {
            case "user.profiles.index":
                // Get an instance of the authenticated user with profile
                $user = Auth::user()->load(['profile']);
                // Get the authenticated user's bank accounts
                $bankAccounts = $user->bankAccounts()
                                     ->when($col and $dir, function($query) use ($col, $dir) {
                                         return $query->orderBy($col, $dir);
                                     }, function($query) {
                                         return $query->latest();
                                     })
                                     ->paginate(3)
                                     ->appends(['col' => $col, 'dir' => $dir]);
                // Send the data
                return compact('user', 'bankAccounts');
            case "user.profiles.edit":
                $user = Auth::user()->load('profile');
                return compact('user');
        }
    }
}
