<?php
   $configs = DB::table('configs')
   ->first(); 
   $configs_footer = DB::table('footers')
   ->first(); 
   if($configs != null){
    $locations = DB::table('locations')->get();
   }
   
?>
<div> 

  @if($configs == null && $configs_footer == null)
  <footer class="footer-area" >
  @else 
  <footer class="footer-area" style="background:{{$configs_footer->color_footer}}" >
    <style>
      ul li a{
        color: <?=$configs_footer->color_subtexto_footer?>;
      }
      .social-icons li a{
        background: <?=$configs_footer->color_icons_footer?>;
      }
      .social-icons li a i{
        color: <?=$configs_footer->color_subtexto_footer?>;
      }
      .social-icons li a:hover{
        background: <?=$configs_footer->color_subtexto_footer?>;
      }
      .social-icons li a i:hover{
        color: <?=$configs_footer->color_texto_footer?>;
      }
    </style>
  @endif  
        <div class="md:col-span-2 lg:col-span-4 py-4" style="border-bottom: 1px solid #ccc;"> 
              
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 footer-payment-methods-list justify-center"> 
                        
              <li class="payment-method">
                <div class="payment-icon col-xl-12 col-lg-4 d-none d-lg-block flex justify-center">
                  <img class="w-full h-auto object-contain object-center" src="{{Storage::url( $configs_footer->image )}}" alt="">
                </div> 
              </li> 
          </ul>
        </div>
        
        <div class="md:col-span-2 lg:col-span-4"> 
              <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                  
                      <li class="rounded-lg ">
                          <article> 
                              <div class="py-4 px-6">
                                      <h1 class="text-lg font-semibold" style="color:{{$configs_footer->color_texto_footer}}" >
                                        SERVICIO AL CLIENTE
                                      </h1>
  
                                      <div class="flex items-center mt-2">
                                          <ul class="block text-sm">
                                              <li><a href="">Preguntas frecuentes</a></li>
                                              <li><a href="">Contacto</a></li>
                                              <li><a href="">Forma de pago</a></li>
                                              <li><a href="">Politica de Garantia y Devoluciones</a></li>
                                              <li><a href="">Aviso de Privacidad</a></li>
                                          </ul> 
                                      </div>
                                      
                              </div>
                          </article>
                      </li>

                      <li class="rounded-lg ">
                        <article> 
                            <div class="py-4 px-6 site-footer">
                                    <h1 class="text-lg font-semibold" style="color:{{$configs_footer->color_texto_footer}}" >
                                    OCCASIONE PAIS
                                    </h1>

                                    <div class="flex items-center mt-2">
                                        <ul class="block text-sm">
                                          @if($configs != null)
                                            @foreach($locations as $location)
                                              <li><a href="{{$location->url_dom}}">{{$location->name}}</a></li>
                                            @endforeach
                                          @endif
                                        </ul> 
                                    </div>
                                    
                            </div>
                        </article>
                    </li>

                    <li class="rounded-lg ">
                      <article> 
                          <div class="py-4 px-6">
                                  <h1 class="text-lg font-semibold" style="color:{{$configs_footer->color_texto_footer}}" >
                                    NOVEDADES
                                  </h1>

                                  <div class="flex items-center mt-2">
                                      <ul class="block text-sm">
                                          <li><a href="https://occasione.pe/categories/diesel">Diesel</a></li>
                                          <li><a href="https://occasione.pe/categories/emporio-armani">Emporio Armani</a></li>
                                          <li><a href="https://occasione.pe/categories/casio">Casio</a></li>
                                          <!--<li><a href="https://occasione.pe/categories/outlet">Outlet</a></li>-->
                                          <li><a href="https://occasione.pe/categories/michael-kors">Michael Kors</a></li>
                                          <!--<li><a href="https://occasione.pe/categories/fossil">Fossil</a></li>-->
                                          <li><a href="https://occasione.pe/categories/tissot">Tissot</a></li>
                                          <!--<li><a href="https://occasione.pe/categories/invicta">Invicta</a></li>-->
                                          <!--<li><a href="https://occasione.pe/categories/seiko">Seiko</a></li>-->
                                      </ul> 
                                  </div>
                                  
                          </div>
                      </article>
                  </li>

                    <li class="rounded-lg" style="border-left: 1px solid #ccc;">
                      <article> 
                          <div class="py-4 px-6">
                                  <h1 class="text-lg font-semibold" style="color:{{$configs_footer->color_texto_footer}}" >
                                  SIGUENOS
                                  </h1>

                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <ul class="social-icons">
                                      @if($configs != null)  
                                        <li><a class="facebook" href="{{$configs->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a class="instagram" href="{{$configs->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                      @endif
                                      <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                  </div>

                                  <a href="{{route("clains-book")}}">
                                    <div class="card flex justify-center mt-4 shadow border px-4 py-4" style="width: 18rem;border-radius: 15px;"> 
                                      <div class="card-body w-full ">
                                        <p class="card-text" style="font-weight: 800;font-size: 20px;color:{{$configs_footer->color_texto_footer}}">
                                          Libro de reclamaciones
                                        </p>
                                      </div>
                                      <div class="py-2 px-4">
                                        <x-item_book size="45" color="{{$configs_footer->color_footer}}" color_line="{{$configs_footer->color_subtexto_footer}}"/> 
                                      </div>
                                    </div>
                                  </a>

                                  <div class="py-4" style="color:{{$configs_footer->color_texto_footer}}" >
                                    @if($configs != null)
                                      {{$configs->cr}}
                                    @endif
                                  </div>
                          </div>
                      </article>
                  </li>

                    
              </ul>

      
  
      </div>
  </footer>     
    {{-- The best athlete wants his opponent at his best. --}}
</div> 