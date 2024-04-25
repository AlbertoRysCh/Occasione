<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function location(Request $request){
        $pais ="";
        $data = Location::all();
        // $departamento = '<option value="">Seleccione Departamento</option>';
        foreach($data as $row){
            $pais .= '<option value="'.$row->idDepa.'">'.$row->departamento.'</option>';
        }
        return $pais;
    }
}
