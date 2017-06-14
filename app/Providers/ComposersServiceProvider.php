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
                'user.categories.index'
            ],
            'App\Http\ViewComposers\CategoriesTableComposer'
        );

        /** CATEGORIES FORM **/
        View::composer(
            [
                'user.categories.create',
                'user.categories.view',
                'user.categories.edit'
            ],
            'App\Http\ViewComposers\CategoriesFormComposer'
        );

        /** EXPENSES TABLE **/
        View::composer(
            [
                'user.expenses.index'
            ],
            'App\Http\ViewComposers\ExpensesTableComposer'
        );

        /** EXPENSES FORM **/
        View::composer(
            [
                'user.expenses.create',
                'user.expenses.view',
                'user.expenses.edit'
            ],
            'App\Http\ViewComposers\ExpensesFormComposer'
        );

        /** INCOME TABLE **/
        View::composer(
            [
                'user.income.index'
            ],
            'App\Http\ViewComposers\IncomeTableComposer'
        );

        /** INCOME FORM **/
        View::composer(
            [
                'user.income.create',
                'user.income.view',
                'user.income.edit'
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

        View::composer(
            [
                'user.profiles.index',
                'user.profiles.edit'
            ],
            'App\Http\ViewComposers\ProfileComposer'
        );

        View::composer(
            [
                'user.assets.create',
                'user.assets.edit',
                'user.assets.view'
            ],
            'App\Http\ViewComposers\LiquidAssetFormComposer'
        );

        /** LEFT NAVIGATION **/
        View::composer(
            [
                'includes.navigation.leftNav',
            ],
            'App\Http\ViewComposers\LeftNavComposer'
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
