
    <?php
    header('Content-Type: text/html; charset=ISO-8859-1');
?>
<x-admin-layout>
<div class="container py-12">
    <div>      


        <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <h1>Actualizar District</h1>
            <form action="{{route('admin.ubigeo.update_district')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-1 md:gap-6">
                @csrf 
                <div class="col-span-4 sm:col-span-4"> 
                    <div class="col-span-6 sm:col-span-3 py-2">
                        <x-jet-label>
                            Subir su document para actualizar .csv delimitado por comas campos [id,name,cost,cost_international,days_received,days_late]
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