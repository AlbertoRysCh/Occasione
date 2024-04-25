
<style>
    .dropdown-location,.links {
  
    border: none;

    outline: none; 

    transition: 0.3s;

}

.list-location {

    position: absolute;

    transform: scaleY(0);

    transform-origin: top;

    transition: 0.3s;

}

.newlist {

    transform: scaleY(1);
    width: 250px;

} 
.modal-location.active{
    padding-bottom: 300px;
}
 
</style>
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

    <div class="p-4 flex items-center modal-location">
        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
            <i class="fas fa-store text-sm text-white"></i>
        </span>
        
        <div class="ml-4">
            <div class="dropdown-location">
                <p class="text-lg font-semibold">Recógelo gratis en tienda</p> 
                {{-- <p class="pr-2 hover:text-blue-600 cursor-pointe">Calcular envio en otra dirección</p>  --}}
                <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('')">Calcular envio en otra dirección</a>
            </div>
            <div class="list-location">
               
                    <div class="space-y-3"> 

                        <div>
                            <x-jet-label value="Departamento" />

                            <select class="form-control w-full" wire:model="editForm.department_id">

                                <option value="" disabled selected>Seleccione un Departamento</option>

                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>

                            <x-jet-input-error for="editForm.department_id" />
                        </div> 

                        {{-- Ciudades --}}
                        <div>
                            <x-jet-label value="Ciudad" />

                            <select class="form-control w-full" wire:model="editForm.city_id">

                                <option value="" disabled selected>Seleccione una ciudad</option>

                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>

                            <x-jet-input-error for="editForm.city_id" />
                        </div>


                        {{-- Distritos --}}
                        <div>
                            <x-jet-label value="Distrito" />

                            <select class="form-control w-full" wire:model="editForm.district_id">

                                <option value="" disabled selected>Seleccione un distrito</option>

                                @foreach ($districts as $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>

                            <x-jet-input-error for="editForm.district_id" />
                        </div>
    
                </div>
             
                <div class="flex mt-4">
                    <x-jet-button
                        wire:loading.attr="disabled"
                        wire:target="update"
                        wire:click="update"
                        class="flex justify-center">
                        Calcular
                    </x-jet-button>
                </div>
             
        </div>
             
        </div>

     
    </div> 
 
 
</div> 

<script>

    let click = document.querySelector('.dropdown-location');

    let list = document.querySelector('.list-location');

    let modal_loc = document.querySelector('.modal-location');
    var c=0;

    click.addEventListener("click",()=>{

        list.classList.toggle('newlist');
        if(c==0){
            modal_loc.classList.add('active');
            c++;
        }else{
            modal_loc.classList.remove('active');
            c--;
        }
    });
</script>