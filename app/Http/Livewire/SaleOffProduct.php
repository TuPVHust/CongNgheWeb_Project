<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
use App\Models\Product;
class SaleOffProduct extends Component
{
    public function render()
    {
        $products = Product::whereColumn([['price', '>', 'sale'],])->orderByRaw("sale/price ASC")->take(5)->get();
        return view('livewire.sale-off-product',[
            'products' => $products
        ]);
    }
}
