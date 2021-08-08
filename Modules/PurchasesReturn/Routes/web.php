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

Route::group(['middleware' => 'auth'], function() {

    //Generate PDF
    Route::get('/purchase-returns/pdf/{id}', function ($id) {
        $purchaseReturn = \Modules\PurchasesReturn\Entities\PurchaseReturn::findOrFail($id);
        $supplier = \Modules\People\Entities\Supplier::findOrFail($purchaseReturn->supplier_id);

        $pdf = \PDF::loadView('purchasesreturn::print', [
            'purchase_return' => $purchaseReturn,
            'supplier' => $supplier,
        ])->setPaper('a4');

        return $pdf->stream('purchase-return-'. $purchaseReturn->reference .'.pdf');
    })->name('purchase-returns.pdf');

    //Purchase Returns
    Route::resource('purchase-returns', 'PurchasesReturnController');

    //Payments
    Route::get('/purchase-return-payments/{purchase_return_id}', 'PurchaseReturnPaymentsController@index')
        ->name('purchase-return-payments.index');
    Route::get('/purchase-return-payments/{purchase_return_id}/create', 'PurchaseReturnPaymentsController@create')
        ->name('purchase-return-payments.create');
    Route::post('/purchase-return-payments/store', 'PurchaseReturnPaymentsController@store')
        ->name('purchase-return-payments.store');
    Route::get('/purchase-return-payments/{purchase_return_id}/edit/{purchaseReturnPayment}', 'PurchaseReturnPaymentsController@edit')
        ->name('purchase-return-payments.edit');
    Route::patch('/purchase-return-payments/update/{purchaseReturnPayment}', 'PurchaseReturnPaymentsController@update')
        ->name('purchase-return-payments.update');
    Route::delete('/purchase-return-payments/destroy/{purchaseReturnPayment}', 'PurchaseReturnPaymentsController@destroy')
        ->name('purchase-return-payments.destroy');

});
