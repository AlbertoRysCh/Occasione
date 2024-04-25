<?php

namespace App\Http\Livewire;

use App\Models\Slider;
use Livewire\Component;

use Illuminate\Support\Facades\DB;

class ShowSlider extends Component
{
    public $slider;
    public $sliders = [];

      
    public function loadcPosts(){
        $this->sliders = DB::table('sliders')
        ->select(DB::raw('sliders.image as image'),DB::raw('sliders.description as description'),
        DB::raw('sliders.link as link'),DB::raw('sliders.link_name as link_name'),
        DB::raw('categories.slug as categories_slug'),DB::raw('products.slug as products_slug'))
        ->leftJoin('categories', 'categories.id', '=', 'sliders.link')
        ->leftJoin('products', 'products.id', '=', 'sliders.link_name')
        ->where('sliders.status',1)
        ->get();
        
        //dd($this->sliders); 

        $this->emit('gliderc');
    }

    
    public function render()
    {
        return view('livewire.show-slider');
    }
}
