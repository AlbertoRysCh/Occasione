<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReviewController extends Controller
{
    public function index(){
        return view('admin.review.index');
    }

    public function save(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(),[
            'rating'=>'required'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                 'rating'=>$request->rating,
                 'comment'=>$request->content,
                 'user_id'=>$request->user_id,
                 'product_id'=>$request->product_id,
                 'status'=>'0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $query = DB::table('reviews')->insert($values);
            if( $query ){
                return redirect()->back();
            }
        }

    }
}
