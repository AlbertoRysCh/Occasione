<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;

use App\Models\Order;

use App\Models\Department;
use App\Models\District;
use App\Models\City;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpdatePaymentOrder extends Component
{
    use AuthorizesRequests; 
    public $order,$open = false;
    
    public $type_price_env=0; //LOCAL

    public $c_local=0,$c_local_free=0,$c_inter=0,$c_inter_free=0, $days_received, $days_late;

    public $department_id,$city_id = "",$district_id  ="";
    public $contact, $phone, $shipping_cost = 0, $subtotal = 0, $total =0;

    public $address, $references, $address_type,$address_lot,$address_department,$address_urbanization,$cod_phone;
    
    public $departments, $cities = [], $districts = [];

    public function mount(Order $order){
        $this->order = $order; 
 
        $this->departments = Department::all();
 
    }
  
    public function updatedDepartmentId($value){
        $this->cities = [];
        $this->districts = [];

        $this->cities = City::where('department_id', $value)->get();
        $this->reset(['city_id', 'district_id']);
    }


    public function updatedCityId($value){

        $city = City::find($value); 

        $this->districts = District::where('city_id', $value)->get();
 
        $this->reset('district_id');
    }

    
    public function updatedDistrictId($value)
    {
        $itemps=json_decode($this->order->content);

        foreach($itemps as $product){ 

            $p_type_product =  DB::table('products')->where([
                ['id', '=', $product->id],
                ])->value('type_product');

            if($p_type_product == 4){ //INTERNATIONAL FREE
                $this->c_inter_free ++;
                // $this->type_price_env=4;  
            }
            else if($p_type_product == 3){ //INTERNATIONAL
                $this->c_inter ++;
                // $this->type_price_env=3;  
            }
            else if($p_type_product == 2){ //LOCAL FREE
                $this->c_local_free ++;
                // $this->type_price_env=2;  
            }
            else if($p_type_product == 1){ //LOCAL
                $this->c_local ++;
                // $this->type_price_env=1;  
            }
        }
      
        // dd($this->c_local_free);

        $district = District::find($value);

        //Verificaremos si cuenta tanto productos locales y intrnacionales free
        if( $this->c_inter_free >= 1 && $this->c_inter == 0 && $this->c_local == 0 && $this->c_local_free >= 1 )
        {
            $this->shipping_cost = 0;
        }
        //Verificaremos si cuenta almenos un producto internacional free
        else if( $this->c_inter_free >= 1 && $this->c_inter == 0 && $this->c_local == 0 && $this->c_local_free == 0 )
        {
            $this->shipping_cost = 0;
        }
        //Verificaremos si cuenta al menos un producto local free
        else if($this->c_inter == 0 && $this->c_inter_free == 0 && $this->c_local == 0 && $this->c_local_free == 1 )
        {
            $this->shipping_cost = 0;
        }
        //Verificaremos si el carrito tiene al menos un producto internacional tanto free o no
        else if(($this->c_inter + $this->c_inter_free) >= 1 && ($this->c_local + $this->c_local_free) >= 0)
        {
            if($district->cost <= $district->cost_international){
                //Precio Envio Internacional es mayor
                $this->shipping_cost = $district->cost_international;
            }else{
                //Precio Envio Internacional es menor
                $this->shipping_cost = $district->cost;
            }
        }
        //Verificaremos si en el carrito no tenga, ningun producto internacional para tomar el precio de envio del producto
        else if(($this->c_inter + $this->c_inter_free) == 0 && ($this->c_local + $this->c_local_free) >= 1)
        {
            $this->shipping_cost = $district->cost;
        }
  

        $this->days_received =  $district->days_received; 
        $this->days_late =  $district->days_late;
    }

    public function edit(Order $order){

        $this->open = true;

        $this->order = $order;
        //Datos Contact
        $this->contact = $this->order->contact;
        $this->phone = $this->order->phone;

        //Datos
        $this->department_id = DB::table('departments')->where([
            ['name', '=', (json_decode($this->order->envio)->department)],
            ])->value('id');  

        // $this->city_id =  DB::table('cities')
        // ->where([['name', '=', (json_decode($this->order->envio)->city)],['name', '=', (json_decode($this->order->envio)->department)],])
        // ->value('id');   

        $this->city_id = DB::table('cities') 
        ->leftJoin('departments', 'departments.id', '=', 'cities.department_id')
        ->where('cities.name', (json_decode($this->order->envio)->city))
        ->orWhere('departments.name', (json_decode($this->order->envio)->department))
        ->value('cities.id'); 

        // $this->district_id = DB::table('districts')
        // ->where([['name', '=', (json_decode($this->order->envio)->district)],
        // ['name', '=', (json_decode($this->order->envio)->city)],
        // ['name', '=', (json_decode($this->order->envio)->department)],])
        // ->value('id');  

        $this->district_id = DB::table('districts') 
          ->leftJoin('cities', 'cities.id', '=', 'districts.city_id')
          ->leftJoin('departments', 'departments.id', '=', 'cities.department_id')
          ->where('districts.name', (json_decode($this->order->envio)->district))
          ->orWhere('cities.name', (json_decode($this->order->envio)->city))
          ->orWhere('departments.name', (json_decode($this->order->envio)->department))
          ->value('districts.id'); 

        // dd($this->district_id);
         
        // {
        //     "city": "Chachapoyas",
        //     "address": "santa clara l",
        //     "district": "Chachapoyas",
        //     "days_late": "5",
        //     "department": "Amazonas",
        //     "references": null,
        //     "address_lot": "ed",
        //     "address_type": "Departamento",
        //     "days_received": "14",
        //     "address_department": "loca",
        //     "address_urbanization": null
        // }

        $this->cities = City::where('department_id',  $this->department_id)->get();
        $this->districts = District::where('city_id',  $this->city_id)->get();

        // $this->reset(['city_id', 'district_id']);

        $this->address_type = json_decode($this->order->envio)->address_type;
        $this->address = json_decode($this->order->envio)->address;
        $this->address_lot = json_decode($this->order->envio)->address_lot;
        $this->address_department = json_decode($this->order->envio)->address_department;
        $this->address_urbanization = json_decode($this->order->envio)->address_urbanization;
        $this->references = json_decode($this->order->envio)->references;
 
         $this->shipping_cost =  $this->order->shipping_cost;
         $this->total =  $this->order->total;
 
        foreach(json_decode($this->order->content) as $item){
            $this->subtotal = $this->subtotal + $item->subtotal;
        }
    }

    public function update(){

        // $this->validate([
        //     'pivot_color_id' => 'required',
        //     'pivot_quantity' => 'required',
        // ]);

        $this->order->contact = $this->contact;
        $this->order->phone = $this->phone;
        // dd($this->subtotal);

        $this->order->shipping_cost = $this->shipping_cost; 
        $this->order->total = $this->shipping_cost + (double)filter_var( $this->subtotal , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);     
        $this->order->envio = json_encode([
                'department' => Department::find($this->department_id)->name,
                'city' => City::find($this->city_id)->name,
                'district' => District::find($this->district_id)->name,
                'address' => $this->address,
                'references' => $this->references,
                'address_type' => $this->address_type,
                'address_lot' => $this->address_lot,
                'address_department' => $this->address_department,
                'address_urbanization' => $this->address_urbanization,
                'days_received' => $this->days_received,
                'days_late' => $this->days_late
            ]);
          
        $this->order->save();

        $this->order = $this->order->fresh();
 
        $this->reset('open');
        $this->emit('cart_up_order');
        
        // return redirect()->route('orders.payment', $this->order);
    }

    public function render()
    {
        $this->authorize('author', $this->order);
        $this->authorize('payment', $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);
    
        return view('livewire.update-payment-order', compact('items', 'envio'));
    }

}
