<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>IngresoPagos</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.55em;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }

        .txt_right{
            text-align: right;
        }
        .font_lg{
            font-size: 0.75em;
        }

        .bold{
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . app\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ app\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">INGRESOS POR PAGOS</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th width="5%">Nro. Orden</th>
                <th>Cliente</th>
                <th>Fecha Hora Entrega</th>
                <th>Empresa</th>
                <th>Distribuidor</th>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
                $total = 0;
            @endphp
            @foreach ($pagos as $pago)
                @php
                    $total = $total + $pago->total_pago;
                @endphp
                <tr>
                    <td>{{ $pago->entrega->orden->nro_orden }}</td>
                    <td>{{ $pago->entrega->cliente->nombre }} {{ $pago->entrega->cliente->paterno }}
                        {{ $pago->entrega->cliente->materno }}</td>
                    <td>{{ $pago->entrega->fecha_hora_entrega }}</td>
                    <td>{{ $pago->entrega->orden->empresa->nombre }}</td>
                    <td>{{ $pago->entrega->orden->distribuidor->datosUsuario->nombre}} {{ $pago->entrega->orden->distribuidor->datosUsuario->paterno}} {{ $pago->entrega->orden->distribuidor->datosUsuario->materno}} <br> "{{ $pago->entrega->orden->distribuidor->datosUsuario->distribuidor->nombre}}"</td>
                    <td>{{ $pago->entrega->orden->producto->nombre }}</td>
                    <td>{{ $pago->entrega->orden->producto->precio }}</td>
                    <td>{{ $pago->entrega->orden->cantidad }}</td>
                    <td>{{ $pago->total_pago }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8" class="bold txt_right font_lg">TOTAL</td>
                <td class="bold centreado font_lg">{{ number_format($total, 2, '.', '') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
