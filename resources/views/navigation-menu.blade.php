<?php
$configs = DB::table('configs')->first();
?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->

                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        @if ($configs == null)
                            <x-jet-application-mark class="block h-9 w-auto" />
                        @else
                            <img src="{{ Storage::url($configs->logo) }}" width="35" height="35">
                        @endif
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <x-dropdown align="right" width="60" :active="request()->routeIs('admin.config.*')">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                {{ __('Configuration') }}
                                <i class="mt-1 ml-1 fas fa-angle-down"></i>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Configuration') }}
                                </div>

                                <!-- Configuration -->
                                <x-dropdown-link href="{{ route('admin.config.index') }}"
                                    :active="request()->routeIs('admin.config.*')">
                                    {{ __('Configuration') }}
                                </x-dropdown-link>

                                <!-- Access Front -->
                                <x-dropdown-link href="{{ route('admin.accessfront.index') }}"
                                    :active="request()->routeIs('admin.accessfront.*')">
                                    {{ __('Access Front') }}
                                </x-dropdown-link>

                                <!-- Locations -->
                                <x-dropdown-link href="{{ route('admin.locations.index') }}"
                                    :active="request()->routeIs('admin.locations.*')">
                                    {{ __('Locations') }}
                                </x-dropdown-link>

                                <!-- Ubigeo -->
                                {{-- <x-dropdown-link href="{{route('admin.departments.index')}}" :active="request()->routeIs('admin.departments.index')">
                                    {{ __('Ubigeo') }}
                                </x-dropdown-link> --}}

                                <x-dropdown-link href="{{ route('admin.ubigeos.index') }}"
                                    :active="request()->routeIs('admin.ubigeos.index')">
                                    {{ __('Ubigeo') }}
                                </x-dropdown-link>

                                <!-- Users -->
                                <x-dropdown-link href="{{ route('admin.users.index') }}"
                                    :active="request()->routeIs('admin.users.index')">
                                    {{ __('Users') }}
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('admin.coupon.index') }}"
                                    :active="request()->routeIs('admin.coupon.index')">
                                    {{ __('Cupones Descuento') }}
                                </x-dropdown-link>

                            </div>
                        </x-slot>
                    </x-dropdown>


                    <x-dropdown align="right" width="60" :active="request()->routeIs('admin.index')">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                {{ __('Products') }}
                                <i class="mt-1 ml-1 fas fa-angle-down"></i>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Products') }}
                                </div>

                                <!-- Products Create-->
                                <x-dropdown-link href="{{ route('admin.products.create') }}"
                                    :active="request()->routeIs('admin.products.*')">
                                    {{ __('Products Create') }}
                                </x-dropdown-link>

                                <!-- Products List -->
                                <x-dropdown-link href="{{ route('admin.index') }}"
                                    :active="request()->routeIs('admin.index')">
                                    {{ __('Products') }}
                                </x-dropdown-link>

                                <!-- Products Import-->
                                <x-dropdown-link href="{{ route('admin.import_products.index') }}"
                                    :active="request()->routeIs('admin.import_products.*')">
                                    {{ __('Products Import') }}
                                </x-dropdown-link>

                                <!-- Company -->
                                <x-dropdown-link href="{{ route('admin.bells.index') }}"
                                    :active="request()->routeIs('admin.bells.*')">
                                    {{ __('Company') }}
                                </x-dropdown-link>


                            </div>
                        </x-slot>
                    </x-dropdown>

                    <x-jet-nav-link href="{{ route('admin.review.index') }}"
                        :active="request()->routeIs('admin.review.*')">
                        {{ __('Reviews') }}
                    </x-jet-nav-link>

                    <x-dropdown align="right" width="60" :active="request()->routeIs('admin.sliders.*')">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                {{ __('Banners') }}
                                <i class="mt-1 ml-1 fas fa-angle-down"></i>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Banners') }}
                                </div>

                                <!-- Slider -->
                                <x-dropdown-link href="{{ route('admin.sliders.index') }}"
                                    :active="request()->routeIs('admin.sliders.*')">
                                    {{ __('Slider') }}
                                </x-dropdown-link>

                                <!-- Banner Top -->
                                <x-dropdown-link href="{{ route('admin.bannertop.index') }}"
                                    :active="request()->routeIs('admin.bannertop.*')">
                                    {{ __('Banner Top') }}
                                </x-dropdown-link>

                                <!-- Banner Button -->
                                <x-dropdown-link href="{{ route('admin.subbanner.index') }}"
                                    :active="request()->routeIs('admin.subbanner.*')">
                                    {{ __('Banner Button') }}
                                </x-dropdown-link>

                                <!-- Banner Card -->
                                <x-dropdown-link href="{{ route('admin.cardbanner.index') }}"
                                    :active="request()->routeIs('admin.cardbanner.*')">
                                    {{ __('Banner Card') }}
                                </x-dropdown-link>


                            </div>
                        </x-slot>
                    </x-dropdown>


                    @livewire('dropdown-order')

                    <x-dropdown align="right" width="60" :active="request()->routeIs('admin.categories.*')">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                {{ __('Menu') }}
                                <i class="mt-1 ml-1 fas fa-angle-down"></i>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Menu -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Menu') }}
                                </div>

                                <!-- Categories -->
                                <x-dropdown-link href="{{ route('admin.categories.index') }}"
                                    :active="request()->routeIs('admin.categories.*')">
                                    {{ __('Categories') }}
                                </x-dropdown-link>

                                <!-- Brands -->
                                <x-dropdown-link href="{{ route('admin.brands.index') }}"
                                    :active="request()->routeIs('admin.brands.*')">
                                    {{ __('Brands') }}
                                </x-dropdown-link>

                                <!-- Color -->
                                <x-dropdown-link href="{{ route('admin.colors.index') }}"
                                    :active="request()->routeIs('admin.colors.*')">
                                    {{ __('Colors') }}
                                </x-dropdown-link>

                            </div>
                        </x-slot>
                    </x-dropdown>


                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Configuration  -->
            <x-jet-responsive-nav-link href="{{ route('admin.config.index') }}"
                :active="request()->routeIs('admin.config.*')">
                {{ __('Configuration') }}
            </x-jet-responsive-nav-link>

            <!-- Access Front -->
            <x-jet-responsive-nav-link href="{{ route('admin.accessfront.index') }}"
                :active="request()->routeIs('admin.accessfront.*')">
                {{ __('Access Front') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.locations.index') }}"
                :active="request()->routeIs('admin.locations.*')">
                {{ __('Locations') }}
            </x-jet-responsive-nav-link>

            {{-- <x-jet-responsive-nav-link href="{{route('admin.departments.index')}}" :active="request()->routeIs('admin.departments.index')">
                {{ __('Ubigeo') }}
            </x-jet-responsive-nav-link> --}}

            <x-jet-responsive-nav-link href="{{ route('admin.ubigeos.index') }}"
                :active="request()->routeIs('admin.ubigeos.index')">
                {{ __('Ubigeo') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.users.index') }}"
                :active="request()->routeIs('admin.users.index')">
                {{ __('Users') }}
            </x-jet-responsive-nav-link>

            <!-- Products Create-->
            <x-jet-responsive-nav-link href="{{ route('admin.products.create') }}"
                :active="request()->routeIs('admin.products.*')">
                {{ __('Products Create') }}
            </x-jet-responsive-nav-link>

            <!-- Products List -->
            <x-jet-responsive-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                {{ __('Products') }}
            </x-jet-responsive-nav-link>

            <!-- Products Import-->
            <x-jet-responsive-nav-link href="{{ route('admin.import_products.index') }}"
                :active="request()->routeIs('admin.import_products.*')">
                {{ __('Products Import') }}
            </x-jet-responsive-nav-link>


            <x-jet-responsive-nav-link href="{{ route('admin.bells.index') }}"
                :active="request()->routeIs('admin.bells.*')">
                {{ __('Company') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.review.index') }}"
                :active="request()->routeIs('admin.review.*')">
                {{ __('Reviews') }}
            </x-jet-responsive-nav-link>

            <!-- Sliders -->
            <x-jet-responsive-nav-link href="{{ route('admin.sliders.index') }}"
                :active="request()->routeIs('admin.sliders.*')">
                {{ __('Slider') }}
            </x-jet-responsive-nav-link>

            <!-- Banner Top -->
            <x-jet-responsive-nav-link href="{{ route('admin.bannertop.index') }}"
                :active="request()->routeIs('admin.bannertop.*')">
                {{ __('Banner Top') }}
            </x-jet-responsive-nav-link>

            <!-- Banner Button -->
            <x-jet-responsive-nav-link href="{{ route('admin.subbanner.index') }}"
                :active="request()->routeIs('admin.subbanner.*')">
                {{ __('Banner Button') }}
            </x-jet-responsive-nav-link>

            <!-- Banner Card -->
            <x-jet-responsive-nav-link href="{{ route('admin.cardbanner.index') }}"
                :active="request()->routeIs('admin.cardbanner.*')">
                {{ __('Banner Card') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.orders.index') }}"
                :active="request()->routeIs('admin.orders.*')">
                {{ __('Orders') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.categories.index') }}"
                :active="request()->routeIs('admin.categories.*')">
                {{ __('Categories') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.brands.index') }}"
                :active="request()->routeIs('admin.brands.*')">
                {{ __('Brands') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('admin.colors.index') }}"
                :active="request()->routeIs('admin.colors.*')">
                {{ __('Colors') }}
            </x-jet-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                        :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                            :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>