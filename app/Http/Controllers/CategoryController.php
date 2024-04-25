<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category){
        return view('categories.show', compact('category'));
    }

    //View Category_id 
    public function show_id($id_category){
        $category = DB::table('categories')
        ->where('slug',$id_category)
        ->get(); 

        return view('categories.show', compact('category'));
    }
}
