<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Category;
use App\Models\Location;

class Navigation extends Component
{
    public function render()
    {

        $categories = Category::all();
        
        $locations = Location::all();

        return view('livewire.navigation', compact('categories','locations'));
    }
}
