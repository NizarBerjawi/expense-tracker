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

Route::group(['prefix' => 'expenses'], function () {
    Route::get('/', 'ExpensesController@index')->name('expenses.index');
});

Route::group(['prefix' => 'income'], function () {
    Route::get('/', 'IncomeController@index')->name('income.index');
});
