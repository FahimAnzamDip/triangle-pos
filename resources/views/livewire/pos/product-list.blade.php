<div>
    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <livewire:pos.filter :categories="$categories"/>
            <div class="row position-relative">
                <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @forelse($products as $product)
                    <div wire:click.prevent="selectProduct({{ $product }})" class="col-lg-4 col-md-6" style="cursor: pointer;">
                        <div class="card border-0 shadow h-100">
                            <div class="position-relative">
                                <img height="200" src="{{ $product->getFirstMediaUrl('images') }}" class="card-img-top" alt="Product Image">
                                <div class="badge badge-info mb-3 position-absolute" style="left:10px;top: 10px;">Stock: {{ $product->product_quantity }}</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <h6 style="font-size: 13px;" class="card-title mb-0">{{ $product->product_name }}</h6>
                                    <span class="badge badge-success">
                                    {{ $product->product_code }}
                                </span>
                                </div>
                                <p class="card-text font-weight-bold">{{ format_currency($product->product_price) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">
                            Products Not Found...
                        </div>
                    </div>
                @endforelse
            </div>
            <div @class(['mt-3' => $products->hasPages()])>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
