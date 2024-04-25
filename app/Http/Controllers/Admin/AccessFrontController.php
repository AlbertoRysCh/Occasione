<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AccessFrontController extends Controller
{
    public function index(){
        //////Access 
      $access_fronts = DB::table('access_fronts')
      ->first(); 
      
      return view('admin.accessfront.index',compact('access_fronts'));  
  }

  public function save(Request $request){
  //////Configuration  
  $access_fronts = DB::table('access_fronts')
  ->first();  

  if($access_fronts == null){
      $request->validate([
          'color_fondo_access' => 'required', 
          'color_card_access' => 'required', 
          'color_card_line_access' => 'required', 
          'color_card_hover_access' => 'required', 
          'color_card_border_access'  => 'required', 
          'color_card_text_access' => 'required',
          'color_card_text_hover_access' => 'required',
          'color_card_enlace_access' => 'required', 
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
      ]);
  }

  
  // dd($request);

  $saved['color_fondo_access'] =$request->color_fondo_access; 
  $saved['color_card_access'] =$request->color_card_access; 
  $saved['color_card_line_access'] =$request->color_card_line_access; 
  $saved['color_card_hover_access'] =$request->color_card_hover_access; 
  $saved['color_card_border_access'] =$request->color_card_border_access; 
  $saved['color_card_text_access'] =$request->color_card_text_access; 
  $saved['color_card_text_hover_access'] =$request->color_card_text_hover_access; 
  $saved['color_card_enlace_access'] =$request->color_card_enlace_access; 
  
  if($request->image){ //logo
      $extension1 = $request->image->extension();

      if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'svg'){

          $imageName = time().'.'.$request->file('image')->extension();  

          $request->file('image')->move(public_path('storage/access_fronts'), $imageName);
      
          $uploadedFileUrl = 'access_fronts/'.$imageName; 
          $saved['image'] =$uploadedFileUrl;
      }else{ 
          return redirect()->back();
      }
  } 
 

  if($access_fronts != null){
      DB::table('access_fronts')
      ->where([['id', '=', $request->id],])
      ->update($saved);
  }else{
      DB::table('access_fronts')->insert($saved);
  }
  
  return redirect()->back();
  }
}
