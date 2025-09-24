<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product - E-Commerce')] //dynamic title 

class ProductsPage extends Component
{
    public function render()
    {
        $products = Products::where('is_active', 1 )->get();
        return view('livewire.products-page',[
            'products' => $products
        ]);
    }
}
