<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessFront extends Model
{
    use HasFactory;

    
    protected $fillable = ['color_fondo_access', 'color_card_access', 'color_card_line_access', 'color_card_hover_access', 'color_card_text_access', 'color_card_enlace_access', 'image'];
 

}
