<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bell extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image','status'];
    
      //Relacion uno a muchos
      
    public function products(){
        return $this->hasMany(Product::class);
    }

}
