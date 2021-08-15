<?php

namespace Modules\Currency\Http\Controllers;

use Modules\Currency\DataTables\CurrencyDataTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\Currency\Entities\Currency;

class CurrencyController extends Controller
{

    public function index(CurrencyDataTable $dataTable) {
        abort_if(Gate::denies('access_currencies'), 403);

        return $dataTable->render('currency::index');
    }


    public function create() {
        abort_if(Gate::denies('create_currencies'), 403);

        return view('currency::create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create_currencies'), 403);

        $request->validate([
            'currency_name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'thousand_separator' => 'required|string|max:255',
            'decimal_separator' => 'required|string|max:255',
            'exchange_rate' => 'nullable|numeric|max:2147483647'
        ]);

        Currency::create([
            'currency_name' => $request->currency_name,
            'code' => Str::upper($request->code),
            'symbol' => $request->symbol,
            'thousand_separator' => $request->thousand_separator,
            'decimal_separator' => $request->decimal_separator,
            'exchange_rate' => $request->exchange_rate
        ]);

        toast('Currency Created!', 'success');

        return redirect()->route('currencies.index');
    }


    public function edit(Currency $currency) {
        abort_if(Gate::denies('edit_currencies'), 403);

        return view('currency::edit', compact('currency'));
    }


    public function update(Request $request, Currency $currency) {
        abort_if(Gate::denies('edit_currencies'), 403);

        $request->validate([
            'currency_name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'thousand_separator' => 'required|string|max:255',
            'decimal_separator' => 'required|string|max:255',
            'exchange_rate' => 'nullable|numeric|max:2147483647'
        ]);

        $currency->update([
            'currency_name' => $request->currency_name,
            'code' => Str::upper($request->code),
            'symbol' => $request->symbol,
            'thousand_separator' => $request->thousand_separator,
            'decimal_separator' => $request->decimal_separator,
            'exchange_rate' => $request->exchange_rate
        ]);

        toast('Currency Updated!', 'info');

        return redirect()->route('currencies.index');
    }


    public function destroy(Currency $currency) {
        abort_if(Gate::denies('delete_currencies'), 403);

        $currency->delete();

        toast('Currency Deleted!', 'warning');

        return redirect()->route('currencies.index');
    }
}
