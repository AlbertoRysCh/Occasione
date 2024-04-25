@props(['size' => 35, 'color' => 'gray'])

@php
    
    switch ($color) {
        case 'gray':
            
            $col = "#374151";

            break;

        case 'white':
            
            $col = "#ffffff";

            break;
        
        default:

            $col = "#374151";

            break;
    }

@endphp
 
<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="{{$size}}" height="{{$size}}" viewBox="0 0 172 172" style=" fill:#000000;">
<g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" 
stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" 
font-size="none" text-anchor="none" style="mix-blend-mode: normal">
<path d="M0,172v-172h172v172z" fill="none"></path>
<g fill="{{$col}}">
<path d="M154.74625,44.6125c-1.8275,0.05375 -3.5475,0.80625 -4.81062,2.12313l-63.93563,63.93562l-63.93562,-63.93562c-1.30344,-1.33031 -3.07719,-2.08281 -4.945,-2.08281c-2.795,0 -5.30781,1.70656 -6.35594,4.3c-1.06156,2.59344 -0.43,5.56312 1.57219,7.51156l68.8,68.8c2.6875,2.6875 7.04125,2.6875 9.72875,0l68.8,-68.8c2.0425,-1.96188 2.6875,-4.98531 1.58562,-7.60563c-1.08844,-2.62031 -3.66844,-4.3 -6.50375,-4.24625z"></path>
</g>
</g>
</svg>