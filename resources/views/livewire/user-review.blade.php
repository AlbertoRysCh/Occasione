@php
$sum_rating = 0; 

$por_rating_1 = 0;
$por_rating_2 = 0;
$por_rating_3 = 0;
$por_rating_4 = 0;
$por_rating_5 = 0;

$count_rating_1 = 0;
$count_rating_2 = 0;
$count_rating_3 = 0;
$count_rating_4 = 0;
$count_rating_5 = 0;

$cont=count($reviews); 

    foreach($reviews as $var) {
        if($var->status == 1){
            $sum_rating += $var->rating; 
    
                switch ($var->rating) {
                    case 1:
                        $count_rating_1++;
                        break;
                    case 2:
                        $count_rating_2++;
                        break;
                    case 3:
                        $count_rating_3++;
                        break;
                    case 4:
                        $count_rating_4++;
                        break;
                    case 5:
                        $count_rating_5++;
                        break;
                }
        }
    }
    
    if($cont != 0){
        $rating = round($sum_rating/$cont,1);

        $por_rating_1=($count_rating_1/$cont)*100.00;
        $por_rating_2=($count_rating_2/$cont)*100.00;
        $por_rating_3=($count_rating_3/$cont)*100.00;
        $por_rating_4=($count_rating_4/$cont)*100.00;
        $por_rating_5=($count_rating_5/$cont)*100.00;
    }
          
@endphp

<style>
    
    .bar .progress-line.reviews-5 span{ 
         width: <?=$por_rating_5?>%;
    }
    .bar .progress-line.reviews-4 span{ 
        width: <?=$por_rating_4?>%;
    }
    .bar .progress-line.reviews-3 span{ 
        width: <?=$por_rating_3?>%;
    }
    .bar .progress-line.reviews-2 span{ 
        width: <?=$por_rating_2?>%;
    }
    .bar .progress-line.reviews-1 span{ 
        width: <?=$por_rating_1?>%;
    }
    .btnr{ 
        box-shadow: inset 0 1px 1px #5a5a5a,
                0 1px #5a5a5a;
        padding: 10px;
        font-size: 16px;
        border-radius: 15px;
        font-weight: 900;
        background:#5a5a5a;
        color: #fff;
    }
    .btnr.active{
        background: #f65e04;
    }
 
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  
<section class="modal pt-2">
    <div class="modal__container">
        <form method="POST" action="{{ route('review.save') }}"  >
        @csrf
            <a href="#" class="modal__close_review w-full flex justify-end">X</a>
            <h2 style="font-size:15px; font-weight:900; color:#f65e04">Cuéntanos, ¿qué te pareció el producto?</h2>
            <div class="flex">
                <div>
                    <figure>
                        <img class="h-24 w-24 object-cover object-center" src="{{ Storage::url($id_prod->images->first()->url) }}" alt="">
                    </figure>
                </div>
                <div>
                    <p>{{$id_prod->name}}</p>
                    <p>Marca: {{$id_prod->brand->name }}</p>
                </div>
            </div>

            
            <input type="hidden" name="product_id" value="{{$id_prod->id}}" />
 
            @auth
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
            @endauth
            
            <div class="w-full flex py-1"> 
                    <p class="modal__paragraph">
                        Califica
                    </p> 
                    <div class="rateyo-readonly-widg w-full"></div>
            </div>

            {{-- <span class="result"></span> --}}
            <input type="hidden" name="rating" id="v_rating"/>
  
            <div class="w-full py-1">
                <label>Comentarios (Opcional)</label>
                <textarea class="form-control w-full" name="content" placeholder="¿Recomendarías el producto? ¿Fue lo que esperabas? ¿Te gustó o no? ¡Cuéntanos!" rows="4"></textarea>
                <span class="text-danger error-text content_error"></span>
            </div>
            
            <div class="w-full py-1">
                <button id="btn-rating" class="btnr w-full" type="submit" disabled>Aceptar</button>
              
            </div> 
        </form>
    </div>
</section> 

<div class="container">
    <div class="content-infp mt-4">

        <h2 class="font-bold mb-2" style="color: #ff5700;text-decoration: revert;">Reseñas del producto</h2>

        @if($cont == 0) 
            <p>Este producto aún no tiene reseñas. ¡Sé el primero en compartirnos tu opinión!</p> 
        @endif

            @auth
                <x-jet-dropdown-link class="hero__review" style="color: #ff5700;text-decoration: revert;">
                    {{ __('Escribe una reseña') }}
                </x-jet-dropdown-link>
            @else 
                <x-jet-dropdown-link href="{{ route('login') }}" style="color: #ff5700;text-decoration: revert;">
                    {{ __('Iniciar sesión para escribir tu reseña') }}
                </x-jet-dropdown-link>
            @endauth
    </div>
