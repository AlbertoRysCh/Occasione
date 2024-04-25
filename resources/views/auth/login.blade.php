 
<?php 
$configs = DB::table('configs')
->first(); 
$access_front = DB::table('access_fronts')
->first(); 
?>

<x-app-layout>   
    <link rel="stylesheet" href="{{ asset('css/bundle.css') }}"> 
<!-- Account-Page -->
<div class="page-account py-10 md:py-20">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-6">
            
            <!-- Register -->
            <div class="col-lg-6 shadow py-8">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">{{__('Register')}}</h2>
                    <h6 class="account-h6 mb-4">{{(__('Registering for this site allows you to access your order status and history.'))}}</h6>
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
            
                        <div class="mb-4">
                            <label for="user-name">{{ __('Name y Last') }}
                                <span class="astk">*</span>
                            </label> 
                            <x-jet-input id="user-name" class="text-field" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"/>
                        </div>
                        <div class="mb-4">
                            <label for="email">{{ __('Email') }}
                                <span class="astk">*</span>
                            </label> 
                            <x-jet-input id="email" class="text-field" type="email" name="email" :value="old('email')" required/>

                        </div>
              
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-1">

                            <div class="mb-4">
                                <label for="password">{{ __('Password') }}
                                    <span class="astk">*</span>
                                </label> 
                                <x-jet-input id="password" class="text-field" type="password" name="password" required autocomplete="new-password"/>
                                
                            </div>
                            <div class="mb-4 ">
                                <label for="password_confirmation">{{ __('Confirm Password') }}
                                    <span class="astk">*</span>
                                </label> 
                                <x-jet-input id="password_confirmation" class="text-field" type="password" name="password_confirmation" required autocomplete="new-password"/>
    
                            </div>
                        </div>

                        <div class="mb-4">
                            <input type="checkbox" class="check-box" id="accept" required>
                            <label class="label-text no-color" for="accept">{{__('I’ve read and accept the')}}
                                <a href="{{route('policy')}}" class="u-c-brand">{{__('terms & conditions')}}</a>
                            </label>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms"/>
        
                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif

                        <div class="u-s-m-b-45"> 
                            <x-button_access class="btn-register button button-primary w-full" style="border-radius: 5px;background: #ea580c; padding:10px ">
                                {{ __('Register') }}
                            </x-button_access>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Register /- -->

            <!-- Login -->
            <div class="col-lg-6">
                <div class="login-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">{{__('Login')}}</h2>
                    <h6 class="account-h6 mb-4">{{__('Welcome back! Sign in to your account.')}}</h6>
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="user-name-email">{{__('Email')}}
                                <span class="astk">*</span>
                            </label> 
                            <x-jet-input id="user-name-email" class="text-field" type="email" name="email" :value="old('email')" required autofocus/>

                        </div>
                        <div class="mb-4">
                            <label for="login-password">{{__('Password')}}
                                <span class="astk">*</span>
                            </label> 
                            <x-jet-input id="login-password" class="text-field" type="password" name="password" required autocomplete="current-password"/>
                        </div>

                        <div class="group-inline mb-4">
                            <div class="group-1">
                                <input type="checkbox" class="check-box" id="remember-me-token">
                                <label class="label-text" for="remember-me-token">{{__('Remember me')}}</label>
                            </div>

                            <div class="group-2 text-right">
                                <div class="page-anchor"> 
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i> {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                        <div class="m-b-45"> 
                            <x-button_access class="btn-login button button-outline-secondary w-full" style="border-radius: 5px; padding:10px ">
                                {{ __('Log in') }}
                            </x-button_access>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login /- -->
        </div>
    </div>
</div>
<!-- Account-Page /- --> 

</x-app-layout>