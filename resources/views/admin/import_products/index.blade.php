
    <?php
        header('Content-Type: text/html; charset=ISO-8859-1');
    ?>
    <x-admin-layout>
    <div class="container py-12">
        <div>     
            {{-- Se habilita cuando se haya registrado datos de config la Opcion de IMG--}} 
            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <h1>Insertar productos</h1>
                <form action="{{route('admin.import_products.save')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
                    @csrf 
                    <div class="col-span-4 sm:col-span-4"> 
                        <div class="col-span-6 sm:col-span-3 py-2">
                            <x-jet-label>
                                Subir su document .csv delimitado por comas
                            </x-jet-label>

                            <input  type="file" accept=".csv" class="mt-1" name="file"  >

                            <x-jet-input-error for="file" />
                        </div>  
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-button>
                            Guardar cambio
                        </x-jet-button>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <p>{{Session::get('message')}}</p>
                    </div>
                </form>
            </section> 
    

            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <h1>Actualizar productos</h1>
                <form action="{{route('admin.import_products.update')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
                    @csrf 
                    <div class="col-span-4 sm:col-span-4"> 
                        <div class="col-span-6 sm:col-span-3 py-2">
                            <x-jet-label>
                                Subir su document para actualizar .csv delimitado por comas campos [nombre,Precio Oferta,precio,cantidad,estado de producto(1=Borrador, 2=Publicado 3=Destacado)], tipo de envio [(1=local,2=lacal gratis,3=internacional,4=internacional gratis)]
                            </x-jet-label>

                            <input  type="file" accept=".csv" class="mt-1" name="file"  >

                            <x-jet-input-error for="file" />
                        </div>  
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-button>
                            Actualizar
                        </x-jet-button>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <p>{{Session::get('message_up')}}</p>
                    </div>
                </form>
            </section> 
    

        </div>
    </div>
@push('script')        
 <script> 
 </script>
@endpush
</x-admin-layout>