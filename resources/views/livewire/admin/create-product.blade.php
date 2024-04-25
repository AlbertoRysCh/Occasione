<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>


    <div class="bg-white rounded-lg shadow" x-data="{ type_product_form: @entangle('type_product_form') }">

        {{-- Link Destino --}}
        <div class="">
            <label class="px-6 py-4 flex items-center cursor-pointer">
                <input x-model="type_product_form" type="radio" value="1" name="type_product_form"
                    class="text-gray-600">
                <div class="mt-4 mb-2 ml-2 w-full" style="border-bottom: 1px solid;padding-bottom: 10px;">
                    <x-jet-label value=" Información del producto *" />
                </div>

            </label>

            <div class="px-6 grid grid-cols-1 gap-6 hidden" :class="{ 'hidden': type_product_form != 1 }">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
                    {{-- Categoría --}}
                    <div>
                        <x-jet-label value="Categorías" />
                        <select class="w-full form-control" wire:model="category_id">
                            <option value="" selected disabled>Seleccione una categoría</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="category_id" />
                    </div>

                    {{-- Subcategoría --}}
                    <div>
                        <x-jet-label value="Subcategorías" />
                        <select class="w-full form-control" wire:model="subcategory_id">
                            <option value="" selected disabled>Seleccione una subcategoría</option>

                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="subcategory_id" />
                    </div>
                </div>

                {{-- Nombre --}}
                <div class="mb-2">
                    <x-jet-label value="Nombre" />
                    <x-jet-input type="text" class="w-full" wire:model="name"
                        placeholder="Ingrese el nombre del producto" />
                    <x-jet-input-error for="name" />
                </div>

                {{-- Slug --}}
                <div class="mb-2">
                    <x-jet-label value="Slug" />
                    <x-jet-input type="text" disabled wire:model="slug" class="w-full bg-gray-200"
                        placeholder="Ingrese el slug del producto" />

                    <x-jet-input-error for="slug" />
                </div>

                {{-- Descrición --}}
                <div class="mb-2">
                    <div wire:ignore>
                        <x-jet-label value="Descripción" />
                        <textarea class="w-full form-control" rows="4" wire:model="description" x-data x-init="ClassicEditor.create($refs.miEditor)
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('description', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );" x-ref="miEditor">
                        </textarea>
                    </div>
                    <x-jet-input-error for="description" />
                </div>

                {{-- Link Youtube --}}
                <div class="mb-2">
                    <x-jet-label value="Link de Youtube" />
                    <x-jet-input wire:model="link_youtube" type="text" class="w-full" />
                    <x-jet-input-error for="link_youtube" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
                    {{-- SUB Precio --}}
                    <div>
                        <x-jet-label value="Precio Rebajado o Oferta" />
                        <x-jet-input wire:model="sub_price" type="number" class="w-full" step=".01" />
                        <x-jet-input-error for="sub_price" />
                    </div>
                    {{-- Precio --}}
                    <div>
                        <x-jet-label value="Precio Normal*" style="font-weight: bold" />
                        <x-jet-input wire:model="price" type="number" class="w-full" step=".01" />
                        <x-jet-input-error for="price" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
                    {{-- Marca --}}
                    <div>
                        <x-jet-label value="Marca" />
                        <select class="form-control w-full" wire:model="brand_id">
                            <option value="" selected disabled>Seleccione una marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="brand_id" />
                    </div>
                </div>

                @if ($subcategory_id)

                    @if (!$this->subcategory->color && !$this->subcategory->size)
                        <div>
                            <x-jet-label value="Cantidad" />
                            <x-jet-input wire:model="quantity" type="number" class="w-full" />
                            <x-jet-input-error for="quantity" />
                        </div>
                    @endif
                @else
                    <div>
                        <x-jet-label value="Cantidad" />
                        <x-jet-input wire:model="quantity" type="number" class="w-full" />
                        <x-jet-input-error for="quantity" />
                    </div>
                @endif

            </div>
        </div>

        {{-- Link Category --}}
        <div class="">
            <label class="px-6 py-4 flex items-center cursor-pointer">
                <input x-model="type_product_form" type="radio" value="2" name="type_product_form"
                    class="text-gray-600">
                <div class="mt-4 mb-2 ml-2 w-full" style="border-bottom: 1px solid;padding-bottom: 10px;">
                    <x-jet-label value=" Especificacion del producto *" />
                </div>

            </label>

            <div class="px-6 grid grid-cols-1 md:grid-cols-2 gap-6 hidden"
                :class="{ 'hidden': type_product_form != 2 }">

                {{-- Material principal --}}
                <div class="mb-2">
                    <x-jet-label value="Modelo" />
                    <x-jet-input type="text" class="w-full" wire:model="modelo" />
                    <x-jet-input-error for="modelo" />
                    <p>Modelo del producto </p>
                    <small> Example: S7, UN46FH5303 (escribe texto y/o número)</small>

                </div>


                {{-- Product Pais --}}
                <div class="mb-2">
                    <x-jet-label value="País de producción" />
                    <select class="w-full form-control" wire:model="production_country">
                        <option value="" selected disabled>Por favor selecciona</option>

                        @foreach ($production_countrys as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="production_country" />
                    <p>País donde fue fabricado el producto</p>
                </div>

                {{-- Filtra por color --}}
                <div class="mb-2">
                    <x-jet-label value="Filtra por color *" style="font-weight: bold" />
                    <select class="w-full form-control" wire:model="filter_color">
                        <option value="" selected disabled>Seleccione un color</option>

                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="filter_color" />
                    <p>Color principal del producto que sirve para filtrar dentro de la página de Occasione</p>
                </div>

                {{-- Material principal --}}
                <div class="mb-2">
                    <x-jet-label value="Material principal" />
                    <x-jet-input type="text" class="w-full" wire:model="main_material" />
                    <x-jet-input-error for="main_material" />
                    <p>Material principal con el que está fabricado el producto</p>
                </div>

                {{-- Genero --}}
                <div class="mb-2">
                    <x-jet-label value="Genero" />
                    <select class="w-full form-control" wire:model="gender">
                        <option value="" selected disabled>Seleccione un genero</option>

                        @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="gender" />
                    <p>Genero para el cual es recomendado el producto</p>
                </div>

                {{-- Forma de la Caja --}}
                <div class="mb-2">
                    <x-jet-label value="Forma de la Caja" />
                    <select class="w-full form-control" wire:model="box_shape">
                        <option value="" selected disabled>Por favor selecciona</option>

                        @foreach ($box_shapes as $box_shape)
                            <option value="{{ $box_shape->id }}">{{ $box_shape->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="box_shape" />
                    <p>Forma geometrica de la caja del reloj</p>
                </div>

                {{-- Material de Correa --}}
                <div class="mb-2">
                    <x-jet-label value="Material de Correa" />
                    <select class="w-full form-control" wire:model="belt_material">
                        <option value="" selected disabled>Por favor selecciona</option>

                        @foreach ($belt_materials as $belt_material)
                            <option value="{{ $belt_material->id }}">{{ $belt_material->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="belt_material" />
                    <p>Material con el que está fabricada la correa del reloj</p>
                </div>

                {{-- Tipo de reloj --}}
                <div class="mb-2">
                    <x-jet-label value="Tipo de reloj" />
                    <select class="w-full form-control" wire:model="type_reloj">
                        <option value="" selected disabled>Por favor selecciona</option>

                        @foreach ($type_relojs as $type_reloj)
                            <option value="{{ $type_reloj->id }}">{{ $type_reloj->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="type_reloj" />
                    <p>Tipo de funcionamiento del reloj </p>
                </div>

                {{-- ¿Tiene Calendario? --}}
                <div class="mb-2">
                    <x-jet-label value="¿Tiene Calendario?" />
                    <select class="w-full form-control" wire:model="calendar">
                        <option value="" selected>Por favor selecciona</option>

                        @foreach ($calendars as $calendar)
                            <option value="{{ $calendar->id }}">{{ $calendar->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="calendar" />
                    <p>Tipo de funcionamiento del reloj </p>
                </div>

            </div>
        </div>

        {{-- Link Product --}}
        <div class="">
            <label class="px-6 py-4 flex items-center cursor-pointer">
                <input x-model="type_product_form" type="radio" value="3" name="type_product_form"
                    class="text-gray-600">
                <div class="mt-4 mb-2 ml-2 w-full" style="border-bottom: 1px solid;padding-bottom: 10px;">
                    <x-jet-label value=" Garantia y Envio *" />
                </div>

            </label>

            <div class="px-6 grid grid-cols-1 md:grid-cols-2 gap-6 hidden"
                :class="{ 'hidden': type_product_form != 3 }">

                {{-- Condicion del producto --}}
                <div class="mb-2">
                    <x-jet-label value="Condicion del producto *" style="font-weight: bold" />
                    <select class="w-full form-control" wire:model="condition_type">
                        <option value="" selected>Por favor selecciona</option>

                        @foreach ($condition_types as $condition_type)
                            <option value="{{ $condition_type->id }}">{{ $condition_type->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="condition_type" />
                    <p>Condición fisica del producto</p>
                </div>

                {{-- Recibo de compra --}}
                <div class="mb-2">
                    <x-jet-label value="Recibo de compra " />
                    <select class="w-full form-control" wire:model="invoice">
                        <option value="" selected>Por favor selecciona</option>

                        @foreach ($invoices as $invoice)
                            <option value="{{ $invoice->id }}">{{ $invoice->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="invoice" />
                    <p>Selecciona el tipo de comprobante de compra</p>
                </div>

                {{-- Detalles de la condicion fisica del producto --}}
                <div class="mb-2">
                    <x-jet-label value="Detalles de la condicion fisica del producto" />
                    <x-jet-input type="text" class="w-full" wire:model="condition_type_note" />
                    <x-jet-input-error for="condition_type_note" />
                    <p>Informacion a detalle por paarte de sellter de occasione de la condicion de fisica del producto
                    </p>
                </div>

                {{-- Garantia --}}
                <div class="mb-2">
                    <div wire:ignore>
                        <x-jet-label value="Garantia" />
                        <textarea class="w-full form-control" rows="4" wire:model="other_details_warranty" x-data x-init="ClassicEditor.create($refs.miEditor)
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('other_details_warranty', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );" x-ref="miEditor">
                        </textarea>
                    </div>
                    <x-jet-input-error for="other_details_warranty" />
                    <p>Describe el tiempo y condiciones de la garantia con la que cuenta tu producto </p>
                </div>

                {{-- Altura del paquete (cm) --}}
                <div class="mb-2">
                    <x-jet-label value="Altura del paquete (cm) *" style="font-weight: bold" />
                    <x-jet-input type="text" class="w-full" wire:model="package_height" />
                    <x-jet-input-error for="package_height" />
                    <p>Altura del paquete en centimetros</p>
                </div>

                {{-- Ancho del paquete (cm) --}}
                <div class="mb-2">
                    <x-jet-label value="Ancho del paquete (cm) *" style="font-weight: bold" />
                    <x-jet-input type="text" class="w-full" wire:model="package_width" />
                    <x-jet-input-error for="package_width" />
                    <p>Ancho del paquete en centrimetros</p>
                </div>

                {{-- Largo del paquete (cm) --}}
                <div class="mb-2">
                    <x-jet-label value="Largo del paquete (cm) *" style="font-weight: bold" />
                    <x-jet-input type="text" class="w-full" wire:model="package_length" />
                    <x-jet-input-error for="package_length" />
                    <p>Largo del paquete en centrimetros</p>
                </div>

                {{-- Peso del paquete (Kg) --}}
                <div class="mb-2">
                    <x-jet-label value="Peso del paquete (Kg) *" style="font-weight: bold" />
                    <x-jet-input type="text" class="w-full" wire:model="package_weight" />
                    <x-jet-input-error for="package_weight" />
                    <p>Peso del paquete en kilogramos</p>
                </div>

                {{-- ¿Que hay en la caja? --}}
                <div class="mb-2">
                    <div wire:ignore>
                        <x-jet-label value="¿Que hay en la caja?" />
                        <textarea class="w-full form-control" rows="4" wire:model="other_details_content" x-data x-init="ClassicEditor.create($refs.miEditor)
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('other_details_content', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );" x-ref="miEditor">
                        </textarea>
                    </div>
                    <x-jet-input-error for="other_details_content" />
                    <p>Todos los elementos que tiene incluido el paquete, esto incluye manuales, cables, fundas, etc.
                    </p>

                </div>

            </div>
        </div>

    </div>


    <div class="flex mt-4">
        <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="ml-auto">
            Siguiente >
        </x-jet-button>
    </div>

</div>
