<?php

namespace Modules\SalesReturn\Http\Controllers;

use Modules\SalesReturn\DataTables\SaleReturnsDataTable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Product;
use Modules\SalesReturn\Entities\SaleReturn;
use Modules\SalesReturn\Entities\SaleReturnDetail;
use Modules\SalesReturn\Entities\SaleReturnPayment;
use Modules\SalesReturn\Http\Requests\StoreSaleReturnRequest;
use Modules\SalesReturn\Http\Requests\UpdateSaleReturnRequest;

class SalesReturnController extends Controller
{

    public function index(SaleReturnsDataTable $dataTable) {
        abort_if(Gate::denies('access_sale_returns'), 403);

        return $dataTable->render('salesreturn::index');
    }


    public function create() {
        abort_if(Gate::denies('create_sale_returns'), 403);

        Cart::instance('sale_return')->destroy();

        return view('salesreturn::create');
    }


    public function store(StoreSaleReturnRequest $request) {
        DB::transaction(function () use ($request) {
            $due_amount = $request->total_amount - $request->paid_amount;

            if ($due_amount == $request->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            $sale_return = SaleReturn::create([
                'date' => $request->date,
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => $request->status,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('sale_return')->tax() * 100,
                'discount_amount' => Cart::instance('sale_return')->discount() * 100,
            ]);

            foreach (Cart::instance('sale_return')->content() as $cart_item) {
                SaleReturnDetail::create([
                    'sale_return_id' => $sale_return->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    'price' => $cart_item->price * 100,
                    'unit_price' => $cart_item->options->unit_price * 100,
                    'sub_total' => $cart_item->options->sub_total * 100,
                    'product_discount_amount' => $cart_item->options->product_discount * 100,
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => $cart_item->options->product_tax * 100,
                ]);

                if ($request->status == 'Completed') {
                    $product = Product::findOrFail($cart_item->id);
                    $product->update([
                        'product_quantity' => $product->product_quantity + $cart_item->qty
                    ]);
                }
            }

            Cart::instance('sale_return')->destroy();

            if ($sale_return->paid_amount > 0) {
                SaleReturnPayment::create([
                    'date' => $request->date,
                    'reference' => 'INV/'.$sale_return->reference,
                    'amount' => $sale_return->paid_amount,
                    'sale_return_id' => $sale_return->id,
                    'payment_method' => $request->payment_method
                ]);
            }
        });

        toast('Sale Return Created!', 'success');

        return redirect()->route('sale-returns.index');
    }


    public function show(SaleReturn $sale_return) {
        abort_if(Gate::denies('show_sale_returns'), 403);

        $customer = Customer::findOrFail($sale_return->customer_id);

        return view('salesreturn::show', compact('sale_return', 'customer'));
    }


    public function edit(SaleReturn $sale_return) {
        abort_if(Gate::denies('edit_sale_returns'), 403);

        $sale_return_details = $sale_return->saleReturnDetails;

        Cart::instance('sale_return')->destroy();

        $cart = Cart::instance('sale_return');

        foreach ($sale_return_details as $sale_return_detail) {
            $cart->add([
                'id'      => $sale_return_detail->product_id,
                'name'    => $sale_return_detail->product_name,
                'qty'     => $sale_return_detail->quantity,
                'price'   => $sale_return_detail->price,
                'weight'  => 1,
                'options' => [
                    'product_discount' => $sale_return_detail->product_discount_amount,
                    'product_discount_type' => $sale_return_detail->product_discount_type,
                    'sub_total'   => $sale_return_detail->sub_total,
                    'code'        => $sale_return_detail->product_code,
                    'stock'       => Product::findOrFail($sale_return_detail->product_id)->product_quantity,
                    'product_tax' => $sale_return_detail->product_tax_amount,
                    'unit_price'  => $sale_return_detail->unit_price
                ]
            ]);
        }

        return view('salesreturn::edit', compact('sale_return'));
    }


    public function update(UpdateSaleReturnRequest $request, SaleReturn $sale_return) {
        DB::transaction(function () use ($request, $sale_return) {
            $due_amount = $request->total_amount - $request->paid_amount;

            if ($due_amount == $request->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            foreach ($sale_return->saleReturnDetails as $sale_return_detail) {
                if ($sale_return->status == 'Completed') {
                    $product = Product::findOrFail($sale_return_detail->product_id);
                    $product->update([
                        'product_quantity' => $product->product_quantity - $sale_return_detail->quantity
                    ]);
                }
                $sale_return_detail->delete();
            }

            $sale_return->update([
                'date' => $request->date,
                'reference' => $request->reference,
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => $request->status,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('sale_return')->tax() * 100,
                'discount_amount' => Cart::instance('sale_return')->discount() * 100,
            ]);

            foreach (Cart::instance('sale_return')->content() as $cart_item) {
                SaleReturnDetail::create([
                    'sale_return_id' => $sale_return->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    'price' => $cart_item->price * 100,
                    'unit_price' => $cart_item->options->unit_price * 100,
                    'sub_total' => $cart_item->options->sub_total * 100,
                    'product_discount_amount' => $cart_item->options->product_discount * 100,
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => $cart_item->options->product_tax * 100,
                ]);

                if ($request->status == 'Completed') {
                    $product = Product::findOrFail($cart_item->id);
                    $product->update([
                        'product_quantity' => $product->product_quantity + $cart_item->qty
                    ]);
                }
            }

            Cart::instance('sale_return')->destroy();
        });

        toast('Sale Return Updated!', 'info');

        return redirect()->route('sale-returns.index');
    }


    public function destroy(SaleReturn $sale_return) {
        abort_if(Gate::denies('delete_sale_returns'), 403);

        $sale_return->delete();

        toast('Sale Return Deleted!', 'warning');

        return redirect()->route('sale-returns.index');
    }
}
