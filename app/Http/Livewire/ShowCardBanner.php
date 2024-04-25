<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

class ShowCardBanner extends Component
{
    
    public $card_banners = [];

    public function loadCBanner(){ 
        $this->card_banners = DB::table('card_banners')
        ->select(DB::raw('card_banners.image as image'),DB::raw('card_banners.s_image as s_image'),
        DB::raw('card_banners.tipo_card as tipo_card'),DB::raw('card_banners.description as description'),DB::raw('card_banners.s_description as s_description'),
        DB::raw('card_banners.link as link'),DB::raw('card_banners.link_name as link_name'), DB::raw('card_banners.s_link as s_link'),DB::raw('card_banners.s_link_name as s_link_name'),
        DB::raw('pc.slug as categories_slug'),DB::raw('pp.slug as products_slug'), DB::raw('sc.slug as s_categories_slug'),DB::raw('sp.slug as s_products_slug'))
        ->leftJoin('categories as pc', 'pc.id', '=', 'card_banners.link')
        ->leftJoin('products as pp', 'pp.id', '=', 'card_banners.link_name')
        ->leftJoin('categories as sc', 'sc.id', '=', 'card_banners.s_link')
        ->leftJoin('products as sp', 'sp.id', '=', 'card_banners.s_link_name')
        ->where('card_banners.status',1)
        ->get();

        $this->emit($this->card_banners);
    }
    
    public function render()
    {
        return view('livewire.show-card-banner');
    }
}
