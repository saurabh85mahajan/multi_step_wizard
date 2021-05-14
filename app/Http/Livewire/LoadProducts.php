<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class LoadProducts extends Component
{
    public $perPage;
    public $page;

    public function mount($page = null, $perPage = null) 
    {
        $this->page = $page ?? 1;
        $this->perPage = $perPage ?? 10;
    }

    public function render()
    {
        $products = Product::paginate($this->perPage, ['*'], null, $this->page);

        return view('livewire.products.load-products', [
            'products' => $products
        ]);
    }
}
