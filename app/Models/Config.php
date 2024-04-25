<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

     //Relacion uno a muchos inversa
    public function location(){
        return $this->belongsTo(Location::class);
    }

}
