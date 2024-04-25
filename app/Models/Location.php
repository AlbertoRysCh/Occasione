<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'url_dom', 'img','money', 'status'];
       //Relacion uno a muchos
       public function userlocation(){
        return $this->hasMany(UserLocation::class);
    }

     //Relacion uno a muchos
     public function config(){
        return $this->hasMany(Config::class);
    }
}
