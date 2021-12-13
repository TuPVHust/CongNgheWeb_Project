<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Hero extends Component
{
    public $thisRoute;
    
    public function render()
    {
        $categories = Category::orderby('name','asc')->paginate(100);
        return view('livewire.hero',[
            'categories' => $categories
        ]);
    }
}
