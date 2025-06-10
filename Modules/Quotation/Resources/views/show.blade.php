@extends('layouts.app')

@section('title', __('quotation::messages.quotation_details'))

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('quotations.index') }}">{{ __('quotation::messages.quotations') }}</a></li>
        <li class="breadcrumb-item active">{{ __('quotation::messages.details') }}</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            {{ __('quotation::messages.reference') }}: <strong>{{ $quotation->reference }}</strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="{{ route('quotations.pdf', $quotation->id) }}">
                            <i class="bi bi-printer"></i> {{ __('quotation::messages.print') }}
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none" href="{{ route('quotations.pdf', $quotation->id) }}">
                            <i class="bi bi-save"></i> {{ __('quotation::messages.save') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('quotation::messages.company_info') }}</h5>
                                <div><strong>{{ settings()->company_name }}</strong></div>
                                <div>{{ settings()->company_address }}</div>
                                <div>{{ __('quotation::messages.email') }}: {{ settings()->company_email }}</div>
                                <div>{{ __('quotation::messages.phone') }}: {{ settings()->company_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('quotation::messages.customer_info') }}</h5>
                                <div><strong>{{ $customer->customer_name }}</strong></div>
                                <div>{{ $customer->address }}</div>
                                <div>{{ __('quotation::messages.email') }}: {{ $customer->customer_email }}</div>
                                <div>{{ __('quotation::messages.phone') }}: {{ $customer->customer_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">{{ __('quotation::messages.invoice_info') }}</h5>
                                <div>{{ __('quotation::messages.invoice') }}: <strong>INV/{{ $quotation->reference }}</strong></div>
                                <div>{{ __('quotation::messages.date') }}: {{ \Carbon\Carbon::parse($quotation->date)->format('d M, Y') }}</div>
                                <div>
                                    {{ __('quotation::messages.status') }}: <strong>{{ $quotation->status }}</strong>
                                </div>
                                <div>
                                    {{ __('quotation::messages.payment_status') }}: <strong>{{ $quotation->payment_status }}</strong>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="align-middle">{{ __('quotation::messages.product') }}</th>
                                    <th class="align-middle">{{ __('quotation::messages.net_unit_price') }}</th>
                                    <th class="align-middle">{{ __('quotation::messages.quantity') }}</th>
                                    <th class="align-middle">{{ __('quotation::messages.discount') }}</th>
                                    <th class="align-middle">{{ __('quotation::messages.tax') }}</th>
                                    <th class="align-middle">{{ __('quotation::messages.sub_total') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotation->quotationDetails as $item)
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
                                        <td class="left"><strong>{{ __('quotation::messages.discount') }} ({{ $quotation->discount_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($quotation->discount_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('quotation::messages.tax') }} ({{ $quotation->tax_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($quotation->tax_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('quotation::messages.shipping') }}</strong></td>
                                        <td class="right">{{ format_currency($quotation->shipping_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>{{ __('quotation::messages.grand_total') }}</strong></td>
                                        <td class="right"><strong>{{ format_currency($quotation->total_amount) }}</strong></td>
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

