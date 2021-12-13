<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
class LatestProduct extends Component
{
    public function render()
    {
        $products = ProductDetail::orderby('created_at','desc')->take(3)->get();
        return view('livewire.latest-product',[
            'products' => $products
        ]);
    }
}
