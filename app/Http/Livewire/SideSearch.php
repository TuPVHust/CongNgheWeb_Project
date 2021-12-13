<?php

namespace App\Http\Livewire;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;

class SideSearch extends Component
{
    public function render()
    {
        $colors = Color::orderby('id','asc')->paginate(6);
        $categories = Category::orderby('name','asc')->paginate(100);
        return view('livewire.side-search',[
            'categories' => $categories
        ]);
    }
}
