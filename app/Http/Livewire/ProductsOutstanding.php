<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsOutstanding extends Component
{
    
    public $category,$category_id;

    public $products = [];

    public function loadOuts(){ 

        // $this->products = $this->category->products()->where('status', 2)->take(15)->get();
        $this->products  = Product::where('status', 3)->take(15)->get();
        // $this->category_id = $this->products->id;
        // dd( $this->category_id );
         
        $this->emit('gliderout');
    }
 
    public function render()
    {
        return view('livewire.products-outstanding');
    }
}
