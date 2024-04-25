<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

class StatusBell extends Component
{
    
    
    public $product, $bell, $bells = [];
 

    public function mount(){
        $this->getBells();
        $this->bell = $this->product->bell_id;
    }
    public function getBells(){
        $this->bells = DB::table('bells')->get(); 
    }

    public function save(){
        if($this->bell != null){
            $this->product->bell_id = $this->bell;
        }else{
            
        $this->product->bell_id = null;
        }
        $this->product->save();

        $this->emit('saved');
        $this->getBells();
    }

    public function render()
    {
        return view('livewire.admin.status-bell');
    }
}
