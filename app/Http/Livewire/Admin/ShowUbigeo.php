<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class ShowUbigeo extends Component
{
    use WithPagination;

    public $search,$department,$city,$district;

    public $editForm = [
        'open' => false,
        'nameDep' => null,
        'nameCity' => null,
        'nameDist' => null,
        'cost' => null,
        'costInternational' => null,
        'daysReceive' => null,
        'daysLate' => null,
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function edit(Department $department, City $city, District $district){
 
        // $this->resetValidation();

        $this->department = $department;
        $this->city = $city;
        $this->district = $district;

        $this->editForm['open'] = true;
        $this->editForm['nameDep'] = $department->name;
        $this->editForm['nameCity'] = $city->name;
        $this->editForm['nameDist'] = $district->name;
        $this->editForm['cost'] = $district->cost;
        $this->editForm['costInternational'] = $district->cost_international;
        $this->editForm['daysReceive'] = $district->days_received;
        $this->editForm['daysLate'] = $district->days_late;
    }
    
    public function update(){

        $this->department->name = $this->editForm['nameDep'];
        $this->department->save();

        $this->city->name = $this->editForm['nameCity'];
        $this->city->save();

        $this->district->name = $this->editForm['nameDist'];
        $this->district->cost = $this->editForm['cost'];
        $this->district->cost_international = $this->editForm['costInternational'];
        $this->district->days_received = $this->editForm['daysReceive'];
        $this->district->days_late = $this->editForm['daysLate'];
        $this->district->save();

        $this->reset('editForm'); 
    }


    public function render()
    {
        
        $ubigeos = DB::table('departments')
          ->select(DB::raw('departments.id as idDep'),DB::raw('departments.name as nameDep'),
          DB::raw('cities.id as idCity'),DB::raw('cities.name as nameCity'),
          DB::raw('districts.id as idDist'),DB::raw('districts.name as nameDist'),
          DB::raw('districts.cost as dCost'),DB::raw('districts.cost_international as dCostI'),
          DB::raw('districts.days_received as dDayR'),DB::raw('districts.days_late as dDayL'))
          ->leftJoin('cities', 'cities.department_id', '=', 'departments.id')
          ->leftJoin('districts', 'districts.city_id', '=', 'cities.id')
          ->where('departments.name', 'like', '%' . $this->search . '%')
          ->orWhere('cities.name', 'like', '%' . $this->search . '%')
          ->orWhere('districts.name', 'like', '%' . $this->search . '%')
          ->orderBy('departments.name','ASC')
          ->paginate(50);

        return view('livewire.admin.show-ubigeo', compact('ubigeos'))->layout('layouts.admin');
    }
}
