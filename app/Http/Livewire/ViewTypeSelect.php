<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewTypeSelect extends Component
{
    public $viewForm = 'grid';
    protected $listeners = ['ChangeviewFormat'];
    public function ChangeviewFormat($value)
    {
        $this->viewForm = $value;
    }
    public function render()
    {
        return view('livewire.view-type-select');
    }
}
