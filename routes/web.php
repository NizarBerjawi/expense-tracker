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


Route::get('/dashboard', 'HomeController@index')->name('dashboard');

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
