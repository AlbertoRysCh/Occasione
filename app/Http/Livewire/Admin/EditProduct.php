<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use Livewire\Component;

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

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class EditProduct extends Component
{
    public $type_product_form=1;

    public $product, $categories, $subcategories, $brands, $slug, $sub_price, $link_youtube;
    
    public $production_countrys,$colors,$genders,$box_shapes,$belt_materials,$type_relojs,$calendars,$condition_types,$invoices;
    
    public $production_country,$filter_color,$gender,$box_shape,$belt_material,$type_reloj,$calendar,$condition_type,$invoice; 
    public $modelo,$main_material,$condition_type_note,$other_details_warranty,$package_height,$package_width,$package_length,$package_weight,$other_details_content;
 
    public $category_id;

    protected $rules = [
        'category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.name' => 'required',
        'slug' => 'required|unique:products,slug',
        'product.description' => 'required',
        'link_youtube' => ' ',
        'product.brand_id' => 'required',
        'product.price' => 'required', 
        'sub_price' => ' ',
        'product.quantity' => ' ',
        
        'production_country' => ' ',
        'filter_color'  => 'required',
        'gender'  => ' ',
        'box_shape'  => ' ',
        'belt_material'  => 'required',
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

    protected $listeners = ['refreshProduct', 'delete'];

    public function mount(Product $product){
        $this->product = $product;

        $this->categories = Category::all();

        $this->category_id = $product->subcategory->category->id;

        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();

        $this->slug = $this->product->slug; 
        $this->sub_price = $this->product->sub_price;
        $this->link_youtube = $this->product->link_youtube;
        
        $this->modelo=json_decode($this->product->especification)->modelo; 
        $this->main_material=json_decode($this->product->especification)->main_material;
        $this->condition_type_note=json_decode($this->product->especification)->condition_type_note;
        $this->other_details_warranty=json_decode($this->product->especification)->other_details_warranty;
        $this->package_height=json_decode($this->product->especification)->package_height;
        $this->package_width=json_decode($this->product->especification)->package_width;
        $this->package_length=json_decode($this->product->especification)->package_length;
        $this->package_weight=json_decode($this->product->especification)->package_weight;
        $this->other_details_content=json_decode($this->product->especification)->other_details_content;

        $this->production_country=json_decode($this->product->especification)->production_country;
        $this->filter_color=json_decode($this->product->especification)->filter_color;
        $this->gender=json_decode($this->product->especification)->gender;
        $this->box_shape=json_decode($this->product->especification)->box_shape;
        $this->belt_material=json_decode($this->product->especification)->belt_material;
        $this->type_reloj=json_decode($this->product->especification)->type_reloj;
        $this->calendar=json_decode($this->product->especification)->calendar;
        $this->condition_type=json_decode($this->product->especification)->condition_type;
        $this->invoice =json_decode($this->product->especification)->invoice;


        $this->brands = Brand::whereHas('categories', function(Builder $query){
            $query->where('category_id', $this->category_id);
        })->get();

        
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


    public function refreshProduct(){
        $this->product = $this->product->fresh();
    }

    public function updatedProductName($value){
        $this->slug = Str::slug($value);
    }

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){
            $query->where('category_id', $value);
        })->get();

        /* $this->reset(['subcategory_id', 'brand_id']); */
        $this->product->subcategory_id = "";
        $this->product->brand_id = "";
    }

    public function getSubcategoryProperty(){
        return Subcategory::find($this->product->subcategory_id);
    }

    public function save(){
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:products,slug,' . $this->product->id;

        if ($this->product->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) {
                $rules['product.quantity'] = 'required|numeric';
            }
        } 
        
        $this->validate($rules);

        $this->product->slug = $this->slug;
        
        if ($this->sub_price != null) { 
            $this->product->sub_price = $this->sub_price;
        }else{
            $this->product->sub_price = null;
        }
 
        if ($this->link_youtube != null) {
            $this->product->link_youtube = $this->link_youtube;
        }else{
            $this->product->link_youtube = null;
        }

        $this->product->especification = json_encode([
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

        // $this->product->category_id = $this->category_id;

        $this->product->save();

        $this->emit('saved');
    }

    public function deleteImage(Image $image){
        Storage::delete([$image->url]);
        $image->delete();

        $this->product = $this->product->fresh();
    }

    public function delete(){

        $images = $this->product->images;

        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }

        $this->product->delete();

        return redirect()->route('admin.index');

    }


    public function render()
    {
        
        $especifications = json_decode($this->product->especification);
 
        return view('livewire.admin.edit-product', compact('especifications'))->layout('layouts.admin');
    }
}
