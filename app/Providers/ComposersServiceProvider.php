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
    /** INDEX PAGES **/
    View::composer(
      ['categories.index', 'expenses.index', 'income.index'],
      'App\Http\ViewComposers\MainTableComposer'
    );

    /** CATEGORIES FORM **/
    View::composer(
      ['categories.new', 'categories.view', 'categories.edit'],
      'App\Http\ViewComposers\CategoriesFormComposer'
    );

    /** EXPENSES FORM **/
    View::composer(
      ['expenses.new', 'expenses.view', 'expenses.edit'],
      'App\Http\ViewComposers\ExpensesFormComposer'
    );

    /** INCOME FORM **/
    View::composer(
      ['income.new', 'income.view', 'income.edit'],
      'App\Http\ViewComposers\IncomeFormComposer'
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
