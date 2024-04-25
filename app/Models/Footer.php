<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
     
    protected $fillable = ['color_footer', 'color_texto_footer', 'color_subtexto_footer', 'image'];
}
