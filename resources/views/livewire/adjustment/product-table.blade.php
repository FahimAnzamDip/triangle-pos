<div>
    @if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <span>{{ session('message') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('adjustment::messages.close') }}">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    <div class="table-responsive">
        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">{{ __('adjustment::messages.loading') }}</span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr class="align-middle">
                <th class="align-middle">#</th>
                <th class="align-middle">{{ __('adjustment::messages.product_name') }}</th>
                <th class="align-middle">{{ __('adjustment::messages.code') }}</th>
                <th class="align-middle">{{ __('adjustment::messages.stock') }}</th>
                <th class="align-middle">{{ __('adjustment::messages.quantity') }}</th>
                <th class="align-middle">{{ __('adjustment::messages.type') }}</th>
                <th class="align-middle">{{ __('adjustment::messages.action') }}</th>
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
                                {{ $product['product_quantity'] ?? $product['product']['product_quantity'] }} {{ $product['product_unit'] ?? $product['product']['product_unit'] }}
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
                                        <option value="add" selected>(+) {{ __('adjustment::messages.addition') }}</option>
                                        <option value="sub">(-) {{ __('adjustment::messages.subtraction') }}</option>
                                    </select>
                                @elseif($product['type'] == 'sub')
                                    <select name="types[]" class="form-control">
                                        <option value="sub" selected>(-) {{ __('adjustment::messages.subtraction') }}</option>
                                        <option value="add">(+) {{ __('adjustment::messages.addition') }}</option>
                                    </select>
                                @endif
                            @else
                                <select name="types[]" class="form-control">
                                    <option value="add">(+) {{ __('adjustment::messages.addition') }}</option>
                                    <option value="sub">(-) {{ __('adjustment::messages.subtraction') }}</option>
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
                            {{ __('adjustment::messages.search_and_select') }}
                        </span>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
