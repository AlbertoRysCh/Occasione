<?php
$configs = DB::table('configs')->first();
if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');
}
?>



<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">

    <div class="col-span-3 md:col-span-6">
        <x-status-pay-orden :status="1" />
    </div>
    <div class="order-2 col-span-3 lg:order-1 lg:col-span-1 xl:col-span-3">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre y Apellidos" />
                <x-jet-input type="text" wire:model.defer="contact" class="w-full" />
                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="Numero de Celular" />
                <div class="flex justify-center" style="align-items: center">
                    {{-- <x-jet-label value="+" class="px-2" style="font-size: 18px; font-weight: bold"/>

                 <x-jet-input type="text"
                    wire:model.defer="cod_phone"
                    placeholder="cod"
                    class="w-20"/> --}}
                    <x-jet-input type="text" wire:model.defer="phone" class="w-full" />

                </div>

                <x-jet-input-error for="phone" />
            </div>
        </div>

        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            @if ($envio_local == 1)
                <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                    <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Recojo en tienda (Calle Falsa 123)
                    </span>

                    <span class="font-semibold text-gray-700 ml-auto">
                        Gratis
                    </span>
                </label>
            @endif
            <div class="bg-white rounded-lg shadow">

                <label class="px-6 py-4 flex items-center cursor-pointer">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envío a domicilio
                    </span>

                </label>

                <div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-6 hidden"
                    :class="{ 'hidden': envio_type != 2 }">

                    <div>
                        <x-jet-label value="Tipo de dirección" />

                        <select class="form-control w-full" wire:model="address_type">

                            <option value="" selected>Seleccione una dirección</option>

                            <option value="Casa">Casa</option>
                            <option value="Departamento">Departamento</option>
                            <option value="Condominio">Condominio</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Oficina">Oficina</option>
                            <option value="Local">Local</option>
                            <option value="Centro">Centro</option>
                            <option value="Mercado">Mercado</option>
                            <option value="Galería">Galería</option>
                            <option value="Otro">Otro</option>

                        </select>

                        <x-jet-input-error for="address_type" />
                    </div>
                    <div class="col-span-1">
                        <x-jet-label value="Dirección" />
                        <x-jet-input class="w-full" wire:model="address" type="text" />
                        <x-jet-input-error for="address" />
                    </div>
                    <div class="col-span-1">
                        <x-jet-label value="Nro/Lote" />
                        <x-jet-input class="w-full" wire:model="address_lot" type="text" />
                        <x-jet-input-error for="address_lot" />
                    </div>
                    <div class="col-span-1">
                        <x-jet-label value="Depto./Int (Opcional)" />
                        <x-jet-input class="w-full" wire:model="address_department" type="text" />
                        <x-jet-input-error for="address_department" />
                    </div>
                    <div class="col-span-1">
                        <x-jet-label value="Urbanización (Opcional)" />
                        <x-jet-input class="w-full" wire:model="address_urbanization" type="text" />
                        <x-jet-input-error for="address_urbanization" />
                    </div>
                    <div class="col-span-1">
                        <x-jet-label value="Referencia (Opcional)" />
                        <x-jet-input class="w-full" wire:model="references" type="text" />
                        <x-jet-input-error for="references" />
                    </div>
                    {{-- Departamentos --}}
                    <div>
                        <x-jet-label value="Departamento" />

                        <select class="form-control w-full" wire:model="department_id">

                            <option value="" disabled selected>Seleccione un Departamento</option>

                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="department_id" />
                    </div>
                    {{-- Ciudades --}}
                    <div>
                        <x-jet-label value="Ciudad" />

                        <select class="form-control w-full" wire:model="city_id">

                            <option value="" disabled selected>Seleccione una ciudad</option>

                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="city_id" />
                    </div>
                    {{-- Distritos --}}
                    <div>
                        <x-jet-label value="Distrito" />

                        <select class="form-control w-full" wire:model="district_id">

                            <option value="" disabled selected>Seleccione un distrito</option>

                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="district_id" />
                    </div>
                </div>
            </div>

        </div>

        <div>

            <div class="block md:hidden text-center">
                <x-button_access style="background: #f97316" wire:loading.attr="disabled" wire:target="create_order"
                    class="mt-6 mb-4  px-8 py-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                    wire:click="create_order">
                    Continuar con la compra
                </x-button_access>

                <hr>

                <p class="text-sm text-gray-700 mt-2"> Sus datos personales se utilizarán para procesar su pedido
                    respaldar su experiencia en este sitio web y para otros fines descritos en nuestro <a
                        href="{{ route('policy') }}" target="_blank" class="font-semibold text-orange-500">Políticas y
                        privacidad</a></p>

            </div>
        </div>

    </div>

    <div class="order-1 col-span-3 lg:order-2 lg:col-span-1 xl:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200 h-15">
                        <div class="flex items-center">
                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        </div>

                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>

                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="mx-2">- Color: {{ __($item->options['color']) }}</p>
                                @endisset

                                @isset($item->options['size'])
                                    <p>{{ $item->options['size'] }}</p>
                                @endisset

                            </div>

                            @if ($item->sub_price != null || $item->sub_price != 0.0)
                                <div class="flex">
                                    <p class="text-s"
                                        style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">
                                        {{ $money }} {{ number_format($item->sub_price, 2) }}</p>

                                    <small class="ml-2">-{{ $item->porcentaje }}%</small>
                                </div>
                                <p class="text-op">{{ $money }} {{ number_format($item->price, 2) }}
                                </p>
                            @else
                                <p class="text-op">{{ $money }} {{ number_format($item->price, 2) }}
                                </p>
                            @endif
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{ $money }} {{ Cart::subtotal() }} </span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            @if ($shipping_cost != 0)
                                {{ $money }} {{ $shipping_cost }}
                            @else
                                Gratis
                            @endif

                        @endif
                    </span>
                </p>


                @if ($shipping_cost != 0)
                    <p class="flex justify-between items-center">
                    <div class="p-2 flex items-center modal-location">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>

                        <div class="ml-4">
                            <div class="flex">
                                <p class="flex">Recibelo entre el </p>
                                <p class="ml-1 text-greenLime-600">
                                    {{ Date::now()->addDay($days_received)->locale('es')->format('j') }} </p>
                                <p class="ml-1">y el </p>
                                <p class="ml-1 text-greenLime-600">
                                    {{ Date::now()->addDay($days_received + $days_late)->locale('es')->format('j') }}
                                </p>
                                <p class="ml-1">de </p>
                                <p class="ml-1 text-greenLime-600">
                                    {{ Date::now()->addDay($days_received + $days_late)->locale('es')->format('F') }}
                                </p>
                            </div>
                        </div>

                    </div>
                    </p>
                @endif

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type == 1 || $shipping_cost == 0)
                        {{ $money }} {{ Cart::subtotal() }}
                    @else
                        {{ $money }}
                        {{ (float) filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) +$shipping_cost }}
                    @endif
                </p>
            </div>

            <div class="hidden md:block text-center">
                <x-button_access style="background: #f97316" wire:loading.attr="disabled" wire:target="create_order"
                    class="mt-6 mb-4  px-8 py-4  inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                    wire:click="create_order">
                    Continuar con la compra
                </x-button_access>

                <hr>

                <p class="text-sm text-gray-700 mt-2"> Sus datos personales se utilizarán para procesar su pedido
                    respaldar su experiencia en este sitio web y para otros fines descritos en nuestro <a
                        href="{{ route('policy') }}" target="_blank" class="font-semibold text-orange-500">Políticas y
                        privacidad</a></p>

            </div>
        </div>
    </div>
</div>
