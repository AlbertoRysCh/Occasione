<?php
$configs = DB::table('configs')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <table class="items-table mt" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="heading">
                <th>
                    <!-- Logo -->
                    @if ($configs == null)
                        <picture style="width: 100%; max-width: 300px">
                            <x-jet-application-mark class="block h-9 w-auto" />
                        </picture>
                    @else
                        <img src="{{ Storage::url($configs->logo) }}" width="45" height="45" class="block h-9 w-auto">
                    @endif
                </th>
                <th> Reclamo No.{{ $n_reclamo }} </th>
            </tr>
        </thead>
        <tr>
            <td align="center" style="background=<?= $configs->color_fondo_menu ?>">
                <h1 style="background=<?= $configs->color_texto_menu ?>">Libro de Reclamaciones Virtual</h1>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h2>
                    Hola,
                </h2>
                <p>
                    Te confirmamos que hemos recibido tu reclamo presentado a través del Libro de Reclamaciones Virtual
                    de Occasione y registrado con el
                    <strong>Reclamo No. {{ $n_reclamo }}</strong>.
                </p>
                <p>Se deja en copia los datos introducidos en tu Reclamo Virtual:.</p>
                <p>
                    Nombre: {{ $name }} Apellido: {{ $last_name }} Tipo de documento: {{ $type_document }}
                    Número de documento: {{ $claim_document }}
                    Email: {{ $email }} {{ $type_direction }} {{ $direction }} {{ $address_lote }}
                    @if ($address_departament != null)
                        Depto./Int: {{ $address_departament }}
                    @endif

                    @if ($address_urbanization != null)
                        Urbanización: {{ $address_urbanization }}
                    @endif
                    ,
                    {{ $address_region }}, {{ $address_municipality }} - {{ $address_city }}

                    @if ($address_line2 != null)
                        Referencia: {{ $address_line2 }}
                    @endif

                    Teléfono: {{ $phone }}

                    @if ($other_phone != null)
                        - {{ $other_phone }}
                    @endif

                    Monto del bien objeto de Reclamo: {{ $product_amount }}
                    Identificación del Bien contratado: Producto Descripción: {{ $product_description }}

                    @if ($num_pedido != null)
                        Número de Pedido: {{ $num_pedido }}
                    @endif

                    Tipo de reclamación: {{ $type_reclam }} Detalle: {{ $detalle }} Pedido: {{ $detalle }}
                <p>
                    En concordancia al Código de Protección y Defensa del Consumidor - Ley N° 29571, tu Reclamo No
                    {{ $n_reclamo }}, está siendo revisado y atendido en un plazo no mayor a 30 días calendario.
                </p>
                <p>
                    Este plazo puede ser extendido por otro igual cuando la naturaleza del reclamo lo justifique, el
                    cual será notificado a tu correo electrónico antes de la culminación del plazo inicial.
                </p>
                <p>
                    Nos despedimos no sin antes disculparnos por causarte una mala experiencia. Nuestra intención
                    siempre es lograr la completa satisfacción de nuestros clientes, lo antes posible contactaremos con
                    usted.
                </p></br>

                <p>Saludos,</p>
                <p>Atención al Cliente</p></br>

                </p>
            </td>
        </tr>
        <tr>
            <td align="center">
                <p>Servicio de Atención al Cliente</p>
            </td>
        </tr>
    </table>




</body>

</html>
