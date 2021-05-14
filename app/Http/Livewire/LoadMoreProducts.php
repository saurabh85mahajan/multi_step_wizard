<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class LoadMoreProducts extends Component
{

    public $perPage;
    public $page;
    public $loadMore = false;

    public function mount($page = null, $perPage = null) 
    {
        $this->page = $page ?? 1;
        $this->perPage = $perPage ?? 10;
    }

    public function loadMore() 
    {
        $this->page += 1;
        $this->loadMore = true;
    }

    public function render()
    {
        if (!$this->loadMore) {
            return view('livewire.products.load-more-products');
        } else {
            $products = Product::paginate($this->perPage, ['*'], null, $this->page);

            return view('livewire.products.load-products', [
                'products' => $products
            ]);
        }
    }
}
