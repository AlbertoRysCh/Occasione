<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetaillProduct extends Component
{
    public $product;

    public function render()
    {  
        $especification = json_decode($this->product->especification);
 
        return view('livewire.detaill-product', compact('especification'));
    }
}
