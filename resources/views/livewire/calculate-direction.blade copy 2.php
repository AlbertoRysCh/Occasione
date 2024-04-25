

<div class="bg-white rounded-lg shadow-lg mb-6">

    <div class="p-4 flex items-center">
        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
            <i class="fas fa-truck text-sm text-white"></i>
        </span>
        
        <div class="ml-4">
            <p class="text-lg font-semibold text-greenLime-600">Se hace envíos a todo el Perú</p>
            <p>Recibelo el {{ Date::now()->addDay($days_received + $days_late)->locale('es')->format('l j F') }} en {{$city_name}} - {{$district_name}}</p>
        </div>
    </div>

    <div class="p-4 flex items-center">
        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
            <i class="fas fa-store text-sm text-white"></i>
        </span>
        
        <div class="ml-4">
            <div id="dropdown-location">
                <p class="text-lg font-semibold">Recógelo gratis en tienda</p> 
                {{-- <p class="pr-2 hover:text-blue-600 cursor-pointe">Calcular envio en otra dirección</p>  --}}
                <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('')">Calcular envio en otra dirección</a>
            </div>
             
        </div>
    </div> 

    <x-jet-dialog-modal wire:model="editForm.open" class="modal-location">

        <x-slot name="title">
            Calcular envio en otra dirección
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3"> 

                <div>
                    <x-jet-label value="Departamento" />

                    <select class="form-control w-full" wire:model="department_id">

                        <option value="" disabled selected>Seleccione un Departamento</option>

                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
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
                            <option value="{{$city->id}}">{{$city->name}}</option>
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
                            <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="district_id" />
                </div>
  
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update" class="flex justify-center">
                Calcular
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
 
</div> 