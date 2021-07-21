<div class="position-relative">
    <div class="card mb-0">
        <div class="card-body">
            <div class="form-group mb-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                    <input wire:keydown.escape="resetQuery" wire:model.debounce.500ms="query" type="text" class="form-control" placeholder="Type product name or code....">
                </div>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="query" class="card position-absolute mt-1" style="z-index: 1;left: 0;right: 0;">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($query))
        <div wire:click="resetQuery" class="position-fixed w-100 h-100" style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>
        @if($searchResults->isNotEmpty())
            <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($searchResults as $result)
                            <li class="list-group-item list-group-item-action">
                                <a wire:click="resetQuery" wire:click.prevent="selectProduct({{$result}})" href="#">
                                    {{ $result->product_name }} | {{ $result->product_code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="card position-absolute mt-1" style="z-index: 1;left: 0;right: 0;">
                <div class="card-body">
                    <div class="alert alert-warning mb-0">
                        No Results....
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
