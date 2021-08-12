<form wire:submit.prevent="updateQuantity('{{ $cart_item->rowId }}', '{{ $cart_item->id }}')">
        <div class="input-group">
            <input wire:model.defer="quantity.{{ $cart_item->id }}" style="min-width: 40px;max-width: 90px;" type="number" class="form-control" value="{{ $cart_item->qty }}" min="1">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check"></i>
                </button>
            </div>
        </div>
</form>
