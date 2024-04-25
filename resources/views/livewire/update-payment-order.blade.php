<div>
    <div class="grid grid-cols-2 gap-6 text-gray-700">

        <div>
            <p class="text-lg font-semibold uppercase">Envío</p>

            @if ($order->envio_type == 1)
                <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                <p class="text-sm">Calle falsa 123</p>
            @else
                <p class="text-sm">Los productos serán enviados a:</p>
                <p class="text-sm">{{ $envio->address}} {{$envio->address_lot}}</p>
                <p>{{ $envio->department }} - {{ $envio->city }} - {{ $envio->district }}
                </p>
            @endif 
        </div>

        <div>
            <p class="text-lg font-semibold uppercase">Datos de contacto</p>

            <p class="text-sm">Nombre: {{ $order->contact }}</p>
            <p class="text-sm">Teléfono de contacto: + {{ $order->phone }}</p>
        </div>
          
    </div>

        <div class="flex justify-end items-center mt-4">

            <x-jet-action-message class="mr-3" on="saved">
                Actualizado
            </x-jet-action-message>
  
            <x-jet-button class="ml-auto mr-2"
                wire:click="edit({{ $order->id }})"
                wire:target="edit({{ $order->id }})">
                <i class="fas fa-edit text-white"></i> Actualizar
            </x-jet-button>
        </div>

        <x-jet-dialog-modal wire:model="open" wire:key="modal-size-product-{{$order->id}}">

            <x-slot name="title">
                Editar Order
            </x-slot>
    
            <x-slot name="content"> 

                <div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-6 " >

                    <div class="col-span-1"> 
                        <x-jet-label value="Nombre y Apellidos" />
                        <x-jet-input type="text" wire:model.defer="contact" class="w-full" value="{{Auth::user()->name}}"/>
                        <x-jet-input-error for="contact" />
                    </div>
                    <div class="col-span-1"> 
                        <x-jet-label value="Numero de Celular" />
                        <div class="flex justify-center" style="align-items: center"> 
                        <x-jet-input type="text" wire:model.defer="phone" class="w-full"/> 
                        </div> 
                        <x-jet-input-error for="phone" />
                    </div>

                    <div>
                        <x-jet-label value="Tipo de dirección" />

                        <select class="form-control w-full" wire:model="address_type">

                            <option value="" selected >Seleccione una dirección</option>

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
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
    
                <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-jet-button>
            </x-slot>
    
        </x-jet-dialog-modal>
</div>
