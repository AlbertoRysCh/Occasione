<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2; 
    const PUBLICADO_DESTACADO = 3; 
    const AGOTADO = 4; 

    const LOCAL = 1;
    const LOCAL_FREE = 2;
    const INTER = 3; 
    const INTER_FREE = 4; 

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //accesores

    public function getStockAttribute(){
        if ($this->subcategory->size) {
            return  ColorSize::whereHas('size.product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        } elseif($this->subcategory->color) {
            return  ColorProduct::whereHas('product', function(Builder $query){
                        $query->where('id', $this->id);
                    })->sum('quantity');
        }else{

            return $this->quantity;

        }
        
    }


    //Relacion uno a muchos
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    //Relacion uno a muchos inversa
    public function review(){
        return $this->belongsTo(Review::class);
    }

    //Relacion uno a muchos inversa
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

     //Relacion uno a muchos inversa
     public function bell(){
        return $this->belongsTo(Bell::class);
    } 

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    //Relacion muchos a muchos
    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }

    //relacion uno a muchos polimoefica
    public function images(){
        return $this->morphMany(Image::class, "imageable");
    }

    

    //URL AMIGABLES
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
