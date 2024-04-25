<?php
   $configs = DB::table('configs')
   ->first(); 
?>
@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])

    @if($configs == null)
        {{ config('app.name') }}
    @else 
    <img src="{{ Storage::url($configs->logo)}}" width="100" height="auto">
    @endif 

@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    @if($configs == null)
        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
    @else 
        © {{ date('Y') }} {{$configs->nombre_empresa }}. @lang('Todos los derechos reservados.')
    @endif 
@endcomponent
@endslot
@endcomponent
