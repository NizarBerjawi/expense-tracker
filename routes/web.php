<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::post('/{year}/data', 'ChartsAjaxController@monthlyExpenseData')->name('dashboard.charts.monthly.expenses');
    Route::post('/dailyExpenses', 'ChartsAjaxController@dailyExpenses')->name('dashboard.charts.daily.data');
});

Route::get('/calendar', 'HomeController@calendar')->name('calendar');

/** User Profile Routes **/
Route::group(['prefix' => 'profile'], function() {
    Route::get('/', 'ProfileController@index')->name('user.profiles.index');
    Route::get('/create', 'ProfileController@create')->name('user.profiles.create');
    Route::post('/', 'ProfileController@store')->name('user.profiles.store');
    Route::get('/edit', 'ProfileController@edit')->name('user.profiles.edit');
    Route::put('/', 'ProfileController@update')->name('user.profiles.update');
});

/** User Account Routes **/
Route::group(['prefix' => 'settings'], function() {
    Route::get('/', 'SettingsController@index')->name('user.accounts.index');
    Route::put('/', 'SettingsController@update')->name('user.accounts.update');
    Route::delete('/', 'SettingsController@destroy')->name('user.accounts.destroy');
});

/** User Liquid Assets Routes **/
Route::group(['prefix' => 'accounts'], function() {
    // Money transfers between assets
    Route::put('/transfer', 'LiquidAssetsController@transfer')->name('user.assets.doTransfer');
    Route::get('/transfer', 'LiquidAssetsController@showTransfer')->name('user.assets.transfer');
    // Liquid assets
    Route::get('/create', 'LiquidAssetsController@create')->name('user.assets.create');
    Route::post('/', 'LiquidAssetsController@store')->name('user.assets.store');
    Route::get('/{assetId}', 'LiquidAssetsController@show')->name('user.assets.show');
    Route::get('/{assetId}/edit', 'LiquidAssetsController@edit')->name('user.assets.edit');
    Route::put('/{assetId}', 'LiquidAssetsController@update')->name('user.assets.update');
    Route::delete('/{assetId}', 'LiquidAssetsController@destroy')->name('user.assets.destroy');

});

/** Category Routes **/
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoriesController@index')->name('user.categories.index');
    Route::get('/create', 'CategoriesController@create')->name('user.categories.create');
    Route::post('/', 'CategoriesController@store')->name('user.categories.store');
    Route::get('/{categoryId}', 'CategoriesController@show')->name('user.categories.show');
    Route::get('/{categoryId}/edit', 'CategoriesController@edit')->name('user.categories.edit');
    Route::put('/{categoryId}', 'CategoriesController@update')->name('user.categories.update');
    Route::delete('/{categoryId?}', 'CategoriesController@destroy')->name('user.categories.destroy');
});

/** Expense Routes **/
Route::group(['prefix' => 'expenses'], function () {
    Route::get('/', 'ExpensesController@index')->name('user.expenses.index');
    Route::get('/create', 'ExpensesController@create')->name('user.expenses.create');
    Route::post('/', 'ExpensesController@store')->name('user.expenses.store');
    Route::get('/{expenseId}', 'ExpensesController@show')->name('user.expenses.show');
    Route::get('/{expenseId}/edit', 'ExpensesController@edit')->name('user.expenses.edit');
    Route::put('/{expenseId}', 'ExpensesController@update')->name('user.expenses.update');
    Route::delete('/{expenseId?}', 'ExpensesController@destroy')->name('user.expenses.destroy');
});

/** Income Routes **/
Route::group(['prefix' => 'income'], function () {
    Route::get('/', 'IncomeController@index')->name('user.income.index');
    Route::get('/create', 'IncomeController@create')->name('user.income.create');
    Route::post('/', 'IncomeController@store')->name('user.income.store');
    Route::get('/{incomeId}', 'IncomeController@show')->name('user.income.show');
    Route::get('/{incomeId}/edit', 'IncomeController@edit')->name('user.income.edit');
    Route::put('/{incomeId}', 'IncomeController@update')->name('user.income.update');
    Route::delete('/{incomeId?}', 'IncomeController@destroy')->name('user.income.destroy');
});
