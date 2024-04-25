<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class StatusBell extends Component
{
    
    public $product, $bell, $bells = [];
 

    public function mount(){
        $this->getBells();
        $this->bell = $this->product->bell;
    }
    public function getBells(){
        $this->bells = DB::table('bells')        
        ->get(); 
    }

    public function save(){
        $this->product->bell = $this->bell;
        $this->product->save();

        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.status-bell');
    }
}
