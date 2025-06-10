@extends('layouts.app')

@section('title', __('purchase::messages.purchase_details'))

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">{{ __('purchase::messages.purchases') }}</a></li>
        <li class="breadcrumb-item active">{{ __('purchase::messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            {{ __('purchase::messages.reference') }}: <strong>{{ $purchase->reference }}</strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="{{ route('purchases.pdf', $purchase->id) }}">
                            <i class="bi bi-printer"></i> {{ __('purchase::messages.print') }}
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none" href="{{ route('purchases.pdf', $purchase->id) }}">
                            <i class="bi bi-save"></i> {{ __('purchase::messages.save') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('purchase::messages.company_info') }}:</h5>
                                <div><strong>{{ settings()->company_name }}</strong></div>
                                <div>{{ settings()->company_address }}</div>
                                <div>{{ __('purchase::messages.email') }}: {{ settings()->company_email }}</div>
                                <div>{{ __('purchase::messages.phone') }}: {{ settings()->company_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('purchase::messages.supplier_info') }}:</h5>
                                <div><strong>{{ $supplier->supplier_name }}</strong></div>
                                <div>{{ $supplier->address }}</div>
                                <div>{{ __('purchase::messages.email') }}: {{ $supplier->supplier_email }}</div>
                                <div>{{ __('purchase::messages.phone') }}: {{ $supplier->supplier_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('purchase::messages.invoice_info') }}:</h5>
                                <div>{{ __('purchase::messages.invoice') }}: <strong>INV/{{ $purchase->reference }}</strong></div>
                                <div>{{ __('purchase::messages.date') }}: {{ \Carbon\Carbon::parse($purchase->date)->format('d M, Y') }}</div>
                                <div>
                                    {{ __('purchase::messages.status') }}: <strong>{{ $purchase->status }}</strong>
                                </div>
                                <div>
                                    {{ __('purchase::messages.payment_status') }}: <strong>{{ $purchase->payment_status }}</strong>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="align-middle">{{ __('purchase::messages.product') }}</th>
                                    <th class="align-middle">{{ __('purchase::messages.net_unit_price') }}</th>
                                    <th class="align-middle">{{ __('purchase::messages.quantity') }}</th>
                                    <th class="align-middle">{{ __('purchase::messages.discount') }}</th>
                                    <th class="align-middle">{{ __('purchase::messages.tax') }}</th>
                                    <th class="align-middle">{{ __('purchase::messages.sub_total') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchase->purchaseDetails as $item)
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
                                        <td class="left"><strong>{{ __('purchase::messages.discount') }} ({{ $purchase->discount_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($purchase->discount_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchase::messages.tax') }} ({{ $purchase->tax_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($purchase->tax_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchase::messages.shipping') }}</strong></td>
                                        <td class="right">{{ format_currency($purchase->shipping_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('purchase::messages.grand_total') }}</strong></td>
                                        <td class="right"><strong>{{ format_currency($purchase->total_amount) }}</strong></td>
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

