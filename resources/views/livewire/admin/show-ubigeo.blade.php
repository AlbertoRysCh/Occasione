<?php 
  $configs = DB::table('configs')
   ->first(); 
   if($configs != null) {

    $money =  DB::table('locations')->where([
            ['id', '=', $configs->location_id],
            ])->value('money');
   }else{
       $money = "";
   }
?>

<div>
  
     <x-slot name="header">
       
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    Lista de ubigeos
                </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-button-enlace class="ml-auto" href="{{route('export-excel-csv')}}">
                  Export District
                </x-button-enlace>
                <x-button-enlace class="ml-4" href="{{route('admin.ubigeo.update')}}">
                   Update District
                </x-button-enlace>
            </div>
            
        </div> 
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12">

        <x-table-responsive>

            <div class="px-6 py-4">

                <x-jet-input type="text" 
                    wire:model="search" 
                    class="w-full"
                    placeholder="Ingrese el nombre del procucto que quiere buscar" />

            </div>

            @if ($ubigeos->count())
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Departamento
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cities
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Districts
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Costo {{$money}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Costo International {{$money}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Days resaive
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Days late
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($ubigeos as $ubigeo)

                            <tr>
                                {{-- <td class="px-2 py-4"> --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                   
                                        <div class="text-sm text-gray-900">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $ubigeo->nameDep }} 
                                            </div>
                                        </div> 
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm text-gray-900">
                                        {{ $ubigeo->nameCity }} 
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm text-gray-900">
                                        {{ $ubigeo->nameDist }} 
                                    </div>

                                </td>
                                 
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$ubigeo->dCost}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$ubigeo->dCostI}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$ubigeo->dDayR}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$ubigeo->dDayL}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$ubigeo->idDep}}','{{$ubigeo->idCity}}','{{$ubigeo->idDist}}')">Editar</a>
                                </td>
                            </tr>

                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>

            @else
                <div class="px-6 py-4">
                    No hay ningún registro coincidente
                </div>
            @endif

            @if ($ubigeos->hasPages())
                
                <div class="px-6 py-4">
                    {{ $ubigeos->links() }}
                </div>
                
            @endif
                

        </x-table-responsive>
    </div>

    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Ubigeo
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">
                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div>
                        <x-jet-label>
                            Departament
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.nameDep" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.nameDep" />
                    </div>
                    <div>
                        <x-jet-label>
                            City
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.nameCity" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.nameCity" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div>
                        <x-jet-label>
                            District
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.nameDist" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.nameDist" />
                    </div>
                        
                </div>
                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div>
                        <x-jet-label>
                            Costo
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.cost" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.cost" />
                    </div> 
                    <div>
                        <x-jet-label>
                            Cost International
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.costInternational" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.costInternational" />
                    </div>
                    
                </div>
                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div>
                        <x-jet-label>
                            Days Received
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.daysReceive" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.daysReceive" />
                    </div> 
            
                    <div>
                        <x-jet-label>
                            Days Late
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.daysLate" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.daysLate" />
                    </div>
                    
                </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

</div>
