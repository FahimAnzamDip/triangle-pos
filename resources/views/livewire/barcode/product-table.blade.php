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
                                <input wire:model="quantity" class="form-control" type="number" min="1" value="{{ $quantity }}">
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
                <button {{ empty($product) ? 'disabled' : '' }} wire:click="generateBarcodes({{ $product }}, {{ $quantity }})" type="button" class="btn btn-primary"><i class="bi bi-upc-scan"></i> Generate Barcodes
                </button>
            </div>
        </div>
    </div>

    @if(!empty($barcodes))
        <div class="card">
            <div class="card-body d-flex flex-wrap justify-content-center align-items-center pt-5">
                @foreach($barcodes as $barcode)
                    <div class="mr-5 mb-5">
                        {!! $barcode !!}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
