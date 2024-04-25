<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;

use App\Models\Color;  
use App\Models\Gender;
use App\Models\ConditionType;
use App\Models\BeltMaterial;  
use App\Models\BoxShape;
use App\Models\Calendar;
use App\Models\TypeReloj;
use App\Models\Invoice;
use App\Models\PaisProduct;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

use Illuminate\Support\Str;

class CreateProduct extends Component
{

    public $type_product_form=1;

    public $categories, $subcategories = [], $brands = [];
    public $production_countrys,$colors,$genders,$box_shapes,$belt_materials,$type_relojs,$calendars,$condition_types,$invoices;

    public $production_country="",$filter_color="",$gender="",$box_shape="",$belt_material="",$type_reloj="",$calendar="",$condition_type="",$invoice=""; 
    public $modelo,$main_material,$condition_type_note,$other_details_warranty,$package_height,$package_width,$package_length,$package_weight,$other_details_content;

    public $category_id = "", $subcategory_id = "", $brand_id = "";
    public $name, $slug, $description, $link_youtube, $price, $sub_price, $quantity;


    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        'link_youtube' => ' ',
        'brand_id' => 'required',
        'price' => 'required',

        'modelo'  => ' ',
        'production_country'=> ' ',
        'filter_color'  => 'required',
        'gender'  => ' ',
        'box_shape'  => ' ',
        'belt_material'  => ' ',
        'type_reloj' => ' ',
        'calendar' => ' ',
        'condition_type' => 'required',
        'invoice' => ' ',
        'main_material' => ' ',
        'condition_type_note'  => ' ',
        'other_details_warranty'  => ' ',
        'package_height'  => 'required',
        'package_width'  => 'required',
        'package_length'  => 'required',
        'package_weight'  => 'required',
        'other_details_content'  => ' ',
    ]; 

    public function updatedCategoryId($value){
       
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        // dd($this->subcategories);
        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();

        $this->reset(['subcategory_id', 'brand_id']);
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function getSubcategoryProperty(){
        return Subcategory::find($this->subcategory_id);
    }

    public function mount(){

        $this->categories = Category::all();

        $this->production_countrys = PaisProduct::all();
        $this->colors = Color::all();
        $this->genders = Gender::all();
        $this->box_shapes = BoxShape::all();
        $this->belt_materials = BeltMaterial::all();
        $this->type_relojs = TypeReloj::all();
        $this->calendars = Calendar::all();
        $this->condition_types = ConditionType::all();
        $this->invoices = Invoice::all();

    }


    public function save(){

        $rules = $this->rules;

        if ($this->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) {
                $rules['quantity'] = 'required';
            }
        }

        $this->validate($rules);

        $product = new Product();

        $product->name = $this->name;
        
        $product->slug = $this->slug;

        $product->description = $this->description;
        $product->link_youtube = $this->link_youtube;
        $product->price = $this->price;
        $product->sub_price = $this->sub_price;
        // $product->category_id = $this->category_id;
        $product->subcategory_id = $this->subcategory_id;
        $product->brand_id = $this->brand_id;
        if ($this->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) {
                $product->quantity = $this->quantity;
            }
        }
        $product->especification = json_encode([
            'modelo' => $this->modelo,
            'production_country' => $this->production_country,
            'filter_color' => $this->filter_color,
            'gender' => $this->gender,
            'box_shape' => $this->box_shape,
            'belt_material' => $this->belt_material,
            'type_reloj' => $this->type_reloj,
            'calendar' => $this->calendar,
            'condition_type' => $this->condition_type,
            'invoice' => $this->invoice,
            'main_material' => $this->main_material,
            'condition_type_note' => $this->condition_type_note,
            'other_details_warranty' => $this->other_details_warranty,
            'package_height' => $this->package_height,
            'package_width' => $this->package_width,
            'package_length' => $this->package_length,
            'package_weight' => $this->package_weight,
            'other_details_content' => $this->other_details_content
        ]);
       
        $product->save();

        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
