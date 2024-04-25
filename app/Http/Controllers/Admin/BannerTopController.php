<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BannerTop;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class BannerTopController extends Controller
{
    public function index(){
            //////Configuration 
        $bannertops = DB::table('bannertops')
        ->first();  
        // if($configs == null){
        //     dd($locations);
        // }
        return view('admin.bannertop.index',compact('bannertops'));  
    }

    public function save(Request $request){
        //////Configuration  
            $bannertops = DB::table('bannertops')
            ->first(); 

            if($bannertops == null){
                $request->validate([ 
                    'dim_height' => 'required',
                    'status' => 'required',
                    'logo_app' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                    'logo_web' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                ]);
            }

            // dd($request);

            $saved['link_banner'] =$request->link_banner; 
            $saved['dim_height'] =$request->dim_height; 

            if($bannertops == null){
                $saved['status'] =$request->status;   
             
                $imageName_web = 'bannerweb-'.time().'.'.$request->file('logo_web')->extension();  
                $imageName_app = 'banneeapp-'.time().'.'.$request->file('logo_app')->extension();  

                $request->file('logo_web')->move(public_path('storage/bannertops'), $imageName_web);
                $request->file('logo_app')->move(public_path('storage/bannertops'), $imageName_app);
            
                $url_web = 'bannertops/'.$imageName_web; 
                $url_app = 'bannertops/'.$imageName_app;

                $saved['banner_img_web'] =$url_web;   
                $saved['banner_img_app'] =$url_app;   
            }
            
            if($bannertops != null){
                DB::table('bannertops')
                ->where([['id', '=', $request->id],])
                ->update($saved);
            }else{
                DB::table('bannertops')->insert($saved); 
            }
            
            return redirect()->back();

        
    //   return view('admin.config.index',compact('configs','locations'));  
    }

    public function save_active(Request $request){
    $request->validate([ 
        'status' => 'required', 
    ]);

    $saved['status'] =$request->status;   

    DB::table('bannertops')
    ->where([['id', '=', $request->id],])
    ->update($saved);

    return redirect()->back();

    }


    public function save_img_web(Request $request){
    if($request->logo_web){ //logo
        $extension1 = $request->logo_web->extension();

        if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'svg'){

            $imageName = time().'.'.$request->file('logo_web')->extension();  

            $request->file('logo_web')->move(public_path('storage/bannertops'), $imageName);
        
            $uploadedFileUrl = 'bannertops/'.$imageName;

            // $uploadedFileUrl = Cloudinary::upload($request->file('logo')->getRealPath(),
            
            $saved['banner_img_web'] =$uploadedFileUrl;
        }else{ 
            return redirect()->back();
        }
    }   

    DB::table('bannertops')
    ->where([['id', '=', $request->id],])
    ->update($saved);

    return redirect()->back();

    }

    public function save_img_app(Request $request){
        if($request->logo_app){ //logo
            $extension1 = $request->logo_app->extension();
    
            if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'svg'){
    
                $imageName = time().'.'.$request->file('logo_app')->extension();  
    
                $request->file('logo_app')->move(public_path('storage/bannertops'), $imageName);
            
                $uploadedFileUrl = 'bannertops/'.$imageName;
    
                // $uploadedFileUrl = Cloudinary::upload($request->file('logo')->getRealPath(),
                
                $saved['banner_img_app'] =$uploadedFileUrl;
            }else{ 
                return redirect()->back();
            }
        }   
    
        DB::table('bannertops')
        ->where([['id', '=', $request->id],])
        ->update($saved);
    
        return redirect()->back();
    
        }
}
