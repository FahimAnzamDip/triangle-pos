<?php

namespace Modules\Sale\Http\Controllers;

use Modules\Sale\DataTables\SalePaymentsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SalePayment;

class SalePaymentsController extends Controller
{

    public function index($sale_id, SalePaymentsDataTable $dataTable) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $sale = Sale::findOrFail($sale_id);

        return $dataTable->render('sale::payments.index', compact('sale'));
    }


    public function create($sale_id) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $sale = Sale::findOrFail($sale_id);

        return view('sale::payments.create', compact('sale'));
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string|max:1000',
            'sale_id' => 'required',
            'payment_method' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request) {
            SalePayment::create([
                'date' => $request->date,
                'reference' => $request->reference,
                'amount' => $request->amount,
                'note' => $request->note,
                'sale_id' => $request->sale_id,
                'payment_method' => $request->payment_method
            ]);

            $sale = Sale::findOrFail($request->sale_id);

            $due_amount = $sale->due_amount - $request->amount;

            if ($due_amount == $sale->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            $sale->update([
                'paid_amount' => ($sale->paid_amount + $request->amount) * 100,
                'due_amount' => $due_amount * 100,
                'payment_status' => $payment_status
            ]);
        });

        toast('Sale Payment Created!', 'success');

        return redirect()->route('sales.index');
    }


    public function edit($sale_id, SalePayment $salePayment) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $sale = Sale::findOrFail($sale_id);

        return view('sale::payments.edit', compact('salePayment', 'sale'));
    }


    public function update(Request $request, SalePayment $salePayment) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string|max:1000',
            'sale_id' => 'required',
            'payment_method' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request, $salePayment) {
            $sale = $salePayment->sale;

            $due_amount = ($sale->due_amount + $salePayment->amount) - $request->amount;

            if ($due_amount == $sale->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            $sale->update([
                'paid_amount' => (($sale->paid_amount - $salePayment->amount) + $request->amount) * 100,
                'due_amount' => $due_amount * 100,
                'payment_status' => $payment_status
            ]);

            $salePayment->update([
                'date' => $request->date,
                'reference' => $request->reference,
                'amount' => $request->amount,
                'note' => $request->note,
                'sale_id' => $request->sale_id,
                'payment_method' => $request->payment_method
            ]);
        });

        toast('Sale Payment Updated!', 'info');

        return redirect()->route('sales.index');
    }


    public function destroy(SalePayment $salePayment) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $salePayment->delete();

        toast('Sale Payment Deleted!', 'warning');

        return redirect()->route('sales.index');
    }
}
