<?php

namespace App\Http\Livewire;

use App\Models\ProductDetail;
use Livewire\Component;

class SortBar extends Component
{
    public $sortFeature = 'cert_products.id';
    public function mount() {
        $this->emit('publishSort' ,$this->sortFeature);
    }
    public function render()
    {
        $products = ProductDetail::all();
        return view('livewire.sort-bar',[
            'products' => $products,
        ]);
    }
}
