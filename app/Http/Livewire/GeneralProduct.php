<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
use Livewire\WithPagination;
class GeneralProduct extends Component
{
    use WithPagination;
    public $sortFeature = 'cert_products.id';
    protected $listeners = ['changeSort' => 'changeSortFeature', 'publishSort'];
    public function mount() {
        $this->emit('publishSort' ,$this->sortFeature);
    }
    public function changeSortFeature($value) {
        $this->sortFeature = $value;
    }
    public function publishSort($value) {
        $this->sortFeature = $value;
    }
    public function render()
    {
        // $products = ProductDetail::orderby($this->sortFeature,'desc')->paginate(100);
        $products = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->orderBy($this->sortFeature, 'desc')->select('cert_products.*')->paginate(6);
        
        return view('livewire.general-product',[
            'products' => $products,
        ]);
    }
}
