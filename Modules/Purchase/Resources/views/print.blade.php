<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('purchase::messages.purchase_details') }}</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;margin-bottom: 25px;">
                <img width="180" src="{{ public_path('images/logo-dark.png') }}" alt="Logo">
                <h4 style="margin-bottom: 20px;">
                    <span>{{ __('purchase::messages.reference') }}:</span> <strong>{{ $purchase->reference }}</strong>
                </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">{{ __('purchase::messages.company_info') }}:</h4>
                            <div><strong>{{ settings()->company_name }}</strong></div>
                            <div>{{ settings()->company_address }}</div>
                            <div>{{ __('purchase::messages.email') }}: {{ settings()->company_email }}</div>
                            <div>{{ __('purchase::messages.phone') }}: {{ settings()->company_phone }}</div>
                        </div>

                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">{{ __('purchase::messages.supplier_info') }}:</h4>
                            <div><strong>{{ $supplier->supplier_name }}</strong></div>
                            <div>{{ $supplier->address }}</div>
                            <div>{{ __('purchase::messages.email') }}: {{ $supplier->supplier_email }}</div>
                            <div>{{ __('purchase::messages.phone') }}: {{ $supplier->supplier_phone }}</div>
                        </div>

                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">{{ __('purchase::messages.invoice_info') }}:</h4>
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

                    <div class="table-responsive-sm" style="margin-top: 30px;">
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
                        <div class="col-xs-4 col-xs-offset-8">
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
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-xs-12">
                            <p style="font-style: italic;text-align: center">{{ settings()->company_name }} &copy; {{ date('Y') }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
