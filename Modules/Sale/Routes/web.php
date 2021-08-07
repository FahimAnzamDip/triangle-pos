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

    //Generate PDF
    Route::get('/sales/pdf/{id}', function ($id) {
        $sale = \Modules\Sale\Entities\Sale::findOrFail($id);
        $customer = \Modules\People\Entities\Customer::findOrFail($sale->customer_id);

        $pdf = \PDF::loadView('sale::print', [
            'sale' => $sale,
            'customer' => $customer,
        ])->setPaper('a4');

        return $pdf->stream('sale-'. $sale->reference .'.pdf');
    })->name('sales.pdf');

    //Sales
    Route::resource('sales', 'SaleController');

    //Payments
    Route::get('/sale-payments/{sale_id}', 'SalePaymentsController@index')->name('sale-payments.index');
    Route::get('/sale-payments/{sale_id}/create', 'SalePaymentsController@create')->name('sale-payments.create');
    Route::post('/sale-payments/store', 'SalePaymentsController@store')->name('sale-payments.store');
    Route::get('/sale-payments/{sale_id}/edit/{salePayment}', 'SalePaymentsController@edit')->name('sale-payments.edit');
    Route::patch('/sale-payments/update/{salePayment}', 'SalePaymentsController@update')->name('sale-payments.update');
    Route::delete('/sale-payments/destroy/{salePayment}', 'SalePaymentsController@destroy')->name('sale-payments.destroy');
});
