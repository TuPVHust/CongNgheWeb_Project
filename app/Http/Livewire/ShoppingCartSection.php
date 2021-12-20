<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class ShoppingCartSection extends Component
{
    public function delete($rowId)
    {
        Cart::remove($rowId);
    }

    public function quantitychange($rowId, $value)
    {
        Cart::update($rowId, (int)$value);
    }

    public function quantityreduce($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty-1);
    }

    public function quantityincrease($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty+1);
    }

    protected $listeners = ['delete', 'quantitychange', 'quantityreduce','quantityincrease'];
    public function render()
    {
        $items=Cart::content();
        return view('livewire.shopping-cart-section',[
            'items' => $items,
        ]);
    }
}
