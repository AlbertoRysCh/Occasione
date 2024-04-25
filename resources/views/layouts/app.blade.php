<!DOCTYPE html>

<?php
   $configs = DB::table('configs')
   ->first(); 
?>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('meta')
        
        <link rel="icon" href="{{asset('img/Occasione-Fabi.ico')}}">

        @if($configs != null)
            <title>{{$configs->nombre_empresa}}</title>
        @else
            <title>Ecommerce</title>
        @endif
         
    
        @if($configs != null && $configs->status == 0)
       
            <!-- Fonts -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

            <!-- Styles -->
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <link rel="stylesheet" href="{{ asset('css/btn-payment.css') }}">

            {{-- Fontawesome --}}
            <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

            {{-- Glider --}}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" />

            {{-- FlexSlider --}}
            <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}">

            @livewireStyles

            <!-- Scripts -->
            <script src="{{ mix('js/app.js') }}" defer></script>
    
            {{-- sweetalert2 Livewire--}}
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            {{-- Glider --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous"></script>

            {{-- jquery --}}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            {{-- FlexSlider --}}
            <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>
            
            <link rel="stylesheet" href="{{ asset('css/modal.css') }}"> 

            <link rel="stylesheet" href="{{ asset('css/app-vendor.css') }}"> 
        @endif

        @stack('style')

        {{-- Stripe --}}
        <script src="https://js.stripe.com/v3/"></script>
 

    </head>

    <body class="font-sans antialiased" onload="myFunction()">

    
        @if($configs != null && $configs->status == 1) 
            @livewire('mantenimiento')
        @else
        
            @livewire('preloader')

            <x-minibanner />

            <x-jet-banner />

            <div class="min-h-screen bg-gray-100">
                
                @livewire('navigation') 
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
                
            </div>

            @livewire('footer')

        @endif

        @stack('modals')

 
        <script>
            function dropdown(){
                return {
                    open: false,
                    show(){
                        if(this.open){
                            //Se cierra el menu
                            this.open = false;
                            document.getElementsByTagName('html')[0].style.overflow = 'auto'
                        }else{
                            //Esta abriendo el menu
                            this.open = true;
                            document.getElementsByTagName('html')[0].style.overflow = 'hidden'
                        }
                    },
                    close(){
                        this.open = false;
                        document.getElementsByTagName('html')[0].style.overflow = 'auto'
                    }
                }
            }
        </script>

         <script src="{{asset('js/app-vendor.js')}}"></script>  
  
        @livewireScripts

        @isset($js)
            {{$js}}
        @endisset

        @stack('script')
   
        <script src="{{asset('js/location.js')}}"></script>   
        <!-- Main -->  
        <script type="text/javascript" src="{{asset('js/app-filter.js')}}"></script>

        {{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}
        @stack('scriptorder')
        <script>
            Livewire.on('errorSize', mensaje => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: mensaje,
                }) /*  */
            });
        </script>

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/620d6b26a34c24564126a6c5/1fs26l403';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->

    </body>
    
</html>
