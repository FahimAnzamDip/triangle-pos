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
use Illuminate\Support\Facades\View;

function calculateHeight($htmlContent)
{
    // Render the HTML content within a temporary view
    $tempView = View::make('temp')->with('htmlContent', $htmlContent);
    $tempHtml = $tempView->render();

    // Measure the height of the rendered HTML content (this is a placeholder)
    // In this example, we simply count the number of lines and assume a fixed height per line
    $lineHeight = 1; // Set your preferred line height (in pixels)
    $numLines = substr_count($tempHtml, "\n"); // Count the number of lines
    $height = $numLines * $lineHeight; // Calculate the estimated height

    return $height;
}
Route::group(['middleware' => 'auth'], function () {

    //POS
    Route::get('/app/pos', 'PosController@index')->name('app.pos.index');
    Route::post('/app/pos', 'PosController@store')->name('app.pos.store');

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

    Route::get('/sales/pos/pdf/{id}', function ($id) {
        $sale = \Modules\Sale\Entities\Sale::findOrFail($id);
        $logo = public_path('images/mrhebrews.png');
    
        // Render the HTML content of the sale POS using a temporary view
        $htmlContent = view('sale::print-pos', [
            'sale' => $sale,
            'logo' => $logo,
        ])->render();
    
        // Measure the height of the rendered HTML content
        $tempView = View::make('temp')->with('htmlContent', $htmlContent);
        $contentHeight = calculateHeight($tempView->render()); // Implement your height calculation function
    
        // Set the PDF options with dynamically calculated height
        $pdf = \PDF::loadView('sale::print-pos', [
            'sale' => $sale,
            'logo' => $logo,
        ])->setOption('page-width', '80mm')
          ->setOption('page-height', $contentHeight) // Set the calculated content height
          ->setOption('margin-top', 8)
          ->setOption('margin-bottom', 8)
          ->setOption('margin-left', 5)
          ->setOption('margin-right', 5);
    
        return $pdf->stream('sale-'. $sale->reference .'.pdf');
    })->name('sales.pos.pdf');

    // Route::get('/sales/pos/pdf/{id}', function ($id) {
    //     $sale = \Modules\Sale\Entities\Sale::findOrFail($id);

    //     $logo = public_path('images/mrhebrews.png');

    //     $pdf = \PDF::loadView('sale::print-pos', [
    //         'sale' => $sale,
    //         'logo' => $logo,
    //     ])->setOption('page-width', '80mm')
    //         ->setOption('page-height', 'content')
    //         ->setOption('margin-top', 8)
    //         ->setOption('margin-bottom', 8)
    //         ->setOption('margin-left', 5)
    //         ->setOption('margin-right', 5);

    //     return $pdf->stream('sale-'. $sale->reference .'.pdf');
    // })->name('sales.pos.pdf');

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
