<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class CartCounter extends Component
{
    // public function delete($rowId)
    // {
    //     // Cart::update($rowId, Cart::get($rowId)->qtys);
    // }

    // public function quantitychange($rowId, $value)
    // {
    //     Cart::update($rowId, (int)$value);
    // }

    // public function quantityreduce($rowId)
    // {
    //     Cart::update($rowId, Cart::get($rowId)->qty-1);
    // }

    // public function quantityincrease($rowId)
    // {
    //     Cart::update($rowId, Cart::get($rowId)->qty+1);
    // }

    // protected $listeners = ['delete', 'quantitychange', 'quantityreduce','quantityincrease'];
    public function render()
    {
        $count = Cart::count();
        $cost = Cart::total(0);
        return view('livewire.cart-counter',[
            'count' => $count,
            'cost' => $cost,
        ]);
    }
}
