<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Department;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\EmployeeExport;
use Excel;

class CreateUbigeoController extends Controller
{

    public function index(){
      $path = public_path('Librov1.csv');
      //   $content = utf8_encode(file_get_contents($path));
      //   echo str_getcsv($content);
      $lines = file($path);
      $utf8_lines = array_map('utf8_encode',$lines);
      $array = array_map('str_getcsv',$utf8_lines);
  
      for($i=1; $i<sizeof($array); ++$i){
        //TABLAS
          //    departments[0]
          //    cities[1]
          //    districts[2]
          //    cost[3]
          //    cost_international[4]
          //    days_received[5]
          //    days_late[6]
        //3 - districts. 
          
          $bd_district = new District();
          $bd_district->name = utf8_decode($array[$i][2]);
          $bd_district->cost = $array[$i][3];
          $bd_district->cost_international = $array[$i][4];
          $bd_district->days_received = $array[$i][5];
          $bd_district->days_late = $array[$i][6];
          $bd_district->city_id = $this->getCitiesId($array[$i][0],$array[$i][1]);
          $bd_district->save();
        //2 - cities
        //1 - departments
      }

      return view('admin.ubigeo.index');  
    }

    public function getCitiesId($departmentsName,$citiesName){
          //    departments[0]
          //    cities[1]
          $bd_cities = City::where('name',$citiesName)->first();
          if($bd_cities){
              return $bd_cities->id;
          }

          $bd_cities = new City();
          $bd_cities->name = utf8_decode($citiesName);
          $bd_departament = Department::firstOrCreate([
              'name' => utf8_decode($departmentsName)
          ]);
          $bd_cities->department_id = $bd_departament->id;
          $bd_cities->save();

          return $bd_cities->id;
    }

    public function exportIntoExcel(){
      return Excel::download(new EmployeeExport, 'district.xlsx');
    }
    public function exportIntoExcelCSV(){
      return Excel::download(new EmployeeExport, 'district.csv');
    }

    public function update(){
      return view('admin.ubigeo.update');  
    }

    
    public function update_district(Request $request){ 

      $count = 0;
      $count_error = 0;
      $request->validate([
          'file' => 'required|mimes:csv,txt',
      ]);
      
      $lines = file($request->file('file'));
      $utf8_lines = array_map('utf8_encode',$lines);
      $array = array_map('str_getcsv',$utf8_lines); 

          //    id[0]
          //    districts[1] 
          //    cost[2]
          //    cost_international[3]
          //    days_received[4]
          //    days_late[5]

      for($i=1; $i<sizeof($array); ++$i){ 
          // dd(explode('|', wordwrap(utf8_decode($array[$i][0]), 28, '|')));
          //  dd(DB::table('products')->where([['slug', '=',  Str::slug(utf8_decode($array[1][0])) ],])->value('slug'));
              if( ( DB::table('districts')->where([['id', '=', utf8_decode($array[$i][0]) ],])->value('id') ) == utf8_decode($array[$i][0])){
                  
                  $bd_districtId = DB::table('districts')->where([['id', '=', utf8_decode($array[$i][0]) ],])->value('id');
  
                  $updated['name'] = $array[$i][1];

                  $updated['cost'] = $array[$i][2];                  
                  $updated['cost_international'] = $array[$i][3];

                  $updated['days_received'] = $array[$i][4];
                  $updated['days_late'] = $array[$i][5];

                  DB::table('districts')
                  ->where([['id', '=', $bd_districtId],])
                  ->update($updated);

                  $count ++;
              }else{
                  $count_error ++;
              }
      }

          return back()->with('message_up','Se actualizo : '.$count.' distritos. Y hay '.$count_error.' error al actualizar');
               
  }
}
