 
<?php
$configs = DB::table('configs')
->first(); 
$access_front = DB::table('access_fronts')
->first(); 
?>
   
<x-guest-layout>
    @if($access_front != null)
        <x-access-front-style/>
    @endif
    
<style>
 
    .typcn{
        top: 280px !important;
    }
    .confirm-eye{
        top: 345px !important;
    } 
    .container{
      height: 620px !important;
    }
    .footer {
        top: 725px !important;
    }
    .dnthave {
        /* left: 32% !important; */
        width: 100% !important;
        text-align: center !important; 
        top: 92% !important;
            left: 0% !important;
    } 
    @media (max-width: 600px){
        
        .dnthave {
            position: absolute !important;
            top: 92% !important;
            left: 2% !important;
        }
        
    }
    </style>
<div class="animated bounceInDown"> 
<div class="container">
<span class="error animated tada" id="msg"></span>
 
<form method="POST" action="{{ route('password.update') }}" class="box">
    @csrf

    <h4>
        <a class="px-4" href="/">
            @if($configs == null)
                <x-application-mark class="block h-9 w-auto"  size="30" />
            @else 
                <img src="{{ Storage::url($configs->logo)}}" width="40" height="auto"  class="block h-9 w-auto">
            @endif  
        </a> 
    </h4>
    
    <h5>{{__('Reset Password')}}</h5> 

    <x-jet-validation-errors class="mb-4" style="color:{{$configs->color_texto_menu}}; margin-top:-25px"/>
    
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <input id="email" type="text"  placeholder="{{__('Email')}}"  name="email" :value="old('email', $request->email)" required autofocus>

    <i class="typcn typcn-eye mt-4" id="eye"></i> 
    
    <input id="password" type="password" placeholder="{{__('Password')}}" name="password" required autocomplete="new-password">

    
    <i class="typcn typcn-eye confirm-eye mt-4" id="eye_confirm"></i> 

    <input id="password_confirmation" placeholder="{{__('Confirm Password')}}" type="password" name="password_confirmation" required autocomplete="new-password">
   
 
    <div class="flex items-center justify-end mt-4">
        <x-jet-button class="btn1">
            {{ __('Reset Password') }}
        </x-jet-button>
    </div>
</form>
 

</div> 
   <div class="footer">
    <span>
        @if($configs != null)
            <a href="/">{{$configs->cr}}</a>
        @endif
    </span>
</div>
</div>
<!-- partial -->
<script>
    var pwd_confirm = document.getElementById('password_confirmation');
    var eye_confirm = document.getElementById('eye_confirm');
    eye_confirm.addEventListener('click',togglePass_Confirm);
    function togglePass_Confirm(){

    eye_confirm.classList.toggle('active');

    (pwd_confirm.type == 'password') ? pwd_confirm.type = 'text' : pwd_confirm.type = 'password';
    }

    var pwd = document.getElementById('password');
    var eye = document.getElementById('eye');

    eye.addEventListener('click',togglePass);

    function togglePass(){

    eye.classList.toggle('active');

    (pwd.type == 'password') ? pwd.type = 'text' : pwd.type = 'password';
    }

</script>
</x-guest-layout>