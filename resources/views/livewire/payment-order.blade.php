<?php
$configs = DB::table('configs')->first();
if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');
}
?>

<div>
    @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        
        $shipments = new MercadoPago\Shipments();
        
        $shipments->cost = $order->shipping_cost;
        $shipments->mode = 'not_specified';
        
        $preference->shipments = $shipments;
        
        // Crea un ítem en la preferencia
  
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;
        
            $products[] = $item;
        }
        $preference->payment_methods = [
    'excluded_payment_methods' => [],
    'excluded_payment_types' => []
];
        
        $preference->back_urls = [
            'success' => route('orders.pay', $order),
            'failure' => 'http://occasione.store/failure',
            'pending' => 'http://occasione.store/pending',
        ];
        $preference->auto_return = 'approved';
        
        $preference->items = $products;
        $preference->save();
    @endphp

    <x-pay-front />

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">

        <div class="col-span-3 md:col-span-5">
            <x-status-pay-orden :status="1" />
        </div>

        <div class="order-1 col-span-3 lg:order-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span>
                    Orden-{{ $order->id }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">


                @livewire('update-payment-order', ['order' => $order])


            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                <p class="text-xl font-semibold mb-4">Resumen</p>
                @foreach ($items as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <div class="flex items-center">
                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        </div>
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>

                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                            </div>
                            <div class="flex">
                                @isset($item->options->color)
                                    Color: {{ __($item->options->color) }}
                                @endisset

                                @isset($item->options->size)
                                    - {{ $item->options->size }}
                                @endisset

                            </div>
                            <div class="block">
                                @if (isset($item->sub_price) && $item->sub_price != null && $item->sub_price != 0.0)
                                    <div class="flex">
                                        <p class="text-s"
                                            style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">
                                            {{ $money }} {{ number_format($item->sub_price, 2) }}</p>

                                        <small class="ml-2">-{{ $item->porcentaje }}%</small>
                                    </div>
                                    <p class="text-op">{{ $money }}
                                        {{ number_format($item->price, 2) }} </p>
                                @else
                                    <p class="text-op">{{ $money }}
                                        {{ number_format($item->price, 2) }} </p>
                                @endif

                            </div>

                        </article>
                    </li>
                @endforeach

            </div>


        </div>

        <div class="order-1 col-span-3 md:col-span-3 lg:order-2 xl:col-span-2">
            {{-- ///INCIO --}}
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6 pb-4">
                <!--Inicio seccion Cupón-->
                @if (!$couponApplied)
                        <form wire:submit.prevent="applyCoupon">
                            <div style="padding-bottom: 20px;">
                                <label for="coupon_code">Código de cupón:</label>
                                <input class="shadow appearance-none border border-gray-300 rounded w-4/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="coupon_code" wire:model="coupon_code">
                                <button class="bg-blue-500 hover:bg-blue-700 w-4/12 text-white font-bold py-2 px-4 rounded" type="submit">Aplicar cupón</button>
                            </div>
                        </form>
                    @endif
                    @if ($coupon_applied)
                        <div>
                            Cupón aplicado: {{ $coupon_applied }}
                            <button wire:click="removeCoupon" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Quitar cupón</button>
                        </div>
                    @endif
                    @if (session()->has('message'))
                    <div style="color: #4bff01;font-weight: 700;">{{ session('message') }}</div>
                    @endif

                <!--Fin seccion Cupón-->
                <hr>
                <div class="flex justify-between items-center mt-4 mb-4">

                    <img class="h-8" src="{{ asset('img/MC_VI_DI_2-1.jpg') }}" alt="">

                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: {{ $money }} {{ $order->total - $order->shipping_cost }}
                        </p>

                        <p class="text-sm font-semibold">
                            Envío: {{ $money }} {{ $order->shipping_cost }}
                        </p>

                        <p class="text-lg font-semibold uppercase">
                            Total: {{ $money }} {{ $order->total }}
                        </p>

                    </div>
                </div>

                <div id="paypal-button-container"></div>

                <h1 class="font-bold">Método de Pago</h1>

                <div class="accordion">

                    @if ($mercado_pago == '1')
                        <div class="accordion-item" id="q_mercado">
                            <a class="accordion-link">
                                <i class="far fa-circle"></i>
                                <i class="fas fa-circle"></i>
                                <h1 class="font-bold">Pagar con Mercado Pago</h1>
                                <div class="flex w-full">
                                    <img class="mr-4 ml-4" src="{{ asset('img/mercadopago.png') }}" />
                                </div>
                            </a>

                        </div>
                    @endif

                    @if ($contratega == '1')
                        <div class="accordion-item" id="q_entrega">
                            <a class="accordion-link">
                                <i class="far fa-circle"></i>
                                <i class="fas fa-circle"></i>
                                <h1 class="font-bold">Pago contratega</h1>
                            </a>
                        </div>
                    @endif



                    @if ($mercado_pago == '1')
                        <div class="answer card_active" id="pay_mercado">
                            <p>
                            <div class="cho-container p_mercado_pago "></div>
                            </p>
                        </div>
                    @endif

                    @if ($contratega == '1')
                        @livewire('payment-contract', ['order' => $order])
                    @endif

                    @if ($stripe == '1')
                        <div class="answer card_active" id="pay_card">
                            <p class="p_card">

                                @livewire('product-pay', ['order' => $order])
                            </p>
                        </div>
                    @endif
                    

                    <p class="text-sm text-gray-700 mt-2"> Sus datos personales se utilizarán para procesar su pedido
                        respaldar su experiencia en este sitio web y para otros fines descritos en nuestras <a
                            href="{{ route('policy') }}" target="_blank"
                            class="font-semibold text-orange-500">Políticas y privacidad</a></p>


                </div>
            </div>




            {{-- @if ($stripe == '2') --}}
            {{-- @endif --}}

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


                    <p class="modal__paragraph mt-2 -mb-4">Hubo un error al realizar la compra</p>
                </div>
            </section>
            <section class="modal modal_update_order " style=" background-color: rgb(17 17 17 / 40%);">
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


                    <p class="modal__paragraph mt-2 -mb-4">Se actualizo los datos</p>
                </div>
            </section>

        </div>

    </div>

    @push('script')

        <script>
         document.addEventListener('DOMContentLoaded', function() {
            const id_mercado_pago = document.getElementById('q_mercado');
            const id_pago_entrega = document.getElementById('q_entrega');
            const id_pago_card = document.getElementById('q_card');

            id_mercado_pago.addEventListener('click', (e) => {
                e.preventDefault();
                if ("<?php echo $mercado_pago; ?>" == '1') {
                    document.getElementById('q_mercado').classList.add("active");
                    document.getElementById('pay_mercado').classList.add("pay_mercado");
                }
                if ("<?= $contratega ?>" == '1') {
                    document.getElementById('q_entrega').classList.remove("active");
                    document.getElementById('pay_entrega').classList.remove("pay_entrega");
                }
                if ("<?= $stripe ?>" == '1') {
                    document.getElementById('q_card').classList.remove("active");
                    document.getElementById('pay_card').classList.remove("pay_card");
                }

            });
            id_pago_entrega.addEventListener('click', (e) => {
                e.preventDefault();
                if ("<?php echo $mercado_pago; ?>" == '1') {
                    document.getElementById('q_mercado').classList.remove("active");
                    document.getElementById('pay_mercado').classList.remove("pay_mercado");
                }
                if ("<?= $contratega ?>" == '1') {
                    document.getElementById('q_entrega').classList.add("active");
                    document.getElementById('pay_entrega').classList.add("pay_entrega");
                }
                if ("<?= $stripe ?>" == '1') {
                    document.getElementById('q_card').classList.remove("active");
                    document.getElementById('pay_card').classList.remove("pay_card");
                }


            });
            if (id_pago_card && "<?php echo $stripe; ?>" == '1') {
                id_pago_card.addEventListener('click', (e) => {
                    e.preventDefault();
                    if ("<?php echo $mercado_pago; ?>" == '1') {
                        document.getElementById('q_mercado').classList.remove("active");
                        document.getElementById('pay_mercado').classList.remove("pay_mercado");
                    }
                    if ("<?= $contratega ?>" == '1') {
                        document.getElementById('q_entrega').classList.remove("active");
                        document.getElementById('pay_entrega').classList.remove("pay_entrega");
                    }
                    if ("<?= $stripe ?>" == '1') {
                        document.getElementById('q_card').classList.add("active");
                        document.getElementById('pay_card').classList.add("pay_card");
                    }
                });
            }
         });
        </script>

        <script>
            window.onload = function() {

                preloader.style.display = 'none';
                const modal_clains = document.querySelector('.modal_clains');
                const modal_update_order = document.querySelector('.modal_update_order');

                // modal_clains.classList.add('modal--show');
                Livewire.on('cart_item_stock', () => {
                    setTimeout(function() {
                        modal_clains.classList.add('modal--show');
                    }, 500);

                    setTimeout(function() {
                        modal_clains.classList.remove('modal--show');
                    }, 3000);

                });

                Livewire.on('cart_up_order', () => {
                    setTimeout(function() {
                        modal_update_order.classList.add('modal--show');
                    }, 500);

                    setTimeout(function() {
                        modal_update_order.classList.remove('modal--show');
                    }, 3000);

                    // return   Livewire.emit('payUpOrder');
                    setTimeout(function() {
                        window.location.href = "{{ route('orders.payment', $order) }}";
                    }, 3000);

                });

            }
        </script>

        @if ($mercado_pago == '1')
            <script src="https://sdk.mercadopago.com/js/v2"></script>

            <script>
                const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
                    locale: 'es-PE'
                });

                const checkout = mp.checkout({
                    preference: {
                        id: '{{ $preference->id }}'
                    },
                    render: {
                        container: '.cho-container',
                        label: 'Pagar',
                    }
                });


                // function mercadoPagos(){  
                // // Invocando la función posteriormente
                //     checkout.render({
                //     container: ".cho-container",
                //     label: "Pagar",
                //     });
                // }
            </script>
        @endif


        @if ($paypal == '1')
            <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}">
                // Replace YOUR_CLIENT_ID with your sandbox client ID
            </script>

            <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: "{{ $order->total }}"
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {

                            Livewire.emit('payOrder');

                            /* console.log(details);

                            alert('Transaction completed by ' + details.payer.name.given_name); */
                        });
                    }
                }).render('#paypal-button-container'); // Display payment options on your web page
            </script>
        @endif
    @endpush
</div>
