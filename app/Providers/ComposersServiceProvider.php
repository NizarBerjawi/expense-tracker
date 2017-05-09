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
        /** CATEGORIES TABLE **/
        View::composer(
            [
                'categories.index'
            ],
            'App\Http\ViewComposers\CategoriesTableComposer'
        );

        /** CATEGORIES FORM **/
        View::composer(
            [
                'categories.new',
                'categories.view',
                'categories.edit'
            ],
            'App\Http\ViewComposers\CategoriesFormComposer'
        );

        /** EXPENSES TABLE **/
        View::composer(
            [
                'expenses.index'
            ],
            'App\Http\ViewComposers\ExpensesTableComposer'
        );

        /** EXPENSES FORM **/
        View::composer(
            [
                'expenses.new',
                'expenses.view',
                'expenses.edit'
            ],
            'App\Http\ViewComposers\ExpensesFormComposer'
        );

        /** INCOME TABLE **/
        View::composer(
            [
                'income.index'
            ],
            'App\Http\ViewComposers\IncomeTableComposer'
        );

        /** INCOME FORM **/
        View::composer(
            [
                'income.new',
                'income.view',
                'income.edit'
            ],
            'App\Http\ViewComposers\IncomeFormComposer'
        );

        /** DASHBOARD **/
        View::composer(
            [
                'home',
            ],
            'App\Http\ViewComposers\DashboardComposer'
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
