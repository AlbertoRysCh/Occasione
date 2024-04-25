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
    $support = $configs->correo;
    $phone_emp = $configs->telefono;
    $name_emp = $configs->nombre_empresa;
    $place_emp = $configs->ubicacion;
    //REDES
    $facebook = $configs->facebook;
    $instagram = $configs->instagram;
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>

</head>

<body>
    <div class="es-wrapper-color">

        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-synchronizable-module" align="center">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                            width="600" style="background-color: transparent;"
                                            bgcolor="rgba(0, 0, 0, 0)">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame"
                                                                        align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-infoblock">
                                                                                        <p><a></a></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-header" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="es-m-p0r esd-container-frame"
                                                                        valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-image es-p10b"
                                                                                        style="font-size: 0px;background: <?= $bg ?>;">
                                                                                        <a href="https://occasione.store/"
                                                                                            target="_blank">
                                                                                            {{-- <img src="https://taxemy.stripocdn.email/content/guids/CABINET_887f48b6a2f22ad4fb67bc2a58c0956b/images/93351617889024778.png"
                                                                                                alt="Logo"
                                                                                                style="display: block; font-size: 12px;"
                                                                                                width="200"
                                                                                                title="Logo"> --}}
                                                                                            @if ($configs)
                                                                                                {{-- <img src="{{ Storage::url($configs->logo) }}"
                                                                                                    alt="Logo"
                                                                                                    
                                                                                                    width="auto"
                                                                                                    title="Logo"> --}}
                                                                                                <img src="https://i.ibb.co/7SfFf4S/1643412172.png"
                                                                                                    alt="Logo"
                                                                                                    style="padding: 10px 0;display: block; font-size: 12px;height:<?= $tm_img ?>;"
                                                                                                    width="auto"
                                                                                                    title="Logo">
                                                                                            @endif
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p15t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame"
                                                                        align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-image es-p10t es-p10b"
                                                                                        style="font-size: 0px;"><a
                                                                                            target="_blank"><img
                                                                                                src="https://taxemy.stripocdn.email/content/guids/CABINET_c0e87147643dfd412738cb6184109942/images/151618429860259.png"
                                                                                                alt
                                                                                                style="margin-top:20px;display: block;"
                                                                                                width="100"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p10b es-m-txt-c">
                                                                                        <h1
                                                                                            style="font-size: 46px; line-height: 100%;">
                                                                                            ¡Gracias por elegirnos!
                                                                                        </h1>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p10b es-p20r es-p20l"
                                                        align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame"
                                                                        align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p5t es-p5b es-p40r es-p40l es-m-p0r es-m-p0l">
                                                                                        <p>¡Su pedido ya se ha
                                                                                            completado!
                                                                                            Adjuntamos su recibo
                                                                                            <strong>recibo </strong> a
                                                                                            este correo electrónico.
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-button es-p10t es-p10b">
                                                                                        <span
                                                                                            class="es-button-border"><a
                                                                                                href="{{ route('orders.show', $order) }}"
                                                                                                class="es-button"
                                                                                                style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;border-style:solid;border-color:#5C68E2;border-width:10px 30px 10px 30px;display:inline-block;background:#5C68E2;border-radius:5px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center"
                                                                                                target="_blank">MI
                                                                                                ORDEN</a></span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p10t es-p10b es-p20r es-p20l esdev-adapt-off"
                                                        align="left">
                                                        <table width="560" cellpadding="0" cellspacing="0"
                                                            class="esdev-mso-table">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="70"
                                                                                        class="es-m-p0r esd-container-frame"
                                                                                        align="center">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        class="esd-block-image"
                                                                                                        style="font-size: 0px;">
                                                                                                        <p><strong>Imagen</strong>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="265"
                                                                                        class="esd-container-frame"
                                                                                        align="center">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="left"
                                                                                                        class="esd-block-text">
                                                                                                        <p><strong>Nombre</strong>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>

                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="80" align="left"
                                                                                        class="esd-container-frame">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        class="esd-block-text">
                                                                                                        <p>Precio</p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="80" align="left"
                                                                                        class="esd-container-frame">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        class="esd-block-text">
                                                                                                        <p>Cantidad</p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-right" align="right">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="85" align="left"
                                                                                        class="esd-container-frame">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text">
                                                                                                        <p>Total</p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                @foreach ($item_p as $item)
                                                    <tr>
                                                        <td class="esd-structure es-p10t es-p10b es-p20r es-p20l esdev-adapt-off"
                                                            align="left">
                                                            <table width="560" cellpadding="0" cellspacing="0"
                                                                class="esdev-mso-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esdev-mso-td" valign="top">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                class="es-left" align="left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="70"
                                                                                            class="es-m-p0r esd-container-frame"
                                                                                            align="center">
                                                                                            <table cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                width="100%">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center"
                                                                                                            class="esd-block-image"
                                                                                                            style="font-size: 0px;">
                                                                                                            <a><img class="adapt-img"
                                                                                                                    src="{{ $item->options->image }}"
                                                                                                                    alt
                                                                                                                    style="display: block;"
                                                                                                                    width="70"></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td width="20"></td>
                                                                        <td class="esdev-mso-td" valign="top">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                class="es-left" align="left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="265"
                                                                                            class="esd-container-frame"
                                                                                            align="center">
                                                                                            <table cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                width="100%">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="left"
                                                                                                            class="esd-block-text">
                                                                                                            <p><strong>{{ $item->name }}</strong>
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left"
                                                                                                            class="esd-block-text es-p5t">
                                                                                                            <p>
                                                                                                                @isset($item->options->size)
                                                                                                                    Size:
                                                                                                                    {{ $item->options->size }}
                                                                                                                @endisset
                                                                                                                <br>
                                                                                                                @isset($item->options->color)
                                                                                                                    Color:
                                                                                                                    {{ __($item->options->color) }}
                                                                                                                @endisset
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td width="20"></td>
                                                                        <td class="esdev-mso-td" valign="top">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                class="es-left" align="left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="80" align="left"
                                                                                            class="esd-container-frame">
                                                                                            <table cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                width="100%">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center"
                                                                                                            class="esd-block-text">
                                                                                                            <p> {{ $money }}
                                                                                                                {{ number_format($item->price, 2) }}
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td width="20"></td>
                                                                        <td class="esdev-mso-td" valign="top">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                class="es-left" align="left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="80" align="left"
                                                                                            class="esd-container-frame">
                                                                                            <table cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                width="100%">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center"
                                                                                                            class="esd-block-text">
                                                                                                            <p> {{ $item->qty }}
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td width="20"></td>
                                                                        <td class="esdev-mso-td" valign="top">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                class="es-right" align="right">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="85" align="left"
                                                                                            class="esd-container-frame">
                                                                                            <table cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                width="100%">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="right"
                                                                                                            class="esd-block-text">
                                                                                                            <p>{{ $money }}
                                                                                                                {{ number_format($item->price * $item->qty, 2) }}

                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="esd-structure es-p10t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="es-m-p0r esd-container-frame"
                                                                        align="center">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%"
                                                                            style="border-top: 2px solid #efefef; border-bottom: 2px solid #efefef;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="right"
                                                                                        class="esd-block-text es-m-txt-r es-p10t es-p20b">
                                                                                        <p>
                                                                                            {{-- Subtotal:&nbsp;<strong>$40.00</strong><br> --}}
                                                                                            Envío (aprox.
                                                                                            {{ $envio->days_received }}
                                                                                            días):&nbsp;<strong>{{ $money }}
                                                                                                {{ number_format($order->shipping_cost, 2) }}</strong><br>
                                                                                            {{-- Tax:&nbsp;<strong>$10.00</strong><br> --}}
                                                                                            Total:&nbsp;<strong>{{ $money }}
                                                                                                {{ number_format($order->total, 2) }}</strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p10b es-p20r es-p20l"
                                                        align="left">
                                                        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="280" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="280"
                                                                        class="es-m-p0r esd-container-frame es-m-p20b"
                                                                        align="center">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        class="esd-block-text">
                                                                                        <p>Cliente:
                                                                                            <strong>{{ $order->contact }}</strong>
                                                                                        </p>
                                                                                        <p>Número de
                                                                                            orden:&nbsp;<strong>#{{ $order->id }}</strong>
                                                                                        </p>
                                                                                        <p>Fecha de
                                                                                            factura:&nbsp;<strong>{{ $order->created_at->format('d/m/Y') }}</strong>
                                                                                        </p>
                                                                                        <p>Método de
                                                                                            pago:&nbsp;<strong>{{ $order->pay_method }}</strong>
                                                                                        </p>
                                                                                        <p>Moneda:&nbsp;<strong>{{ $money }}</strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="0"></td><td width="280" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="280" class="es-m-p0r esd-container-frame"
                                                                        align="center">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        class="esd-block-text es-m-txt-l">
                                                                                        {{-- <p>Shipping Method: <strong>UPS
                                                                                                - Ground</strong></p> --}}
                                                                                        <p>Dirección de envío:</p>
                                                                                        <p><strong>
                                                                                                @if ($envio->address)
                                                                                                    {{ $envio->address }},
                                                                                                @endif
                                                                                                <br>
                                                                                                @if ($envio->address_lot)
                                                                                                    {{ $envio->address_lot }},
                                                                                                @endif
                                                                                                <br>
                                                                                                @if ($envio->address_urbanization)
                                                                                                    {{ $envio->address_urbanization }},
                                                                                                @endif
                                                                                            </strong></p>
                                                                                        <p>
                                                                                            <strong>
                                                                                                @if ($order->envio_type != 1)
                                                                                                    {{ $envio->department }}
                                                                                                    /
                                                                                                    {{ $envio->city }}
                                                                                                    /
                                                                                                    {{ $envio->district }}
                                                                                                @endif
                                                                                            </strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p15t es-p10b es-p20r es-p20l"
                                                        align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" align="left"
                                                                        class="esd-container-frame">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p10t es-p10b">
                                                                                        <p>¿Tienes una
                                                                                            pregunta?&nbsp;Envíenos un
                                                                                            correo electrónico a&nbsp;
                                                                                            <a target="_blank"
                                                                                                href="mailto:">{{ $support }}</a>

                                                                                            &nbsp;o llámenos a&nbsp;
                                                                                            <a target="_blank"
                                                                                                href="tel:">+51
                                                                                                {{ $phone_emp }}</a>.
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0"
                                            width="600" style="background-color: transparent;">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20b es-p20r es-p20l"
                                                        align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame"
                                                                        align="left">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-social es-p15t es-p15b"
                                                                                        style="font-size:0">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            class="es-table-not-adapt es-social">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        class="es-p40r">
                                                                                                        <a target="_blank"
                                                                                                            href="{{ $facebook }}"><img
                                                                                                                title="Facebook"
                                                                                                                src="https://taxemy.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png"
                                                                                                                alt="Fb"
                                                                                                                width="32"></a>
                                                                                                    </td>
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        class="es-p40r">
                                                                                                        <a target="_blank"
                                                                                                            href="{{ $instagram }}"><img
                                                                                                                title="Instagram"
                                                                                                                src="https://taxemy.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png"
                                                                                                                alt="Inst"
                                                                                                                width="32"></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p35b">
                                                                                        <p>{{ $name_emp }}&nbsp;©
                                                                                            2021
                                                                                            Todos los derechos
                                                                                            reservados.</p>
                                                                                        <p>{{ $place_emp }}</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-menu"
                                                                                        esd-tmp-menu-padding="5|5"
                                                                                        esd-tmp-divider="1|solid|#cccccc">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0" width="100%"
                                                                                            class="es-menu">
                                                                                            <tbody>
                                                                                                <tr
                                                                                                    class="links">
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        width="33.33%"
                                                                                                        class="es-p10t es-p10b es-p5r es-p5l"
                                                                                                        style="padding-top: 5px; padding-bottom: 5px;">
                                                                                                        <a target="_blank"
                                                                                                            style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#333333;font-size:12px"
                                                                                                            href="https://occasione.store/">Visit
                                                                                                            Us </a>
                                                                                                    </td>
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        width="33.33%"
                                                                                                        class="es-p10t es-p10b es-p5r es-p5l"
                                                                                                        style="padding-top: 5px; padding-bottom: 5px; border-left: 1px solid #cccccc;">
                                                                                                        <a target="_blank"
                                                                                                            style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#333333;font-size:12px"
                                                                                                            href="{{ route('policy') }}">Privacy
                                                                                                            Policy</a>
                                                                                                    </td>
                                                                                                    {{-- <td align="center"
                                                                                                        valign="top"
                                                                                                        width="33.33%"
                                                                                                        class="es-p10t es-p10b es-p5r es-p5l"
                                                                                                        style="padding-top: 5px; padding-bottom: 5px; border-left: 1px solid #cccccc;">
                                                                                                        <a target="_blank"
                                                                                                            style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#333333;font-size:12px"
                                                                                                            href="https://">Terms
                                                                                                            of Use</a>
                                                                                                    </td> --}}
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
