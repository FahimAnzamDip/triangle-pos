@extends('layouts.app')

@section('title', __('purchasesreturn::messages.purchase_details'))

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchase-returns.index') }}">{{ __('purchasesreturn::messages.purchase_returns') }}</a></li>
        <li class="breadcrumb-item active">{{ __('purchasesreturn::messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            {{ __('purchasesreturn::messages.reference') }}: <strong>{{ $purchase_return->reference }}</strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="{{ route('purchase-returns.pdf', $purchase_return->id) }}">
                            <i class="bi bi-printer"></i> {{ __('purchasesreturn::messages.print') }}
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none" href="{{ route('purchase-returns.pdf', $purchase_return->id) }}">
                            <i class="bi bi-save"></i> {{ __('purchasesreturn::messages.save') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('purchasesreturn::messages.company_info') }}:</h5>
                                <div><strong>{{ settings()->company_name }}</strong></div>
                                <div>{{ settings()->company_address }}</div>
                                <div>{{ __('purchasesreturn::messages.email') }}: {{ settings()->company_email }}</div>
                                <div>{{ __('purchasesreturn::messages.phone') }}: {{ settings()->company_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('purchasesreturn::messages.supplier_info') }}:</h5>
                                <div><strong>{{ $supplier->supplier_name }}</strong></div>
                                <div>{{ $supplier->address }}</div>
                                <div>{{ __('purchasesreturn::messages.email') }}: {{ $supplier->supplier_email }}</div>
                                <div>{{ __('purchasesreturn::messages.phone') }}: {{ $supplier->supplier_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('purchasesreturn::messages.invoice_info') }}:</h5>
                                <div>{{ __('purchasesreturn::messages.invoice') }}: <strong>INV/{{ $purchase_return->reference }}</strong></div>
                                <div>{{ __('purchasesreturn::messages.date') }}: {{ \Carbon\Carbon::parse($purchase_return->date)->format('d M, Y') }}</div>
                                <div>
                                    {{ __('purchasesreturn::messages.status') }}: <strong>{{ $purchase_return->status }}</strong>
                                </div>
                                <div>
                                    {{ __('purchasesreturn::messages.payment_status') }}: <strong>{{ $purchase_return->payment_status }}</strong>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="align-middle">{{ __('purchasesreturn::messages.product') }}</th>
                                    <th class="align-middle">{{ __('purchasesreturn::messages.net_unit_price') }}</th>
                                    <th class="align-middle">{{ __('purchasesreturn::messages.quantity') }}</th>
                                    <th class="align-middle">{{ __('purchasesreturn::messages.discount') }}</th>
                                    <th class="align-middle">{{ __('purchasesreturn::messages.tax') }}</th>
                                    <th class="align-middle">{{ __('purchasesreturn::messages.sub_total') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchase_return->purchaseReturnDetails as $item)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $item->product_name }} <br>
                                            <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span>
                                        </td>

                                        <td class="align-middle">{{ format_currency($item->unit_price) }}</td>

                                        <td class="align-middle">
                                            {{ $item->quantity }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->product_discount_amount) }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->product_tax_amount) }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->sub_total) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 ml-md-auto">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchasesreturn::messages.discount') }} ({{ $purchase_return->discount_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($purchase_return->discount_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchasesreturn::messages.tax') }} ({{ $purchase_return->tax_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($purchase_return->tax_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchasesreturn::messages.shipping') }}</strong></td>
                                        <td class="right">{{ format_currency($purchase_return->shipping_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchasesreturn::messages.grand_total') }}</strong></td>
                                        <td class="right"><strong>{{ format_currency($purchase_return->total_amount) }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