</div>


<div wire:init="loadReview" class="infp text-gray-700" id="reviews" style="margin-top:1rem">
   
<div class="detail-infp"> 
    @if($cont != 0)
        <div class="u-s-m-b-30">
            <div class="pd-tab__rev-score">

                <div class="px-4 w-full justify-center flex" style="font-weight: 600">
                    @if($cont != 0)
                        <h2 style="font-size: 35px;">{{$rating}}</h2>
                    @endif
                </div>

                <div class="rating gl-rating-style-2 start-items "> 
                    @if($cont != 0) 
                        @foreach(range(1,5) as $i)
                        
                            @if($rating >0)
                                @if($rating >0.5)
                                    <i class="fas fa-star"></i> 
                                @else
                                    <i class="fas fa-star-half-alt"></i>
                                @endif 
                            @else
                                <i class="far fa-star"></i>   
                            @endif
                            
                            @php $rating--; @endphp
                        
                        @endforeach
                    @endif

                </div>

                <div class="px-4 w-full justify-center flex" style="font-weight: 400">
                    @if($cont != 0)
                        <h4 style="font-size: 16px;">{{$cont}} reseña</h4>
                    @endif
                    
                </div>

                
            </div>
            
        </div> 

        {{-- Reviews Web --}}
            <div class="skill-bars hidden md:block">
                        
                @foreach(range(5,1) as $i)     
                    <div class="bar"> 
                        <div class="flex">
                            <div class="info ">
                                <span class="flex -m-2 start-items">{{$i}}  <i class="fas fa-star ml-1 mt-1"></i></span>
                            </div>
                            <div class="progress-line reviews-{{$i}} ml-4 mr-4">
                                <span></span> 
                            </div>
                            <div class="flex justify-end -mt-2"> 
                                {{ ${'count_rating_'.$i} }}
                            </div>
                        </div> 
                    </div>
                @endforeach


            </div>
        
        <x-arrow-down size="20" color="#ffffff" />
    @endif
</div> 

{{-- Reviews Mobil --}}
@if($cont != 0)  
    <div class="skill-bars md:hidden sm:block mt-4">
                        
        @foreach(range(5,1) as $i)     
            <div class="bar"> 
                <div class="flex">
                    <div class="info ">
                        <span class="flex -m-2 start-items">{{$i}}  <i class="fas fa-star ml-1 mt-1"></i></span>
                    </div>
                    <div class="progress-line reviews-{{$i}} ml-4 mr-4">
                        <span></span> 
                    </div>
                    <div class="flex justify-end -mt-2"> 
                        {{ ${'count_rating_'.$i} }}
                    </div>
                </div> 
            </div>
        @endforeach 
    </div>
@endif


        <div class="sub-detail-infp review">
          
            @foreach($reviews as $review) 
                    <div class="review-o u-s-m-b-15 m-2 px-2 py-4">
                        <div class="review-o__info u-s-m-b-8">

                            <span class="review-o__name">{{$review->name}}</span>
        
                            <span class="review-o__date">el {{$review->time_review}}</span></div>

                            
                        <div class="review-o__rating gl-rating-style u-s-m-b-8 start-items mb-2">
        
                            <span>({{$review->rating}})</span>
                            
                            @foreach(range(1,5) as $i)
                                    
                                @if($review->rating >0)
                                    @if($review->rating >0.5)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif 
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                                
                                @php $review->rating--; @endphp
                            
                            @endforeach  

                            @livewire('verified-order-user',['user_id' => $review->user_id, 'product_id' => $review->product_id])

                        </div> 
                            @if($review->comment != null)
                                <p class="review-o__text">{{$review->comment}}</p>
                            @endif
                    </div> 
            @endforeach
             
        </div> 
</div>

   
{{-- <script src="{{ asset('js/app-modal.js')}}"></script>   --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script src="{{ asset('js/app-review.js')}}"></script>  

<script>

$(function () {
    
    preloader.style.display = 'none';
    var _token = $("meta[name='csrf-token']").attr("content");
    $('#btn-rating').click(function(){
              if(rating!=0){
                $.ajax({           
                  url: '/review/save',
                  method: "post",  
                  data:{ 
                    _token: _token,
                    rating: rating,
                    content: valueplan,
                    product_id: newPrecio,
                    user_id: valueFree
                  },
                  success: function (response) {
                      // console.log(response);
                      //console.log(response); 
                      console.log("listo");
                      //$('.fade').fadeOut();
                  }, error: function (e) {
                      console.log(e.message);
                  }
              });  
            }
        });
 });
    
</script>
 