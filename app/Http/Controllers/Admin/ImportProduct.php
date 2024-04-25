<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportProduct extends Controller
{
    public function index(){ 
      return view('admin.import_products.index');  
    }

    public function save(Request $request){ 

        $count = 0;
        $count_error = 0;
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
        
        $lines = file($request->file('file'));
        $utf8_lines = array_map('utf8_encode',$lines);
        $array = array_map('str_getcsv',$utf8_lines); 
        for($i=1; $i<sizeof($array); ++$i){ 
            // dd(explode('|', wordwrap(utf8_decode($array[$i][0]), 28, '|')));
            //  dd(DB::table('products')->where([['slug', '=',  Str::slug(utf8_decode($array[1][0])) ],])->value('slug'));
            if( ( DB::table('products')->where([['slug', '=',  Str::slug(utf8_decode($array[$i][0])) ],])->value('slug') ) == null){
                
                $bd_product = new Product();
                $bd_product->name = utf8_decode($array[$i][0]);
                $bd_product->slug = Str::slug(utf8_decode($array[$i][0]));
                $bd_product->description = utf8_decode($array[$i][1]);
                $bd_product->link_youtube = utf8_decode($array[$i][2]);
                $bd_product->sub_price = $array[$i][3];
                $bd_product->price = $array[$i][4];
                //  $bd_product->category_id = null;
                $bd_product->subcategory_id = DB::table('subcategories')->where([['name', '=', utf8_decode($array[$i][5])],])->value('id');
                $bd_product->brand_id = DB::table('brands')->where([['name', '=', utf8_decode($array[$i][6])],])->value('id');
                if($array[$i][7] == null){
                    $bd_product->bell_id = null;
                }else{
                    $bd_product->bell_id = $array[$i][7];
                }
                $bd_product->quantity = $array[$i][8];
                $bd_product->status = $array[$i][9];
                $bd_product->type_product = $array[$i][10];
                
                $bd_product->especification = json_encode([
                    'gender' => DB::table('genders')->where([['name', '=', utf8_decode($array[$i][11])],])->value('id'),
                    'modelo' => utf8_decode($array[$i][12]),
                    'invoice' =>  DB::table('invoices')->where([['name', '=', utf8_decode($array[$i][13])],])->value('id'),
                    'calendar' =>  DB::table('calendars')->where([['name', '=', utf8_decode($array[$i][14])],])->value('id'),
                    'box_shape' =>  DB::table('box_shapes')->where([['name', '=', utf8_decode($array[$i][15])],])->value('id'),
                    'type_reloj' =>  DB::table('type_relojs')->where([['name', '=', utf8_decode($array[$i][16])],])->value('id'),
                    'filter_color' =>  DB::table('colors')->where([['name', '=', utf8_decode($array[$i][17])],])->value('id'),
                    'belt_material' =>  DB::table('belt_materials')->where([['name', '=', utf8_decode($array[$i][18])],])->value('id'),
                    'main_material' => utf8_decode($array[$i][19]),
                    'package_width' => $array[$i][20],
                    'condition_type' =>  DB::table('condition_types')->where([['name', '=', utf8_decode($array[$i][21])],])->value('id'),
                    'package_height' => $array[$i][22],
                    'package_length' => $array[$i][23],
                    'package_weight' => $array[$i][24],
                    'production_country' => DB::table('belt_materials')->where([['name', '=', utf8_decode($array[$i][25])],])->value('id'),
                    'condition_type_note' => utf8_decode($array[$i][26]),
                    'other_details_content' => utf8_decode($array[$i][27]),
                    'other_details_warranty' => utf8_decode($array[$i][28]),
                ]); 

                $bd_product->save();

                $count ++;
            }else{
                $count_error ++;
            }
        }

            return back()->with('message','Se subio : '.$count.' products. Y hubo '.$count.' producto que no se subio.');
                // Excel::import(new ProductImport,$request->file);

                // dd($array);
             
    }
 
    public function update(Request $request){ 

        $count = 0;
        $count_error = 0;
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
        
        $lines = file($request->file('file'));
        $utf8_lines = array_map('utf8_encode',$lines);
        $array = array_map('str_getcsv',$utf8_lines); 
        for($i=1; $i<sizeof($array); ++$i){ 
            // dd(explode('|', wordwrap(utf8_decode($array[$i][0]), 28, '|')));
            //  dd(DB::table('products')->where([['slug', '=',  Str::slug(utf8_decode($array[1][0])) ],])->value('slug'));
                if( ( DB::table('products')->where([['slug', '=',  Str::slug(utf8_decode($array[$i][0])) ],])->value('slug') ) != null){
                    
                    $bd_productId = DB::table('products')->where([['slug', '=',  Str::slug(utf8_decode($array[$i][0])) ],])->value('id');
    
                    $updated['sub_price'] = $array[$i][1];
                    $updated['price'] = $array[$i][2];
                    
                    $updated['quantity'] = $array[$i][3];
                    $updated['status'] = $array[$i][4];
                    $updated['type_product'] = $array[$i][5];

                    DB::table('products')
                    ->where([['id', '=', $bd_productId],])
                    ->update($updated);

                    $count ++;
                }else{
                    $count_error ++;
                }
        }

            return back()->with('message_up','Se actualizo : '.$count.' products. Y hay '.$count_error.' error al actualizar');
                 
    }
}
