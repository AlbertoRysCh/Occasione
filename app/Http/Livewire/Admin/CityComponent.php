<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\District;
use Livewire\Component;

class CityComponent extends Component
{
    //DISTRICT

    protected $listeners = ['delete'];

    public $city, $districts, $district;

    public $createForm = [
        'name' => '',
        'cost' => null,
        'cost_international' => null,
        'days_received' => null,
        'days_late' => null
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'cost' => null,
        'cost_international' => null,
        'days_received' => null,
        'days_late' => null
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.cost' => 'costo',
        'createForm.cost_international' => 'cost_international',
        'createForm.days_received' => 'days_received',
        'createForm.days_late' => 'days_late'
    ];

    public function mount(City $city){
        $this->city = $city;
        $this->getDistricts();
    }

    public function getDistricts(){
        $this->districts = District::where('city_id', $this->city->id)->get();
    }

    public function save(){
 
        $this->validate([
            "createForm.name" => 'required',
            "createForm.cost" => 'required|numeric|min:1|max:100',
            "createForm.cost_international" => 'required|numeric|min:1|max:100',
            "createForm.days_received" => 'required|numeric|min:1|max:100',
            "createForm.days_late" => 'required|numeric|min:1|max:100',
        ]);

        $this->city->districts()->create($this->createForm);

        $this->reset('createForm');

        $this->getDistricts();

        $this->emit('saved');
    }

    public function edit(District $district){
        $this->district = $district;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $district->name;
        $this->editForm['cost'] = $district->cost;
        $this->editForm['cost_international'] = $district->cost_international;
        $this->editForm['days_received'] = $district->days_received;
        $this->editForm['days_late'] = $district->days_late;
    }

    public function update(){ 
        $this->district->name = $this->editForm['name'];
        $this->district->cost = $this->editForm['cost'];
        $this->district->cost_international = $this->editForm['cost_international'];
        $this->district->days_received = $this->editForm['days_received'];
        $this->district->days_late = $this->editForm['days_late'];
        $this->district->save();

        $this->reset('editForm');
        $this->getDistricts();
    }

    public function delete(District $district){
        $district->delete();
        $this->getDistricts();
    }


    public function render()
    {
        return view('livewire.admin.city-component')->layout('layouts.admin');
    }
}
