<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Config; 
use App\Models\Location; 

use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function index(){
          //////Configuration 
        $configs = DB::table('configs')
        ->first(); 
        $configs_footer = DB::table('footers')
        ->first(); 
        $locations = Location::all();
        // if($configs == null){
        //     dd($locations);
        // }
        return view('admin.config.index',compact('configs','configs_footer','locations'));  
    }

    public function save(Request $request){
        //////Configuration  
            $configs = DB::table('configs')
            ->first(); 

            if($configs == null){
                $request->validate([
                    'name' => 'required', 
                    'cr' => 'required', 
                    'location' => 'required', 
                    'correo' => 'required', 
                    'telefono' => 'required',
                    'color_texto_menu' => 'required', 
                    'color_fondo_menu' => 'required', 
                    'location_id' => 'required',
                    'status' => 'required',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                    'tam_img'=>'required',
                    'color_footer' => '', 
                    'color_icons_footer' => '', 
                    'color_texto_footer' => '', 
                    'color_subtexto_footer' => '', 
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                ]);
            }

            
            // dd($request);

            $saved['nombre_empresa'] =$request->name;
            $saved['cr'] = $request->cr;
            $saved['ubicacion'] =$request->location;
            $saved['correo'] =$request->correo;
            $saved['telefono'] =$request->telefono;
            $saved['link_whatsapp'] =$request->url_whats;
            $saved['link_telegram'] =$request->url_telg;
            $saved['facebook'] =$request->url_facebook;
            $saved['tiktok'] =$request->url_tiktok;
            $saved['instagram'] =$request->url_instagram;
            $saved['color_texto_menu'] =$request->color_texto_menu;
            $saved['color_fondo_menu'] =$request->color_fondo_menu;
            
            $saved['location_id'] =$request->location_id;
            $saved['tam_img'] =$request->tam_img;
 
            $save_f['color_icons_footer'] =$request->color_icons_footer;
            $save_f['color_footer'] =$request->color_footer;
            $save_f['color_texto_footer'] = $request->color_texto_footer;
            $save_f['color_subtexto_footer'] =$request->color_subtexto_footer; 

            if($configs == null){
                $saved['status'] =$request->status;   
            }

            if($request->logo){ //logo
                $extension1 = $request->logo->extension();

                if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'svg'){

                    $imageName = time().'.'.$request->file('logo')->extension();  

                    $request->file('logo')->move(public_path('storage/logos'), $imageName);
                
                    $uploadedFileUrl = 'logos/'.$imageName; 
                    $saved['logo'] =$uploadedFileUrl;
                }else{ 
                    return redirect()->back();
                }
            } 

            if($request->image){ //image footer
                $extensionf = $request->image->extension();
    
                if($extensionf == 'png' || $extensionf == 'jpeg' || $extensionf == 'jpg' || $extensionf == 'svg'){
    
                    $imageName = time().'.'.$request->file('image')->extension();  
    
                    $request->file('image')->move(public_path('storage/footers'), $imageName);
                
                    $uploadedFileUrl = 'footers/'.$imageName;
     
                    $save_f['image'] =$uploadedFileUrl;
                }else{ 
                    return redirect()->back();
                }
            }  

            if($configs != null){
                DB::table('configs')
                ->where([['id', '=', $request->id],])
                ->update($saved);
            }else{
                DB::table('configs')->insert($saved); 
                DB::table('footers')->insert($save_f); 
            }
            
            return redirect()->back();

         
    //   return view('admin.config.index',compact('configs','locations'));  
  }

  public function save_footer(Request $request){
    //////Configuration  
        $configs_footer = DB::table('footers')
        ->first(); 

        if($configs_footer == null){
            $request->validate([
                'color_footer' => 'required', 
                'color_texto_footer' => 'required', 
                'color_subtexto_footer' => 'required',
                'color_icons_footer' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            ]);
        }

        
        // dd($request);

        $saved['color_footer'] =$request->color_footer;
        $saved['color_texto_footer'] = $request->color_texto_footer;
        $saved['color_subtexto_footer'] =$request->color_subtexto_footer; 
        $saved['color_icons_footer'] =$request->color_icons_footer; 
 
        if($request->image){ //logo
            $extension1 = $request->image->extension();

            if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'svg'){

                $imageName = time().'.'.$request->file('image')->extension();  

                $request->file('image')->move(public_path('storage/footers'), $imageName);
            
                $uploadedFileUrl = 'footers/'.$imageName;
 
                $saved['image'] =$uploadedFileUrl;
            }else{ 
                return redirect()->back();
            }
        }  
            DB::table('footers')
            ->where([['id', '=', $request->id],])
            ->update($saved);
        
        
        return redirect()->back();
 
}

  public function save_active(Request $request){
    $request->validate([ 
        'status' => 'required', 
    ]);

    $saved['status'] =$request->status;   

    DB::table('configs')
    ->where([['id', '=', $request->id],])
    ->update($saved);

    return redirect()->back();

  }

  
  public function save_img(Request $request){
    if($request->logo){ //logo
        $extension1 = $request->logo->extension();

        if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'svg'){

            $imageName = time().'.'.$request->file('logo')->extension();  

            $request->file('logo')->move(public_path('storage/logos'), $imageName);
        
            $uploadedFileUrl = 'logos/'.$imageName;

            // $uploadedFileUrl = Cloudinary::upload($request->file('logo')->getRealPath(),
          
            $saved['logo'] =$uploadedFileUrl; 
        }else{ 
            return redirect()->back();
        }
    }   
    $saved['tam_img'] =$request->tam_img;

    DB::table('configs')
    ->where([['id', '=', $request->id],])
    ->update($saved);

    return redirect()->back();

  }
}
