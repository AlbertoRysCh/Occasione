<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTop extends Model
{
    protected $fillable = ['banner_img_web', 'banner_img_app', 'link_banner', 'dim_height'];
    use HasFactory;
}
