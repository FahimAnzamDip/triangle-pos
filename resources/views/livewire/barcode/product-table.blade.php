<div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr class="align-middle">
                        <th class="align-middle">Product Name</th>
                        <th class="align-middle">Code</th>
                        <th class="align-middle">Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @if(!empty($product))
                            <td class="align-middle">{{ $product->product_name }}</td>
                            <td class="align-middle">{{ $product->product_code }}</td>
                            <td class="align-middle text-center" style="width: 200px;">
                                <input wire:model="quantity" class="form-control" type="number" min="1"
                                       value="{{ $quantity }}">
                            </td>
                        @else
                            <td colspan="3" class="text-center">
                                <span class="text-danger">Please search & select a product!</span>
                            </td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button
                    wire:click="generateBarcodes({{ $product }}, {{ $quantity }})"
                    type="button" class="btn btn-primary"><i class="bi bi-upc-scan"></i> Generate Barcodes
                </button>
            </div>
        </div>
    </div>

    @if(!empty($barcodes))
        <div class="text-right mb-3">
            <button wire:click="getPdf" wire:loading.attr="disabled" type="button" class="btn btn-primary">
                <span wire:loading wire:target="getPdf" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <i wire:loading.remove wire:target="getPdf" class="bi bi-file-earmark-pdf"></i> Download PDF
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach($barcodes as $barcode)
                        <div class="col-lg-3 col-md-4 col-sm-6" style="border: 1px solid #ffffff;border-style: dashed;background-color: #48FCFE;">
                            <p class="mt-3 mb-1" style="font-size: 15px;color: #000;">
                                {{ $product->product_name }}
                            </p>
                            <div>
                                {!! $barcode !!}
                            </div>
                            <p style="font-size: 15px;color: #000;">
                                Price:: {{ format_currency($product->product_price) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
