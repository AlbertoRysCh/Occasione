<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;

class CreateColor extends Component
{
    public $colors, $color;

    protected $listeners = ['delete'];

    public $createForm=[
        'name' => null
    ];

    public $editForm=[
        'open' => false,
        'name' => null
    ];

    public $rules = [
        'createForm.name' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre'
    ];

    public function mount(){
        $this->getColors();
    }

    public function getColors(){
        $this->colors = Color::all();
    }

    public function save(){
        $this->validate();

        Color::create($this->createForm);

        $this->reset('createForm');

        $this->getColors();
    }

    public function edit(Color $color){
        $this->color = $color;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $color->name;
    }

    public function update(){
        $this->validate([
            'editForm.name' => 'required'
        ]);

        $this->color->update($this->editForm);
        $this->reset('editForm');

        $this->getColors();
    }

    public function delete(Color $color){
        $color->delete();
        $this->getColors();
    }
 
    public function render()
    {
        return view('livewire.admin.create-color')->layout('layouts.admin');
    }
}
