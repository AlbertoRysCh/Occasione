<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownOrder extends Component
{
    protected $listeners = ['render'];
    public function render()
    {
        return view('livewire.dropdown-order');
    }
}
