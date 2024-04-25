<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\District;
use App\Models\City;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CalculateDirection extends Component
{

    public $departments, $cities = [], $districts = [], $shipping_cost = 0, $shipping_cost_inter = 0;

    // public $days_received=10, $days_late=4;

    public $department_id = "", $city_id = "", $district_id = "", $id_district;

    public $city_name = "", $district_name = "";

    public $product;

    public $editForm = [
        // 'open' => false,
        'department_id' => null,
        'city_id' => null,
        'district_id' => null,
    ];

    // protected $validationAttributes = [ 
    //     'department_id' => 'department_id',
    //     'city_id' => 'city_id', 
    //     'district_id' => 'district_id'
    // ];

    public $rules = [
        // 'open' => false,
        'department_id' => 'required',
        'city_id' => 'required',
        'district_id' => 'required',
    ];

    // public function edit(){ 

    //     $this->resetValidation(); 

    //     // $this->editForm['open'] = true; 

    // }

    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id', $value)->get();

        // dd($this->cities);

        $this->emit('department_event');
        $this->reset(['city_id', 'district_id']);
    }

    // public function getCityIdProperty(){
    //     return  City::find($this->city_id);
    // }

    public function updatedCityId($value)
    {

        // $city = City::find($value);

        $this->districts = District::where('city_id', $value)->get();

        $this->emit('city_event');
        $this->reset('district_id');
    }

    public function updatedDistrictId($value)
    {
        $this->emit('district_event');
    }

    public function mount()
    {
        $this->departments = Department::all();
        //INTERNATIONAL
        // if ($this->product->type_product == 4 || $this->product->type_product == 3) {
        //     $this->days_received = 20;
        //     $this->days_late = 5;
        //     //LOCAL
        // } else {
        //     $this->days_received = 1;
        //     $this->days_late = 1;
        // }

        // dd($this->days_received);
        $this->getEnvioDefault();
    }

    public function getEnvioDefault()
    {
        $this->city_name =  DB::table('districts')->where([
            ['name', '=', 'lima'],
        ])->value('name');
        $this->district_name =  DB::table('districts')->where([
            ['name', '=', 'lima'],
        ])->value('name');
        $this->id_district =  DB::table('districts')->where([
            ['name', '=', 'Lima'],
        ])->value('id');

        if ($this->product->type_product == 4) { //INTERNATIONAL FREE
            if (District::find($this->id_district)->cost <= District::find($this->id_district)->cost_international) {
                //Precio Envio Internacional es mayor
                $this->shipping_cost = District::find($this->id_district)->cost_international;
            } else {
                //Precio Envio Internacional es menor
                $this->shipping_cost = District::find($this->id_district)->cost;
            }
        } else if ($this->product->type_product == 3) { //INTERNATIONAL
            if (District::find($this->id_district)->cost <= District::find($this->id_district)->cost_international) {
                //Precio Envio Internacional es mayor
                $this->shipping_cost = District::find($this->id_district)->cost_international;
            } else {
                //Precio Envio Internacional es menor
                $this->shipping_cost = District::find($this->id_district)->cost;
            }
        } else if ($this->product->type_product == 2) { //LOCAL FREE
            $this->shipping_cost = District::find($this->id_district)->cost;
        } else if ($this->product->type_product == 1) { //LOCAL
            $this->shipping_cost = District::find($this->id_district)->cost;
        }

        $this->days_received =  District::find($this->id_district)->days_received;
        $this->days_late =  District::find($this->id_district)->days_late;

        // dd($this->shipping_cost);
        //INTERNATIONAL
        if ($this->product->type_product == 4 || $this->product->type_product == 3) {
            $this->days_received = 20;
            $this->days_late = 5;
            //LOCAL
        } else {
            if ($this->days_received != null) {
                $this->days_received;
            } else {
                $this->days_received = "10";
            }

            if ($this->days_late != null) {
                $this->days_late;
            } else {
                $this->days_late = "4";
            }
        }
    }
    public function update()
    {

        if ($this->department_id != null && $this->city_id != null && $this->district_id != null) {
            $this->emit('update_event_ok');
        } else {
            $this->emit('update_event_error');
        }

        $rules = $this->rules;
        $this->validate($rules);

        if ($this->product->type_product == 4) { //INTERNATIONAL FREE
            if (District::find($this->district_id)->cost <= District::find($this->district_id)->cost_international) {
                //Precio Envio Internacional es mayor
                $this->shipping_cost = District::find($this->district_id)->cost_international;
            } else {
                //Precio Envio Internacional es menor
                $this->shipping_cost = District::find($this->district_id)->cost;
            }
        } else if ($this->product->type_product == 3) { //INTERNATIONAL
            if (District::find($this->district_id)->cost <= District::find($this->district_id)->cost_international) {
                //Precio Envio Internacional es mayor
                $this->shipping_cost = District::find($this->district_id)->cost_international;
            } else {
                //Precio Envio Internacional es menor
                $this->shipping_cost = District::find($this->district_id)->cost;
            }
        } else if ($this->product->type_product == 2) { //LOCAL FREE
            $this->shipping_cost = District::find($this->district_id)->cost;
        } else if ($this->product->type_product == 1) { //LOCAL
            $this->shipping_cost = District::find($this->district_id)->cost;
        }

        $this->days_received =  District::find($this->district_id)->days_received;
        $this->days_late =  District::find($this->district_id)->days_late;

        // dd($this->shipping_cost);

        if ($this->days_received != null) {
            $this->days_received;
        } else {
            $this->days_received = "10";
        }

        if ($this->days_late != null) {
            $this->days_late;
        } else {
            $this->days_late = "4";
        }

        $this->city_name = City::find($this->city_id)->name;

        if ($this->district_id != null) {
            $this->district_name = District::find($this->district_id)->name;
        }

        $this->reset(['editForm']);
    }

    public function render()
    {
        return view('livewire.calculate-direction');
    }
}
