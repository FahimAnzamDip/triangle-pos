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

Route::group(['middleware' => 'auth'], function () {

    //Expense Category
    Route::resource('expense-categories', 'ExpenseCategoriesController')->except('show', 'create');
    //Expense
    Route::resource('expenses', 'ExpenseController')->except('show');

});
