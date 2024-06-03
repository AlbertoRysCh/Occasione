<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Cupones
            </h2>
 
        </div>
    </x-slot>
    <div class="container py-1">
        <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Crear Cupón</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Procura mantener los códigos siempre con mayusculas</p>
      
            <form wire:submit.prevent="save" class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-7" x-show="!editing">
              <div class="sm:col-span-1">
                <label for="codigo" class="block text-sm font-medium leading-6 text-gray-900">Código</label>
                <div class="mt-2">
                  <input type="text" name="codigo" id="codigo" wire:model="code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" oninput="this.value = this.value.toUpperCase();" style="text-transform: uppercase;" autocomplete="off">
                  @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
              </div>
      
              <div class="sm:col-span-1 ">
                <label for="descuento" class="block text-sm font-medium leading-6 text-gray-900">Descuento</label>
                <div class="mt-2 flex items-center">
                        <input type="text" name="descuento" id="descuento" wire:model="discount"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" autocomplete="off"><span class="ml-2">%</span>
                        @error('discount') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="sm:col-span-1">
                <label for="date-ini" class="block text-sm font-medium leading-6 text-gray-900">Fecha de inicio</label>
                <div class="mt-2">
                  <input type="date" name="date-ini" id="date-ini" wire:model="start_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="sm:col-span-1">
                <label for="date-fin" class="block text-sm font-medium leading-6 text-gray-900">Fecha finalizado</label>
                <div class="mt-2">
                  <input type="date" name="date-fin" id="date-fin" wire:model="end_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="sm:col-span-1">
                <label for="use" class="block text-sm font-medium leading-6 text-gray-900">Usos</label>
                <div class="mt-2">
                  <input type="text" name="use" id="use" wire:model="usage_limit" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" autocomplete="off">
                  @error('usage_limit') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="sm:col-span-2 flex items-end">
                <button type="submit" class="inline-flex items-center px-4 py-2  mt-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition">
                    Guardar cambio
                </button>
              </div>
            </form>
        </div>
        </section>
    </div>

    <div class="container pt-1 pb-12">
        <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            # Orden
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Codigo de Cupón
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descuento
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha de Inicio
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha Final
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Limite de Uso
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <span class="accion">Accion</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($coupons as $coupon)
                    <tr >
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-900  text-center" >
                                {{ $coupon->id }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 text-center">
                                {{ $coupon->code }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 text-center">
                                {{ $coupon->discount }}%
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 text-center">
                                {{ \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 text-center">
                                {{ \Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 text-center">
                                {{ $coupon->usage_limit }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-4 justify-center text-sm text-gray-900 text-center">
                                <button wire:click="deleteCoupon({{ $coupon->id }})" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                                <!--<button type="button" wire:click="editCoupon({{ $coupon->id }})" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-1.5 me-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Editar</button>-->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
</div>
<!-- Modal 
<div x-data="{ showModal: false }">
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-semibold mb-4">Editar Cupón</h2>
            <form wire:submit.prevent="updateCoupon">
                <input type="hidden" wire:model="couponId"> 
                <div class="mb-4">
                    <label for="editCode" class="block text-gray-700">Código</label>
                    <input type="text" id="editCode" wire:model="code" class="w-full border rounded px-3 py-2">
                    @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="editDiscount" class="block text-gray-700">Descuento</label>
                    <input type="text" id="editDiscount" wire:model="discount" class="w-full border rounded px-3 py-2">
                    @error('discount') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="editStartDate" class="block text-gray-700">Fecha de Inicio</label>
                    <input type="date" id="editStartDate" wire:model="start_date" class="w-full border rounded px-3 py-2">
                    @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="editEndDate" class="block text-gray-700">Fecha Final</label>
                    <input type="date" id="editEndDate" wire:model="end_date" class="w-full border rounded px-3 py-2">
                    @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="editUsageLimit" class="block text-gray-700">Límite de Uso</label>
                    <input type="text" id="editUsageLimit" wire:model="usage_limit" class="w-full border rounded px-3 py-2">
                    @error('usage_limit') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="showModal = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
Fin Modal -->
<script>
    var currentDate = new Date().toISOString().split('T')[0];
    document.getElementById('date-ini').setAttribute('min', currentDate);
    document.getElementById('date-fin').setAttribute('min', currentDate);

    /*document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('showEditModal', () => {
            document.querySelector('[x-data="{ showModal: false }"]').__x.$data.showModal = true;
        });
    });*/
</script>