<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Department;
use Livewire\Component;

class ShowDepartment extends Component
{
    //CITY
    protected $listeners = ['delete'];

    public $department, $cities, $city;

    public $createForm = [
        'name' => '',
        // 'cost' => null,
        // 'days_received' => null,
        // 'days_late' => null
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        // 'cost' => null,
        // 'days_received' => null,
        // 'days_late' => null
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre'
        // 'createForm.cost' => 'costo',
        // 'createForm.days_received' => 'days_received',
        // 'createForm.days_late' => 'days_late'
    ];


    public function mount(Department $department){
        $this->department = $department;
        $this->getCities();
    }

    public function getCities(){
        $this->cities = City::where('department_id', $this->department->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
            // "createForm.cost" => 'required|numeric|min:1|max:100',
            // "createForm.days_received" => 'required|numeric|min:1|max:100',
            // "createForm.days_late" => 'required|numeric|min:1|max:100',
        ]);

        $this->department->cities()->create($this->createForm);


        $this->reset('createForm');

        $this->getCities();

        $this->emit('saved');
    }

    public function edit(City $city){
        $this->city = $city;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $city->name;
        // $this->editForm['cost'] = $city->cost;
        // $this->editForm['days_received'] = $city->days_received;
        // $this->editForm['days_late'] = $city->days_late;
    }

    public function update(){
        $this->city->name = $this->editForm['name'];
        // $this->city->cost = $this->editForm['cost'];
        // $this->city->days_received = $this->editForm['days_received'];
        // $this->city->days_late = $this->editForm['days_late'];
        $this->city->save();

        $this->reset('editForm');
        $this->getCities();
    }


    public function delete(City $city){
        $city->delete();
        $this->getCities();
    }


    public function render()
    {
        return view('livewire.admin.show-department')->layout('layouts.admin');
    }
}
