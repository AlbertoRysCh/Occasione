<?php
$configs = DB::table('configs')->first();
if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');
    $bg = $configs->color_fondo_menu;
    $cl = $configs->color_texto_menu;
    $tm_img = $configs->tam_img;
    $logo_img = $configs->logo;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Lato', sans-serif;
        }

    </style>
    @if ($inBackground)
        <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    @endif
    @if ($configs != null)
        <title>{{ $configs->nombre_empresa }}</title>
    @else
        <title>Ecommerce</title>
    @endif
</head>

<body>
    @unless($inBackground)
        <div class="options">
            <button class="button" onclick="window.print()">Imprimir</button>
            {{-- <a class="button" href="{{ route('invoice.download') }}">Descargar PDF</a> --}}
            {{-- <a class="button" href="{{ route('invoice.send') }}">Enviar a customer@example.test</a> --}}
        </div>
    @endunless

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr
                style="text-align: center;background: <?= $bg ?>;color : <?= $cl ?>; -webkit-print-color-adjust: exact;">
                <td class="w-80">
                    {{-- Using a URL from another domain may not shown the image correctly --}}
                    {{-- <img src="https://via.placeholder.com/400x100?text=Your%20Company%20Logo" style="width: 100%; max-width: 300px"> --}}
                    @if ($inBackground)
                        <!-- Logo -->
                        @if ($configs == null)
                            <picture style="width: 100%; max-width: 300px">
                                <x-jet-application-mark class="block h-9 w-auto" />
                            </picture>
                        @else
                            <img src="{{ Storage::url($logo_img) }}" width="auto" style="height:<?= $tm_img ?>"
                                class="block w-auto">
                        @endif
                    @else
                        <!-- Logo -->
                        @if ($configs == null)
                            <picture style="width: 100%; max-width: 300px">
                                <x-jet-application-mark class="block h-9 w-auto" />
                            </picture>
                        @else
                            <picture style="width: 100%; max-width: 300px">
                                <img src="{{ Storage::url($logo_img) }}" width="auto" style="height:<?= $tm_img ?>"
                                    class="block w-auto">
                            </picture>
                        @endif
                    @endif
                </td>

                <td class="text-center" style="padding: 10px 0;">
                    <div><span class="bold">Fecha</span>:
                        {{ Date::now()->addDay($orders->created_at)->locale('es')->format('d-m-Y') }} </div>
                    <div><span class="bold">Numero de órden: #</span> {{ $orders->id }} </div>
                    {{-- <div>
                        <table class="items-table mt" cellpadding="0" cellspacing="0"> 
                            <thead>
                                <tr class="heading">
                                    <th colspan="1" align="center">
                                        <span class="bold">PAGADO</span>    
                                    </th> 
                                </tr>
                            </thead>
                        </table> 
                    </div> --}}
                </td>
            </tr>
        </table>
        {{-- company information --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0"
            style="width:50%;background:<?= $bg ?>;color:<?= $cl ?>;font-weight: bold;font-size:14px;padding:20px; -webkit-print-color-adjust: exact;"">
            <tr>
                <td>
                    <div>Datos de envio</div>
                    <div>
                                   @if ($envio != null)
            <div>{{ $envio->address }}</div>
            @endif
    </div>
    <div>
        @if ($envio != null)
            <div>{{ $envio->address_type }}</div>
        @endif
    </div>
    <div>
        @if ($orders->envio_type != 1)
            <div> {{ $envio->department }} - {{ $envio->district }} - {{ $envio->city }}</div>
        @endif
    </div>
    </td>

    {{-- <td class="text-center">
                    <div class="bold">EMPRESA</div>
                    <div>{{$configs->nombre_empresa}}</div>
                </td> --}}
    </tr>
    </table>

    <h4>LISTA DE PRODUCTOS</h4>

    <table class="items-table mt" cellpadding="0" cellspacing="0">

        <thead>
            <tr class="heading">
                <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" align="center">#Nombre</th>
                <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" align="center">#Precio</th>
                <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" align="center">#Cantidad</th>
                <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" align="center">#Precio Pagado</th>
            </tr>
        </thead>
        @foreach ($items as $item)
            <tr>
                <td>
                    <div class="flex">
                        <article>
                            <span class="font-bold">{{ $item->name }}</span>
                            <div class="flex text-xs">

                                @isset($item->options->color)
                                    Color: {{ __($item->options->color) }}
                                @endisset

                                @isset($item->options->size)
                                    - {{ $item->options->size }}
                                @endisset
                            </div>
                        </article>
                    </div>
                </td>

                <td class="text-center">
                    {{ $money }} {{ $item->price }}
                </td>

                <td class="text-center">
                    {{ $item->qty }}
                </td>

                <td align="end">
                    <div> {{ $money }} {{ $item->price * $item->qty }} </div>
                </td>
            </tr>
        @endforeach

    </table>

    {{-- company information --}}
    <table class="items-table mt" cellpadding="0" cellspacing="0">
        <tr colspan="4">
            <td class="w-50 text-center" style="font-size: 12px">
                <div style="display:flex;align-items: center;">
                    <img style="height: 70px;width: 70px;" src="{{ asset('img/icon_verified.png') }}" />
                    <p>
                        Compras 100% seguras
                        ¿NO TE CONVENCIÓ? Devuélvelo gratis y sin preguntas
                        ¿TIENES DUDAS? Consulta nuestras preguntas frecuentes en
                        <a style="color:#000;text-decoration:none"
                            href="https://www.occasione.store/pe/sp/preguntas-frecuentesf">https://www.occasione.store/pe/sp/preguntas-frecuentes</a>
                    </p>
                </div>
            </td>
            <td>
                {{-- company information --}}
                <table class="items-table" cellpadding="0" cellspacing="0"
                    style="display: flex;justify-content: end;">
                    <tr>
                        <td class="text-center">
                            <div>Costo de envio : {{ $money }} {{ $orders->shipping_cost }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <div>Total: {{ $money }} {{ $orders->total }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table class="mt">
        <tr>
            <td class="w-100 text-center" style="font-size: 12px">
                ¿Compraste varios productos en la misma orden?, recuerda que los recibirás por separado si eran de
                proveedores diferentes. Para verificar el envío de
                cada producto o si tienes dudas ingresa a "My Ordens"

            </td>
        </tr>
        <tr>
            <td class="w-100 text-center" style="font-size: 12px">
                *Aplican condiciones, para mayor información y verificar que tu producto aplica para devolución,
                visita https://www.occasione.store

            </td>
        </tr>
    </table>
    </div>
</body>

</html>
