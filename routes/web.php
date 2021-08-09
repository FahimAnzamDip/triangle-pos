<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home')->middleware('auth');

Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
    ->name('sales-purchases.chart')->middleware('auth');

Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
    ->name('current-month.chart')->middleware('auth');

