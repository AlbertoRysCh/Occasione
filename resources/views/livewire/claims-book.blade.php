<div>

    <div class="px-4 py-4">
        <div class="col-12">

            <h2 class="clains-h2 px-4">
                Identificación del consumidor reclamante
            </h2>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.name" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Apellidos
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.last_name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.last_name" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Teléfono Celular
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.phone" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.phone" />
                </div>
            </div>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Otro Teléfono (opcional)
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.other_phone" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.other_phone" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Tipo de Dirección
                    </x-jet-label>


                    <select class="w-full form-control" wire:model="createForm.type_direction">
                        <option value="">Seleccione un Tipo de Dirección</option>

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

                    <x-jet-input-error for="createForm.type_direction" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Dirección
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.direction" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.direction" />
                </div>
            </div>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Nro/Lote
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_lote" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_lote" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Depto./Int (opcional)
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_departament" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_departament" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Urbanización (opcional)
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_urbanization" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_urbanization" />
                </div>
            </div>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Referencia (opcional)
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_line2" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_line2" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Departamento
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_region" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_region" />
                </div>
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Provincia
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_municipality" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_municipality" />
                </div>
            </div>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 input-clains">
                    <x-jet-label>
                        Distrito
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.address_city" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.address_city" />
                </div>
            </div>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Tipo de documento
                    </x-jet-label>

                    <select class="w-full form-control" wire:model="createForm.type_document">
                        <option value="" selected>Selecciona el tipo de documento</option>

                        <option value="DNI">DNI</option>
                        <option value="C.E.">C.E.</option>
                        <option value="Pasaporte">Pasaporte</option>

                    </select>

                    <x-jet-input-error for="createForm.type_document" />

                </div>

                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Número de documento
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.claim_document" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.claim_document" />
                </div>


                <div class="col-4 px-3 py-3 inputx-clains ">
                    <x-jet-label>
                        Email
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.email" type="email" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.email" />
                </div>

            </div>

        </div>

        <div class="col-12">
            <h2 class="clains-h2 px-4">
                Identificación del bien contratado
            </h2>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 input-clains">
                    <x-jet-label>
                        Monto del bien objeto de Reclamo
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.product_amount" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.product_amount" />
                </div>

                <div class="col-4 px-3 py-3 input-clains">
                    <x-jet-label>
                        Descripción
                    </x-jet-label>

                    <textarea class="w-full form-control" row md:justify-centers="4"
                        wire:model="createForm.product_description" x-data x-ref="miEditor">
                        </textarea>

                    <x-jet-input-error for="createForm.product_description" />
                </div>
            </div>
        </div>

        <div class="col-12">
            <h2 class="clains-h2 px-4">
                Detalle de la reclamación
            </h2>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 input-clains">
                    <x-jet-label>
                        Número de Pedido (Opcional)
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.num_pedido" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.num_pedido" />
                </div>

                <div class="col-4 px-3 py-3 input-clains">
                    <x-jet-label>
                        Tipo de reclamación
                    </x-jet-label>

                    <select class="w-full form-control" wire:model="createForm.type_reclam">
                        <option value="" selected>Seleccione el tipo de reclamación</option>

                        <option value="Reclamo">Reclamo</option>
                        <option value="Queja">Queja</option>

                    </select>

                    <x-jet-input-error for="createForm.type_reclam" />
                </div>
            </div>

            <div class="row md:justify-center">
                <div class="col-4 px-3 py-3 input-clains">
                    <x-jet-label>
                        Detalle
                    </x-jet-label>

                    <textarea class="w-full form-control" row md:justify-centers="4" wire:model="createForm.detalle"
                        x-data x-ref="miEditor">
                        </textarea>

                    <x-jet-input-error for="createForm.detalle" />
                </div>


            </div>

        </div>



        <div class="flex justify-center mt-4">
            <x-jet-button wire:loading.attr="disabled" wire:target="send_mail" wire:click="send_mail"
                class="flex justify-center btn1 ">
                Enviar
            </x-jet-button>
        </div>
        <section class="modal modal_clains " style=" background-color: rgb(17 17 17 / 40%);">
            <div class="modal__container_clains flex">

                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 171 171"
                    style=" fill:#000000;">
                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                        stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                        font-family="none" font-weight="none" font-size="none" text-anchor="none"
                        style="mix-blend-mode: normal">
                        <path d="M0,171.98863v-171.98863h171.98863v171.98863z" fill="none"></path>
                        <g fill="#2ecc71">
                            <path
                                d="M85.5,30.83093c-30.14409,0 -54.66776,24.57512 -54.66776,54.72256c0,30.14743 24.522,54.71995 54.66776,54.71995h0.00326c30.14409,0 54.66776,-24.57578 54.66776,-54.72321c0,-30.14743 -24.52526,-54.7193 -54.67102,-54.7193zM85.50326,37.53606c26.46425,0 47.98677,21.56622 47.98677,48.03048c0,26.46425 -21.52716,48.02721 -47.98807,48.02721h-0.00196c-26.46091,0 -47.98807,-21.5796 -47.98807,-48.04352c0,-26.46392 21.52708,-48.01417 47.99134,-48.01417zM104.70606,64.62011c-0.88488,-0.01133 -1.73904,0.3242 -2.37964,0.93477l-24.99077,24.07819l-9.58574,-9.22762c-1.32905,-1.27882 -3.44312,-1.23823 -4.7221,0.09067l-7.87472,8.18262c-1.27899,1.32887 -1.23869,3.44293 0.09002,4.72209l19.78205,19.04167c1.29336,1.2455 3.34002,1.2455 4.63338,0l35.18121,-33.90007c0.63792,-0.61466 1.00552,-1.45756 1.02191,-2.34327c0.01639,-0.8857 -0.31976,-1.74164 -0.9345,-2.37948l-7.87799,-8.1774c-0.61457,-0.63798 -1.45742,-1.00567 -2.34311,-1.02218zM104.55603,72.6827l3.24395,3.36724l-30.46107,29.34627l-15.058,-14.4944l3.242,-3.36855l9.49703,9.14152c1.29344,1.24591 3.34059,1.24591 4.63403,0z">
                            </path>
                        </g>
                    </g>
                </svg>


                <p class="modal__paragraph mt-2 -mb-4">Gracias por su Reclamacion Virtual.</p>
            </div>
        </section>

        <script>
            window.onload = function() {

                preloader.style.display = 'none';
                const modal_clains = document.querySelector('.modal_clains');

                // modal_clains.classList.add('modal--show');
                Livewire.on('clains_book_ok', () => {
                    setTimeout(function() {
                        modal_clains.classList.add('modal--show');
                    }, 500);

                    setTimeout(function() {
                        modal_clains.classList.remove('modal--show');
                    }, 3000);

                });

            }
        </script>

    </div>
