<?php

namespace App\Http\Livewire\Barcode;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Product\Entities\Product;

class SearchProduct extends Component
{

    public $query;
    public $searchResults;

    public function mount() {
        $this->query = '';
        $this->searchResults = Collection::empty();
    }

    public function render() {
        return view('livewire.barcode.search-product');
    }

    public function updatedQuery() {
        $this->searchResults = Product::where('product_name', 'like', '%' . $this->query . '%')
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->get();
    }

    public function resetQuery() {
        $this->query = '';
        $this->searchResults = Collection::empty();
    }

    public function selectProduct($product) {
        $this->emit('productSelected', $product);
    }
}
