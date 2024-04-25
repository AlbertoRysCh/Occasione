<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost', 'cost_international', 'days_received', 'days_late', 'city_id'];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public static function getDistrict(){
        // $records = DB::table('districts')
        // ->select('id','name', 'cost', 'cost_international', 'days_received', 'days_late')
        // ->get();

        $records = DB::table('districts')
        ->select(DB::raw('departments.id as idDepart'),DB::raw('departments.name as nameDepart'),
                DB::raw('cities.id as idCity'),DB::raw('cities.name as nameCity'),
                DB::raw('districts.id as idDist'),DB::raw('districts.name as nameDist'),
                DB::raw('districts.cost as costDist'),DB::raw('districts.cost_international as costInterDist'),
                DB::raw('districts.days_received as dayRDist'),DB::raw('districts.days_late as datLDist'))
        ->leftJoin('cities', 'cities.id', '=', 'districts.city_id')
        ->leftJoin('departments', 'departments.id', '=', 'cities.department_id')
        ->get();

        return $records;
    }
}
