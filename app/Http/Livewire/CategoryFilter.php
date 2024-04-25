<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\Product;
use App\Models\Color;
use App\Models\BeltMaterial;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    
    use WithPagination;

    public $category, $subcategoria, $marca, $color, $correa, $envio, $shipping_id = "";
    public $colors, $straps, $shippings;
    public $productosQuery = [];

    public $view = "grid";


    protected $queryString = ['envio', 'subcategoria', 'marca', 'color', 'correa'];

    public function limpiar()
    {
        $this->reset(['envio', 'subcategoria', 'marca', 'color', 'correa', 'page']);
    }


    public function updatedSubcategoria()
    {
        $this->resetPage();
    }

    public function updatedMarca()
    {
        $this->resetPage();
    }
    public function updatedEnvio()
    {
        $this->resetPage();
    }

    /*public function updatedColor()
    {
        // $this->resetPage();

        $this->reset(['correa', 'page']);
    }

    public function updatedCorrea()
    {
        // $this->resetPage();

        $this->reset(['color', 'page']);
    }*/
    public function updatedColor($value)
    {
        $this->color = $value;
        $this->resetPage();
    }

    public function updatedCorrea($value)
    {
        $this->correa = $value;
        $this->resetPage();
    }

    public function getDataFilter()
    {

        // $this->colors = Color::all();

        $this->colors = DB::table('colors')
            ->select(
                DB::raw('colors.name as c_name'),
                DB::raw('COUNT(colors.name) as cc_name'),
                DB::raw('colors.id as c_id')
            )
            ->leftJoin('products', 'products.especification->filter_color', '=', 'colors.id')
            ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->leftJoin('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('categories.id', $this->category->id)
            ->where(function ($query) {
                $query->where('products.status', 2)
                    ->orWhere('products.status', 3)
                    ->orWhere('products.status', 4);
            })
            ->groupBy('colors.id','colors.name')
            ->orderBy('cc_name', 'desc')
            ->get();

        $this->shippings = DB::table('products')
            ->select(
                DB::raw('products.type_product as p_tp'),
                DB::raw('COUNT(products.type_product) as cp_tp')
            )
            ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->leftJoin('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('categories.id', $this->category->id)
            ->where(function ($query) {
                $query->where('products.status', 2)
                    ->orWhere('products.status', 3)
                    ->orWhere('products.status', 4);
            })
            ->groupBy('products.type_product')
            ->orderBy('cp_tp', 'desc')
            ->get();

        // dd($this->shippings);

        //     $this->colors=  DB::table('teams')
        // ->select(DB::raw('id, name, (SELECT COUNT(id_team_local) FROM seasons WHERE id_team_local = teams.id) AS 'Partidos jugados''))
        // ->get();

        // $this->colors = DB::table('colors')
        // ->select(DB::raw('colors.name as c_name'))
        // ->leftJoin('products',DB::raw("json_extract(products.especification, '$.filter_color')"),"=","colors.id")
        // ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
        // ->leftJoin('categories', 'categories.id', '=', 'subcategories.category_id')
        // ->where('categories.id',$this->category->id)
        // ->orderBy('c_name')
        // ->get();

        // dd($this->colors);
        $this->straps = DB::table('belt_materials')
            ->select(
                DB::raw('belt_materials.name as bm_name'),
                DB::raw('COUNT(belt_materials.name) as cbm_name'),
                DB::raw('belt_materials.id as bm_id')
            )
            ->leftJoin('products', 'products.especification->belt_material', '=', 'belt_materials.id')
            ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->leftJoin('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('categories.id', $this->category->id)
            ->where(function ($query) {
                $query->where('products.status', 2)
                    ->orWhere('products.status', 3)
                    ->orWhere('products.status', 4);
            })
            ->groupBy('belt_materials.id','belt_materials.name')
            ->orderBy('bm_name', 'desc')
            ->get();
        // $this->straps = BeltMaterial::all();

    }

    public function render()
    {

        /* $products = $this->category->products()
                            ->where('status', 2)->paginate(20); */
        //Corregimos si el producto esta en el estado publico

        // $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
        //     $query->where('id', $this->category->id)->where('status', 2);
        // });
        // $this->limpiar();
        $productsQuery = Product::query()->whereHas('subcategory.category', function (Builder $query) {
            $query->where('id', $this->category->id)
                ->where(function ($query) {
                    $query->where('status', 2)
                        ->orWhere('status', 3)
                        ->orWhere('status', 4);
                });
        });

        if ($this->subcategoria) {
            $productsQuery = $productsQuery->whereHas('subcategory', function (Builder $query) {
                $query->where('slug', $this->subcategoria);
            });
        }

        if ($this->marca) {
            $productsQuery = $productsQuery->whereHas('brand', function (Builder $query) {
                $query->where('name', $this->marca);
            });
            // dd($productsQuery->paginate(20));
        }

        if ($this->color) {
            // $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            //     $query->where('id', $this->category->id)
            //             ->where(function($query) {
            //                 $query->where('status', 2)
            //                     ->orWhere('status', 3)
            //                     ->where('especification->filter_color', $this->color);
            //             });         
            // }); 
            // $productsQuery = $productsQuery->where(function($query){
            //     $query->whereJsonContains('especification->filter_color', $this->color);
            // });
            // dd($this->color);
            // dd($productsQuery->paginate(20));
            $productsQuery = $productsQuery->where('especification->filter_color', $this->color);
            // $productsQuery = $productsQuery->whereJsonContains('especification->filter_color', $this->color);
        }

        if ($this->correa) {
            // $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            //     $query->where('id', $this->category->id)
            //     ->where(function($query) {
            //         $query->where('status', 2)
            //               ->orWhere('status', 3);
            //     })->whereJsonContains('especification->belt_material', $this->correa);
            // });

            // $productsQuery = $productsQuery->where(function($query){
            //     $query->whereJsonContains('especification->belt_material', $this->correa);
            // });

            $productsQuery = $productsQuery->where('especification->belt_material', $this->correa);
            // $productsQuery = $productsQuery->whereJsonContains('especification->belt_material', $this->correa);
        }
        if ($this->envio) {
            $productsQuery = $productsQuery->where('type_product', $this->envio);
        }

        // $products = $productsQuery->orderBy('status', 'desc')->paginate(20);        
        $products = $productsQuery->orderBy('type_product', 'asc')->paginate(20);

        $links = $products->links();
        // $colorsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
        //     $query->where('id', $this->category->id)
        //     ->where(function($query) {
        //         $query->where('status', 2)
        //               ->orWhere('status', 3);
        //     });
        // });
        // $products->withQueryString()->fullUrl();
        $this->getDataFilter();

        return view('livewire.category-filter', compact('products'));
    }
}
