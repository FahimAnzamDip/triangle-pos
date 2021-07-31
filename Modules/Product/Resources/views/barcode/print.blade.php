<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcodes</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        @foreach($barcodes as $barcode)
            <div class="col-xs-3" style="border: 1px solid #dddddd;border-style: dashed;">
                <p style="font-size: 15px;color: #000;margin-top: 15px;margin-bottom: 5px;">
                    {{ $name }}
                </p>
                <div>
                    {!! $barcode !!}
                </div>
                <p style="font-size: 15px;color: #000;font-weight: bold;">
                    Price:: {{ format_currency($price) }}</p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
