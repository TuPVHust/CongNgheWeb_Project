<?php

namespace App\Http\Livewire;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Livewire\Component;

class SideSearch extends Component
{
    public $colorId = null;
    public $selectionCatid=null;
    public $pMin;
    public $pMax;
    public $minPrice;
    public $maxPrice;

    public function mount(){
        $this->pMin=intval(Product::min('sale') <= Product::min('price') ? Product::min('sale') : Product::min('price') );
        $this->pMax=intval(Product::max('sale'));
        $this->minPrice=$this->pMin;
        $this->maxPrice=$this->pMax;
        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice,$this->colorId);
    }
    
    public function updatePrice($minPrice, $maxPrice){
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice,$this->colorId);
    }

    public function selectCategory($catid){
        if ($this->selectionCatid==$catid){
            $this->selectionCatid=null;
        }else {
            $this->selectionCatid=$catid;
        }
        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice, $this->colorId);
    }
    public function selectColor($colorId){
        if ($this->colorId==$colorId){
            $this->colorId=null;
        }else {
            $this->colorId=$colorId;
        }
        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice,$this->colorId);
    }

    public function render()
    {
        $colors = Color::all()->take(6);
        $categories = Category::orderby('name','asc')->paginate(100);
        return view('livewire.side-search',[
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }
}
