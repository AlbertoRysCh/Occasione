<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subbanner extends Model
{
    use HasFactory;

    protected $fillable = ['heading', 'description', 'link', 'link_name', 'image' , 'status'];
 
}
