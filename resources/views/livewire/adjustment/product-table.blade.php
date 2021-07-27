<div>
    @if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <span>{{ session('message') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    <div class="table-responsive-md">
        <table class="table table-bordered">
            <thead>
            <tr class="align-middle">
                <th class="align-middle">#</th>
                <th class="align-middle">Product Name</th>
                <th class="align-middle">Code</th>
                <th class="align-middle">Stock</th>
                <th class="align-middle">Quantity</th>
                <th class="align-middle">Type</th>
                <th class="align-middle">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($products))
                @foreach($products as $key => $product)
                    <tr>
                        <td class="align-middle">{{ $key + 1 }}</td>
                        <td class="align-middle">{{ $product['product_name'] ?? $product['product']['product_name'] }}</td>
                        <td class="align-middle">{{ $product['product_code'] ?? $product['product']['product_code'] }}</td>
                        <td class="align-middle text-center">
                            <span class="badge badge-info">
                                {{ $product['product_quantity'] ?? $product['product']['product_quantity'] }}
                            </span>
                        </td>
                        <input type="hidden" name="product_ids[]" value="{{ $product['product']['id'] ?? $product['id'] }}">
                        <td class="align-middle">
                            <input type="number" name="quantities[]" min="1" class="form-control" value="{{ $product['quantity'] ?? 1 }}">
                        </td>
                        <td class="align-middle">
                            @if(isset($product['type']))
                                @if($product['type'] == 'add')
                                    <select name="types[]" class="form-control">
                                        <option value="add">(+) Addition</option>
                                    </select>
                                @elseif($product['type'] == 'sub')
                                    <select name="types[]" class="form-control">
                                        <option value="sub">(-) Subtraction</option>
                                    </select>
                                @endif
                            @else
                                <select name="types[]" class="form-control">
                                    <option value="add">(+) Addition</option>
                                    <option value="sub">(-) Subtraction</option>
                                </select>
                            @endif
                        </td>
                        <td class="align-middle text-center">
                            <button type="button" class="btn btn-danger" wire:click="removeProduct({{ $key }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">
                        <span class="text-danger">
                            Please search & select products!
                        </span>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
