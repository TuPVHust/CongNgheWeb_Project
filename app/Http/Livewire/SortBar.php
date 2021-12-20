<?php

namespace App\Http\Livewire;

use App\Models\ProductDetail;
use Livewire\Component;
use App\Models\Product;


class SortBar extends Component
{
    public $products;
    public $sortFeature = 'cert_products.id';
    public $count;
    // public $sortOrder = 'desc';
    // public function mount() {
    //     $this->emit('publishSort' ,$this->sortFeature);
    // }
    public function mount(){
        $this->count = $this->products->count();
        // dd($this->products->count());
    }
    
    protected $listeners = ['productCountUpdate'];
    public function productCountUpdate($value) {
        $this->count = $value;
    }
    public function render()
    {
        return view('livewire.sort-bar',[
            'count' => $this->count,
        ]);
    }
}
