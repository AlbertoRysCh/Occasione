<?php
$configs = DB::table('configs')->first();

if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');
} else {
    $money = 'USD';
}

?>

<div class="bg-white rounded-lg shadow-lg mb-6">

    <style>
        .dropdown-location {
            border: none;
            outline: none;
            transition: 0.3s;
        }

        .list-location {
            transform-origin: top;
            transition: 0.3s;
        }

        .list-location.hide {
            display: none !important;
        }

        .newlist {
            transform: scaleY(1);
            width: 250px;
        }

        .calculate-text {
            color: #0a00b3;
            font-weight: 900;
        }

    </style>
    {{-- <div class="p-4 flex items-center">
        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
            <i class="fas fa-truck text-sm text-white"></i>
        </span>
        
        <div class="ml-4"> 
            @if ($shipping_cost == 0)
                <p class="text-lg font-semibold text-greenLime-600">Se hace envíos Gratis</p>
            @else
                <p class="text-lg font-semibold text-greenLime-600">Envio {{$money}} {{$shipping_cost}}</p>
            @endif
            <p>Recibelo el {{ Date::now()->addDay($days_received + $days_late)->locale('es')->format('l j F') }} en {{$city_name}} - {{$district_name}}</p>
        </div>
    </div> --}}

    <div class="p-4 flex items-center modal-location">
        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
            <i class="fas fa-truck text-sm text-white"></i>
        </span>

        <div class="ml-4">
            <div class="dropdown-location">
                @if ($shipping_cost == 0)
                    <p class="text-lg font-semibold text-greenLime-600">Envío Gratis</p>
                @else
                    <p class="text-lg font-semibold text-greenLime-600">Envío {{ $money }}
                        {{ number_format($shipping_cost, 2) }}</p>
                @endif
                <div class="flex">
                    <p class="flex">Recibelo entre el</p>
                    <p class="ml-1 text-greenLime-600">
                        {{ Date::now()->addDay($days_received)->locale('es')->format('j') }} </p>
                    <p class="ml-1">y el </p>
                    <p class="ml-1 text-greenLime-600">
                        {{ Date::now()->addDay($days_received + $days_late)->locale('es')->format('j') }}</p>
                    <p class="ml-1">de </p>
                    <p class="ml-1 text-greenLime-600">
                        {{ Date::now()->addDay($days_received + $days_late)->locale('es')->format('F') }}</p>
                </div>
                <div class="flex">
                    <p class="ml-1 ">en {{ $city_name }} - {{ $district_name }}</p>
                </div>
                <a class="pr-2 hover:text-blue-600 cursor-pointer calculate-text">Calcular envio en otra dirección</a>
            </div>

        </div>

    </div>


    <div class="list-location hide ml-5 px-4 pb-5 flex items-center modal-location">

        <div class="space-y-3">
            {{-- Departament --}}
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
                <x-jet-label value="Provincia" />

                <select class="form-control w-full" wire:model="city_id">

                    <option value="" disabled selected>Seleccione una Provincia</option>

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

                    <option value="" disabled selected>Seleccione un Distrito</option>

                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="district_id" />
            </div>

            <div class="flex mt-4">
                <x-jet-button wire:loading.attr="disabled" wire:target="update" wire:click="update"
                    class="flex justify-center">
                    Calcular
                </x-jet-button>
            </div>
        </div>


    </div>


    <script>
        let click = document.querySelector('.dropdown-location');

        let list = document.querySelector('.list-location');
        let c = 0;
        click.addEventListener("click", () => {
            if (c == 0) {
                list.classList.remove('hide');
                c++;
            } else {
                list.classList.add('hide');
                c--;
            }
        });

        window.onload = function() {
            Livewire.on('department_event', () => {
                list.classList.remove('hide');
            });
            Livewire.on('city_event', () => {
                list.classList.remove('hide');
            });
            Livewire.on('district_event', () => {
                list.classList.remove('hide');
            });
            Livewire.on('update_event_error', () => {
                list.classList.remove('hide');
            });
            Livewire.on('update_event_ok', () => {
                list.classList.add('hide');
                c--;
            })
        }
    </script>
</div>
