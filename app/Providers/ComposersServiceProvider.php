<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposersServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
        View::composer(
            ['categories.index', 'expenses.index', 'income.index'],
            'App\Http\ViewComposers\MainTableComposer'
        );

        View::composer(
            ['categories.new', 'categories.view', 'categories.edit'],
            'App\Http\ViewComposers\CategoriesFormComposer'
        );
    }

    /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
        //
    }
}
