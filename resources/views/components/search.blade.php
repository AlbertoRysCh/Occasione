@props(['size' => 35, 'color' => 'gray'])

{{-- @php
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
@endphp --}}

<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="{{$size}}" height="{{$size}}" viewBox="0 0 226 226"
    style=" fill:#000000;">
    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
        stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
        <path d="M0,226v-226h226v226z" fill="none"></path>
        <g fill="{{$color}}">
            <path
                d="M92.42978,25.42569c-17.1707,0 -34.34072,6.53212 -47.40634,19.59775c-26.13125,26.13125 -26.13125,68.68143 0,94.81268c13.06562,13.06563 30.19288,19.6012 47.496,19.6012c17.30313,0 34.43038,-6.53557 47.496,-19.6012c25.95469,-26.13125 25.95193,-68.68143 -0.17932,-94.81268c-13.06563,-13.06562 -30.23564,-19.59775 -47.40634,-19.59775zM92.34357,35.84357c14.47813,0 28.95556,5.47068 39.90244,16.59412c22.07031,22.07031 22.06962,57.91388 0.17587,79.98419c-22.07031,22.07031 -57.91388,22.07031 -79.98419,0c-22.07031,-22.07031 -22.07031,-57.91388 0,-79.98419c10.94688,-10.94687 25.42776,-16.59412 39.90588,-16.59412zM92.34357,46.43732c-12.18281,0 -23.66075,4.76581 -32.31232,13.59393c-8.29844,8.29844 -12.88837,19.06944 -13.41806,30.72257c-0.17656,3.00156 2.11944,5.29618 5.121,5.47275h0.17587c2.825,0 5.12031,-2.296 5.29688,-5.121c0.35313,-9.00469 4.05887,-17.30381 10.23856,-23.66006c6.70937,-6.70937 15.54026,-10.41443 24.89807,-10.41443c3.00156,0 5.29688,-2.29531 5.29688,-5.29687c0,-3.00156 -2.29531,-5.29687 -5.29687,-5.29687zM61.79688,113c-2.92538,0 -5.29687,2.37149 -5.29687,5.29688c0,2.92538 2.37149,5.29688 5.29688,5.29688c2.92538,0 5.29688,-2.37149 5.29688,-5.29687c0,-2.92538 -2.37149,-5.29687 -5.29687,-5.29687zM147.18829,142.13281c-1.34629,0 -2.67051,0.53038 -3.6416,1.58975c-2.11875,2.11875 -2.11875,5.47206 0,7.41424l4.41406,4.41406c-1.05937,2.11875 -1.58975,4.41475 -1.58975,6.88663c0,4.2375 1.58837,8.29913 4.58993,11.30069l22.60138,22.24618c3.17812,3.17812 7.23631,4.76581 11.29724,4.76581c4.06094,0 8.12256,-1.58837 11.30069,-4.58994c6.17969,-6.17969 6.17969,-16.24237 0,-22.42206l-22.59793,-22.60138c-3.00156,-3.00156 -7.06319,-4.58993 -11.30069,-4.58993c-2.47188,0 -4.76788,0.53038 -6.88663,1.58975l-4.41406,-4.41406c-1.05937,-1.05937 -2.42636,-1.58975 -3.77264,-1.58975zM162.26163,156.96475c1.4125,0 2.82431,0.53038 3.70712,1.58975l22.42206,22.42206c2.11875,2.11875 2.11875,5.47206 0,7.41425c-2.11875,2.11875 -5.47206,2.11875 -7.41425,0l-22.42206,-22.24619c-1.05937,-1.05937 -1.58975,-2.47049 -1.58975,-3.88299c0,-1.4125 0.53038,-2.82431 1.58975,-3.70712c1.05937,-1.05937 2.29462,-1.58975 3.70712,-1.58975z">
            </path>
        </g>
    </g>
</svg>
