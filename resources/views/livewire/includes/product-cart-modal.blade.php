<!-- Button trigger Discount Modal -->
<span role="button" class="badge badge-warning pointer-event" data-toggle="modal" data-target="#discountModal{{ $cart_item->id }}">
    <i class="bi bi-pencil-square text-white"></i>
</span>
<!-- Discount Modal -->
<div wire:ignore.self class="modal fade" id="discountModal{{ $cart_item->id }}" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="discountModalLabel">
                    {{ $cart_item->name }}
                    <br>
                    <span class="badge badge-success">
                        {{ $cart_item->options->code }}
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="setProductDiscount('{{ $cart_item->rowId }}', '{{ $cart_item->id }}')" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Discount Type <span class="text-danger">*</span></label>
                        <select wire:model.defer="discount_type.{{ $cart_item->id }}" class="form-control" required>
                            <option {{ $discount_type[$cart_item->id] == 'fixed' ? 'selected' : '' }} value="fixed">Fixed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discount <span class="text-danger">*</span></label>
                        <input wire:model.defer="item_discount.{{ $cart_item->id }}" type="number" class="form-control" value="{{ $item_discount[$cart_item->id] }}" step="0.01">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
