<div>
    {{-- The best athlete wants his opponent at his best. --}}
</div>

@if($showForm)
<div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $group_id ? 'Edit' : 'Add' }} Group</h5>
                <button type="button" class="btn-close" wire:click="$set('showForm', false)"></button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Group Code</label>
                        <input type="text" class="form-control" wire:model.defer="group_code">
                        @error('group_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Group Name</label>
                        <input type="text" class="form-control" wire:model.defer="group_name">
                        @error('group_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Group Type</label>
                        <input type="text" class="form-control" wire:model.defer="group_type" placeholder="e.g. TUA, MUDA">
                        @error('group_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Base Price (per gram, 100% purity)</label>
                        <input type="number" step="0.01" class="form-control" wire:model.defer="base_price">
                        @error('base_price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cost Price (per gram, 100% purity)</label>
                        <input type="number" step="0.01" class="form-control" wire:model.defer="cost_price">
                        @error('cost_price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showForm', false)">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
