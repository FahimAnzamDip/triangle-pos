<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mr. Hebrews Cafe | Invoice #{{ $sale->reference }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/mrhebrews.png') }}">
    <style>
        * {
            font-size: 12px;
            line-height: 18px;
            font-family: 'Ubuntu', sans-serif;
        }
        h2 {
            font-size: 16px;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dashed #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%; height: auto;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            tbody::after {
                content: '';
                display: block;
                page-break-after: avoid;
                page-break-inside: avoid;
                page-break-before: avoid;
            }
        }
    </style>
</head>
<body>

<div style="max-width:400px;margin:0 auto">
    <div id="receipt-data">
        <div class="centered">
            <img src="{{ $logo }}" class="img-fluid img-thumbnail mb-2" width="50px" height="50px" />
            <h2 style="margin-bottom: 5px">{{ settings()->company_name }}</h2>

            <p style="font-size: 11px;line-height: 15px;margin-top: 0">
                {{ settings()->company_email }}, {{ settings()->company_phone }}
                <br>{{ settings()->company_address }}
            </p>
        </div>
        <p>
            Date: {{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}<br>
            Reference: {{ $sale->reference }}<br>
            Name: {{ $sale->customer_name }}
        </p>
        <table class="table-data">
            <tbody>
            @foreach($sale->saleDetails as $saleDetail)
                <tr>
                    <td colspan="2">
                        {{ $saleDetail->product->product_name }}
                        ({{ $saleDetail->quantity }} x {{ format_currency($saleDetail->price) }})
                    </td>
                    <td style="text-align:right;vertical-align:bottom">{{ format_currency($saleDetail->sub_total) }}</td>
                </tr>
            @endforeach

            @if($sale->tax_percentage)
                <tr>
                    <th colspan="2" style="text-align:left">Tax ({{ $sale->tax_percentage }}%)</th>
                    <th style="text-align:right">{{ format_currency($sale->tax_amount) }}</th>
                </tr>
            @endif
            @if($sale->discount_percentage)
                <tr>
                    <th colspan="2" style="text-align:left">Discount ({{ $sale->discount_percentage }}%)</th>
                    <th style="text-align:right">{{ format_currency($sale->discount_amount) }}</th>
                </tr>
            @endif
            @if($sale->shipping_amount)
                <tr>
                    <th colspan="2" style="text-align:left">Shipping</th>
                    <th style="text-align:right">{{ format_currency($sale->shipping_amount) }}</th>
                </tr>
            @endif
            <tr>
                <th colspan="2" style="text-align:left">Grand Total</th>
                <th style="text-align:right">{{ format_currency($sale->total_amount) }}</th>
            </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr style="background-color:#ddd;">
                    <td class="centered" style="padding: 5px;">
                        Paid By: {{ $sale->payment_method }}
                    </td>
                    <td class="centered" style="padding: 5px;">
                        Amount: {{ format_currency($sale->paid_amount) }}
                    </td>
                </tr>
                <tr style="border-bottom: 0;">
                    <td class="centered" colspan="3">
                        <div style="margin-top: 10px;">
                            {!! \Milon\Barcode\Facades\DNS1DFacade::getBarcodeSVG($sale->reference, 'C128', 1, 25, 'black', false) !!}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
