<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CategoryProducts extends Component
{

    public $category,$category_id;

    public $products = [];

    public function loadPosts(){ 

        // $this->products = $this->category->products()
        // ->where('status', 2)->orWhere('status', 3)
        // ->take(15)->get();
        $this->products = $this->category->products()
        ->where(function($query) {
            $query->where('status', 2)
                  ->orWhere('status', 3)
                  ->orWhere('status', 4);
        })->take(15)->get();
        // $this->products  = Product::where('status', 2)->get();
        // dd($this->products);
         
        $this->emit('glider', $this->category->id);
    }

    public function render()
    {
        return view('livewire.category-products');
    }
}
