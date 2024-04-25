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
        @if($configs != null)
                <title>{{$configs->nombre_empresa}}</title>
        @else
            <title>Ecommerce</title>
        @endif
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
        
        <link rel="stylesheet" href="{{ asset('css/style-particles.css') }}">
        
        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head> 
    <body id="particles-js">
        {{ $slot }} 
    </body> 
            
    <script src='https://cldup.com/S6Ptkwu_qA.js'></script>
    <script  src="{{asset('js/script-particles.js')}}"></script>
</html>
