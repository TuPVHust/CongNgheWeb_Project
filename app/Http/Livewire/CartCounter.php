<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use Cart;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::check()){
            $userId = Auth::user()->id;
            $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')->where('orders.user_id' ,'=', $userId)->where('orders.status', '=' , 1)->get();
            $orderCount = 0;
            foreach($orderDetails as $orderDetail)
            {
                $orderCount += $orderDetail->quantity;
            }
        }
        else{
            $orderDetails = null;
            $orderCount = null;
        }
        
        $count = Cart::count();
        $cost = Cart::total(0);
        return view('livewire.cart-counter',[
            'count' => $count,
            'cost' => $cost,
            'orderDetails' => $orderDetails,
            'orderCount' => $orderCount,
        ]);
    }
}
