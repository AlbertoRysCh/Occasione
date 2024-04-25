<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Department;
use App\Models\District;
use App\Models\City;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CreateOrder extends Component
{

    public $envio_local = 0;
    public $envio_type = 2;

    public $type_price_env = 0; //LOCAL

    public $c_local = 0, $c_local_free = 0, $c_inter = 0, $c_inter_free = 0;

    public $contact, $phone, $address, $references, $shipping_cost = 0;

    public $address_type, $address_lot, $address_department, $address_urbanization, $cod_phone;

    public $days_received, $days_late;

    public $departments, $cities = [], $districts = [];

    public $department_id = "", $city_id = "", $district_id = "";

    public $rules = [
        'contact' => 'required',
        'cod_phone' => ' ',
        'phone' => 'required',
        'envio_type' => 'required'
    ];

    public function mount()
    {
        $this->departments = Department::all();

        if (auth()->user()) {
            $this->contact = auth()->user()->name;
        }
    }

    public function updatedEnvioType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'department_id', 'city_id', 'district_id', 'address', 'references', 'address_type', 'address_lot', 'address_department', 'address_urbanization'
            ]);
        }
    }


    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id', $value)->get();

        $this->reset(['city_id', 'district_id']);
    }


    public function updatedCityId($value)
    {

        $city = City::find($value);

        // $this->shipping_cost = $city->cost;

        // $this->days_received = $city->days_received;
        // $this->days_late = $city->days_late;

        $this->districts = District::where('city_id', $value)->get();

        $this->reset('district_id');
    }

    public function updatedDistrictId($value)
    {
        $itemps = json_decode(Cart::content());

        foreach ($itemps as $product) {

            $p_type_product =  DB::table('products')->where([
                ['id', '=', $product->id],
            ])->value('type_product');

            if ($p_type_product == 4) { //INTERNATIONAL FREE
                $this->c_inter_free++;
                // $this->type_price_env=4;  
            } else if ($p_type_product == 3) { //INTERNATIONAL
                $this->c_inter++;
                // $this->type_price_env=3;  
            } else if ($p_type_product == 2) { //LOCAL FREE
                $this->c_local_free++;
                // $this->type_price_env=2;  
            } else if ($p_type_product == 1) { //LOCAL
                $this->c_local++;
                // $this->type_price_env=1;  
            }
        }

        // dd($this->c_local_free);

        $district = District::find($value);

        //Verificaremos si cuenta tanto productos locales y intrnacionales free
        if ($this->c_inter_free >= 1 && $this->c_inter == 0 && $this->c_local == 0 && $this->c_local_free >= 1) {
            $this->shipping_cost = 0;
        }
        //Verificaremos si cuenta almenos un producto internacional free
        else if ($this->c_inter_free >= 1 && $this->c_inter == 0 && $this->c_local == 0 && $this->c_local_free == 0) {
            $this->shipping_cost = 0;
        }
        //Verificaremos si cuenta al menos un producto local free
        else if ($this->c_inter == 0 && $this->c_inter_free == 0 && $this->c_local == 0 && $this->c_local_free == 1) {
            $this->shipping_cost = 0;
        }
        //Verificaremos si el carrito tiene al menos un producto internacional tanto free o no
        else if (($this->c_inter + $this->c_inter_free) >= 1 && ($this->c_local + $this->c_local_free) >= 0) {
            if ($district->cost <= $district->cost_international) {
                //Precio Envio Internacional es mayor
                $this->shipping_cost = $district->cost_international;
            } else {
                //Precio Envio Internacional es menor
                $this->shipping_cost = $district->cost;
            }
        }
        //Verificaremos si en el carrito no tenga, ningun producto internacional para tomar el precio de envio del producto
        else if (($this->c_inter + $this->c_inter_free) == 0 && ($this->c_local + $this->c_local_free) >= 1) {
            $this->shipping_cost = $district->cost;
        }


        $this->days_received =  $district->days_received;
        $this->days_late =  $district->days_late;
    }

    public function create_order()
    {

        $rules = $this->rules;

        if ($this->envio_type == 2) {
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = ' ';
            $rules['address_type'] = 'required';
            $rules['address_lot'] = 'required';
            $rules['address_department'] = ' ';
            $rules['address_urbanization'] = ' ';
        }

        $this->validate($rules);

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = "51" . $this->phone;
        $order->envio_type = $this->envio_type;
        // $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + (float)filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            $order->shipping_cost = $this->shipping_cost;
            // $order->shipping_cost = District::find($this->district_id)->cost;
            /* $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->references = $this->references; */
            $order->envio = json_encode([
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
        }

        $order->save();

        // dd(Cart::content());
        // foreach (Cart::content() as $item) {
        //     discount($item);
        // }

        Cart::destroy();

        return redirect()->route('orders.payment', $order);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
