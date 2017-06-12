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

/** Use Bank Account Routes **/
Route::group(['prefix' => 'bank'], function() {
    Route::get('/create', 'BankAccountController@create')->name('user.banks.create');
    Route::post('/', 'BankAccountController@store')->name('user.banks.store');
    Route::get('/{account_id}', 'BankAccountController@show')->name('user.banks.show');
    Route::get('/{account_id}/edit', 'BankAccountController@edit')->name('user.banks.edit');
    Route::put('/{account_id}', 'BankAccountController@update')->name('user.banks.update');
    Route::delete('/{account_id}', 'BankAccountController@destroy')->name('user.banks.destroy');
});

/** Category Routes **/
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoriesController@index')->name('categories.index');
    Route::get('/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/', 'CategoriesController@store')->name('categories.store');
    Route::get('/{categoryId}', 'CategoriesController@show')->name('categories.show');
    Route::get('/{categoryId}/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::put('/{categoryId}', 'CategoriesController@update')->name('categories.update');
    Route::delete('/{categoryId?}', 'CategoriesController@destroy')->name('categories.destroy');
});

/** Expense Routes **/
Route::group(['prefix' => 'expenses'], function () {
    Route::get('/', 'ExpensesController@index')->name('expenses.index');
    Route::get('/create', 'ExpensesController@create')->name('expenses.create');
    Route::post('/', 'ExpensesController@store')->name('expenses.store');
    Route::get('/{expenseId}', 'ExpensesController@show')->name('expenses.show');
    Route::get('/{expenseId}/edit', 'ExpensesController@edit')->name('expenses.edit');
    Route::put('/{expenseId}', 'ExpensesController@update')->name('expenses.update');
    Route::delete('/{expenseId?}', 'ExpensesController@destroy')->name('expenses.destroy');
});

/** Income Routes **/
Route::group(['prefix' => 'income'], function () {
    Route::get('/', 'IncomeController@index')->name('income.index');
    Route::get('/create', 'IncomeController@create')->name('income.create');
    Route::post('/', 'IncomeController@store')->name('income.store');
    Route::get('/{incomeId}', 'IncomeController@show')->name('income.show');
    Route::get('/{incomeId}/edit', 'IncomeController@edit')->name('income.edit');
    Route::put('/{incomeId}', 'IncomeController@update')->name('income.update');
    Route::delete('/{incomeId?}', 'IncomeController@destroy')->name('income.destroy');
});
