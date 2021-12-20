<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderSelect extends Component
{
    public $sortOrder = 'asc';
    public function render()
    {
        return view('livewire.order-select');
    }
}
