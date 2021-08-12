<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Entities\Product;

class ProductList extends Component
{

    protected $listeners = [
        'selectedCategory' => 'categoryChanged',
        'showCount'        => 'showCountChanged'
    ];

    public $categories;
    public $products;
    public $limit = 9;

    public function mount($categories) {
        $this->products = Product::limit($this->limit)->get();
        $this->categories = $categories;
    }

    public function render() {
        return view('livewire.pos.product-list');
    }

    public function categoryChanged($category_id) {
        if ($category_id == '*') {
            $this->products = Product::limit($this->limit)->get();
        } else {
            $this->products = Product::where('category_id', $category_id)->limit($this->limit)->get();
        }
    }

    public function showCountChanged($value) {
        $this->limit = $value;
    }

    public function selectProduct($product) {
        $this->emit('productSelected', $product);
    }
}
