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

                    @if (!$inBackground)
                        @if ($configs == null)
                            <picture style="width: 100%; max-width: 300px">
                                <x-jet-application-mark class="block h-9 w-auto" />
                            </picture>
                        @else
                            <picture style="width: 100%; max-width: 300px">
                                <img src="{{ Storage::url($logo_img) }}" style="height:<?= $tm_img ?>"
                                    class="block w-auto">
                            </picture>
                        @endif
                    @endif
                </td>

                <td class="text-center" style="padding: 10px 0;">
                    <div><span class="bold">ORDEN</span>: #0{{ $order->id }}</div>
                    <div><span class="bold">ESTADO DE PAGO</span> </div>

                    <div style="border-top: 1px solid;margin-top: 10px">
                        <span class="bold ">PAGADO</span>
                    </div>
                </td>
            </tr>
        </table>
        {{-- company product information --}}
        {{-- <table class="items-table mt" cellpadding="0" cellspacing="0"> 
          
            <tr>
                <td>
                    <div></div> 
                </td>
                <td>
                    <div></div> 
                </td>
                <td class="text-center">
                    <div class="bold">PAGADO</div>
                </td>
            </tr>
        </table> --}}

        {{-- company information --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th colspan="2" style="background: #cccccc;  -webkit-print-color-adjust: exact;" align="center">TIPO
                        ENVÍO: REGULAR</th>
                </tr>
                <tr class="heading">
                    <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" colspan="2"
                        class="pt-2" align="center">REMITENTE</th>
                </tr>
            </thead>
            <tr>
                <td>
                    <div>{{ Auth::user()->name }}</div>
                    <div>{{ $configs->ubicacion }}</div>
                    <div>Phone: {{ $configs->telefono }}</div>
                    <div>LIMA - LIMA - LIMA</div>
                </td>

                <td class="text-center">
                    <div class="bold">EMPRESA</div>
                    <div>{{ $configs->nombre_empresa }}</div>
                </td>
            </tr>
        </table>

        {{-- cliente information --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" colspan="4" align="center">
                        DESTINATARIO</th>
                </tr>
            </thead>
            <tr>
                <td>
                    <span class="bold">Cliente</span>
                </td>
                <td>
                    <div>{{ $order->contact }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Tipo de residencia</span>
                </td>
                <td>
                    @if ($envio != null)
                        <div>{{ $envio->address_type }}</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Dirección</span>
                </td>
                <td>
                    @if ($envio != null)
                        <div>{{ $envio->address }}</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Nro. / Lote</span>
                </td>
                <td>
                    @if ($envio != null)
                        <div>{{ $envio->address_lot }}</div>
                    @endif
                </td>

                <td>
                    <span class="bold">Depto./Int</span>
                </td>
                <td>
                    @if ($envio != null)
                        <div>{{ $envio->address_department }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="bold">Urbanización</span>
                </td>
                <td>
                    @if ($envio != null)
                        <div>{{ $envio->address_urbanization }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="bold">Distrito</span>
                </td>
                <td>
                    @if ($order->envio_type != 1)
                        <div>{{ $envio->district }}</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Provincia</span>
                </td>
                <td>
                    @if ($order->envio_type != 1)
                        <div> {{ $envio->department }} - {{ $envio->city }} </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Telefono</span>
                </td>
                <td>
                    <div> {{ $order->phone }} </div>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Referencia</span>
                </td>
                <td>
                    @if ($envio != null)
                        <div>{{ $envio->references }}</div>
                    @endif
                </td>
            </tr>
        </table>

        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th style="background: #cccccc;  -webkit-print-color-adjust: exact;" colspan="5" align="center">
                        DETALLE ORDEN</th>
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
            <tr>
                <td>
                    <span class="bold">Costo de envio</span>
                </td>
                <td> </td>
                <td> </td>
                <td align="end">
                    <div> {{ $money }} {{ $order->shipping_cost }} </div>
                </td>
            </tr>
            <tr class="total">
                <td colspan="5">Total: {{ $money }} {{ $order->total }}</td>
            </tr>
        </table>




        <table class="mt">
            <tr>
                <td class="w-50">
                    {{-- <img src="data:image/png;base64, {{ $qrCode }}" style="width: 3.5cm;"> --}}
                </td>

                <td class="w-50 text-center">
                    {{-- Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Nulla assumenda minus eligendi saepe quae omnis
                    itaque doloremque doloribus esse at sit
                    aliquid quaerat. --}}
                </td>
            </tr>
        </table>
    </div>


</body>

</html>
