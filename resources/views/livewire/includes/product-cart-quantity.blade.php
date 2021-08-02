<form wire:submit.prevent="updateQuantity('{{ $cart_item->rowId }}', '{{ $cart_item->id }}')">
    <div class="form-inline">
        <input wire:model.lazy="quantity.{{ $cart_item->id }}" style="width: 90px;" type="number" class="form-control" value="{{ $cart_item->qty }}" min="1">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check"></i>
        </button>
    </div>
</form>
