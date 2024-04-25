<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardBanner extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_card', 'heading', 'description', 'link', 'link_name', 'image', 's_heading', 's_description', 's_link', 's_link_name', 's_image' , 'status'];
} 
