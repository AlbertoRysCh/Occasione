<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

class ShowSubBanner extends Component
{

    public $subbanner;

    public $subbanners = [];

    public function loadSBanner(){ 
        // $this->subbanners = DB::table('subbanners')
        // ->where('status',1)
        // ->get();
        $this->subbanners = DB::table('subbanners')
        ->select(DB::raw('subbanners.image as image'),DB::raw('subbanners.description as description'),
        DB::raw('subbanners.link as link'),DB::raw('subbanners.link_name as link_name'),
        DB::raw('categories.slug as categories_slug'),DB::raw('products.slug as products_slug'))
        ->leftJoin('categories', 'categories.id', '=', 'subbanners.link')
        ->leftJoin('products', 'products.id', '=', 'subbanners.link_name')
        ->where('subbanners.status',1)
        ->get();

        $this->subbanner = DB::table('subbanners')->where([
            ['status', '=', '1'],
            ])->value('id');

        // dd($this->subbanner);
        $this->emit('glidersb',$this->subbanner);
    }
 
    public function render()
    {
        return view('livewire.show-sub-banner');
    }
}