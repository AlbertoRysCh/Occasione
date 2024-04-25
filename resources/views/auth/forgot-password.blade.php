
<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/bundle.css') }}"> 
    <!-- Lost-password-Page -->
<div class="page-lost-password mb-5">
    <div class="container">
        <div class="page-lostpassword md:px-20 py-20">
            <h2 class="account-h2 u-s-m-b-20">{{__('Forgot Password ?')}}</h2>
            <h6 class="account-h6 u-s-m-b-30">  {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</h6>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="w-50">
                    <div class="u-s-m-b-13">
                        <label for="user-name-email">{{__('Email')}}
                            <span class="astk">*</span>
                        </label>
                        <x-input-checkout id="user-name-email" class="text-field" type="email" name="email" :value="old('email')" placeholder="{{__('Email')}}" required autofocus />

                    </div>
                    <div class="u-s-m-b-13"> 
                        <x-button_access class="button button-outline-secondary">
                            {{ __('Email Password Reset Link') }}
                        </x-button_access>
                    </div>
                </div>
                <div class="page-anchor">
                    <a href="{{route('login')}}">
                        <i class="fas fa-long-arrow-alt-left u-s-m-r-9"></i>{{__('Back to Login')}}</a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>