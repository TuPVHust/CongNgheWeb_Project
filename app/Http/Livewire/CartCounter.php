<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class CartCounter extends Component
{
    public function delete($rowId)
    {
        $this->emitself('refresh_me');
    }

    public function quantitychange($rowId, $value)
    {
        // Cart::update($rowId, (int)$value);
        $this->emitself('refresh_me');
    }

    public function quantityreduce($rowId)
    {
        // Cart::update($rowId, Cart::get($rowId)->qty-1);
        $this->emitself('refresh_me');
    }

    public function quantityincrease($rowId)
    {
        // Cart::update($rowId, Cart::get($rowId)->qty+1);
        $this->emitself('refresh_me');
    }

    protected $listeners = ['delete', 'quantitychange', 'quantityreduce','quantityincrease','refresh_me' => '$refresh'];
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
