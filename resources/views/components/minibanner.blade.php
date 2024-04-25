<?php
   $bannertops = DB::table('bannertops')
   ->first(); 
?>
@if($bannertops != null)
  @if($bannertops->status == true)

  <style>
    .bannerx{
        height: <?=$bannertops->dim_height?> !important; 
    }
  </style>

  <div class="banner">
    @if($bannertops->link_banner)
    <a href="{{$bannertops->link_banner}}">
    @else
    <a>
    @endif
      <div class="banner__content">

        <img class="flex w-full hidden md:block bannerx" src="{{ Storage::url($bannertops->banner_img_web)}}" />
        <img class="flex w-full  md:hidden bannerx" src="{{ Storage::url($bannertops->banner_img_app)}}" />

      <div class="banner__text">
        
      </div>
      {{-- <button class="banner__close" type="button">
        <span class="material-icons">
          X
        </span>
      </button> --}}
    </div>
    </a>
     
  </div>
  @endif
@endif
