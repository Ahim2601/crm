<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <style>
        @page{
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            width: 100%;
            height: 140px;
            position: relative;
        }
        .footer {
            width: 100%;
            height: 30px;
            position: absolute;
            background-color: {{ $empresa->color_pdf }};
            bottom: 0;
        }

        .table-header {
            width: 100%;
            border-collapse: collapse;
        }

        .left-section {
            background-color: {{ $empresa->color_pdf }};
            width: 60%;
            padding: 20px;
            color: white;
            font-size: 24px;
            font-weight: bold;
            vertical-align: middle;
            position: relative;
        }

        .right-section {
            background-color: {{ $empresa->color_pdf }};
            width: 40%;
            padding: 20px;
            color: white;
            text-align: right;
            font-size: 16px;
            vertical-align: middle;
            position: relative;
        }

        .right-section .title {
            color: {{ $empresa->colorline_pdf }};
            font-size: 20px;
            font-weight: bold;
        }

        /* Línea diagonal simulada */
        .triangle {
            background-color: {{ $empresa->colorline_pdf }};
            width: 20px;
            height: 140px;
            position: absolute;
            left: -150px;
            top: 0;
            transform: skewX(-25deg);
        }

        /* Línea horizontal simulada */
        .triangle:after {
            content: '';
            background-color: {{ $empresa->colorline_pdf }};
            width: 330px;
            height: 20px;
            position: absolute;
            left: -320px;
            top: 90;
            /* transform: skewY(-25deg); */
        }
        .invoice-details {
            /* border: 1px solid #ddd; */
            width: 90%;
            margin-top: 20px;
            margin-left: 5%;

        }

        .invoice-details td {
            padding: 5px;
            vertical-align: top;
        }

        /* Estilos para los títulos de "Invoice To" y "Invoice From" */
        .invoice-details .title {
            font-size: 18px;
            font-weight: bold;
        }

        .invoice-details .name {
            font-size: 22px;
            font-weight: bold;
            color: black;
        }

        .invoice-details .contact-info {
            font-size: 14px;
        }

        .invoice-details .contact-info b {
            color: black;
        }

        /* Estilos para la tabla de items */
        .invoice-table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: 5%;
        }

        .invoice-table th {
            background-color: {{ $empresa->color_pdf }};
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }

        .invoice-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }
        /* Sección de información de pago y contacto */
        .payment-info {
            width: 100%;
            margin-top: 20px;
        }

        .payment-info td {
            padding: 5px;
            font-size: 14px;
            vertical-align: top;
        }

        .payment-info b {
            color: black;
        }

        /* Estilos para la tabla de totales */
        .totals-table {
            width: 30%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: 65%;
        }

        .totals-table td {
            padding: 8px;
            font-size: 14px;
            text-align: right;
        }

        .totals-table .label {
            font-weight: bold;
        }

        .totals-table .total-row {
            background-color: {{ $empresa->color_pdf }};
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        /* Estilos para términos y firma */
        .terms {
            margin-top: 20px;
            font-size: 14px;
        }

        .signature {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #000;
            width: 200px;
            float: right;
        }

    </style>
</head>
<body>
<div class="header">
    <table class="table-header">
        <tr>
            <td class="left-section">
                <img src="{{ public_path('') }}/{{ $empresa->logo }}" alt="logo" height="90">
            </td>
            <td class="right-section">
                <div class="title">COTIZACIÓN </div>
                <div>Cotización Nº: #1970-{{ $quotation->id }}</div>
                <div>{{ \Carbon\Carbon::now('America/Santiago')->translatedFormat('F d, Y'); }}</div>
                <div class="triangle"></div>
            </td>
        </tr>
    </table>
</div>

<!-- Sección de datos de facturación -->
<table class="invoice-details">
    <tr>
        <td class="title">Cliente:</td>
        <td class="title">Empresa:</td>
    </tr>
    <tr>
        <td class="name">{{ $quotation->customer->business_name }}</td>
        <td class="name">
            {{ $empresa->name }}
        </td>
    </tr>
    <tr>
        <td class="contact-info">
            <b>Contacto:</b> {{ $quotation->customer->name }}.<br>
            <b>Tlf:</b> {{ $quotation->customer->phone }}<br>
            <b>Email:</b> {{ $quotation->customer->email }}
        </td>
        <td class="contact-info">
            <b>Tlf:</b> {{ $empresa->phone }}<br>
            <b>Email:</b> {{ $empresa->email }}
        </td>
    </tr>
</table>

<!-- Tabla de productos/servicios -->
<table class="invoice-table">
    <tr>
        <th style="width: 5%;">ITEM</th>
        <th style="width: 45%;">DESCRIPCIÓN</th>
        <th style="width: 10%;">UNIDAD</th>
        <th style="width: 10%;">CANT.</th>
        <th style="width: 15%;">PRECIO</th>
        <th style="width: 15%;">TOTAL</th>
    </tr>
    @foreach ($quotation->items as $item)
        <tr >
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->reference }}</td>
            <td>{{ $item->unit }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }}</td>
            <td>{{ number_format($item->quantity * $item->price , 0, ',', '.') }}</td>
        </tr>
    @endforeach

</table>
<!-- Totales -->
<table class="totals-table">
    <tr>
        <td class="label">SUBTOTAL:</td>
        <td>{{ number_format($quotation->subtotal, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td class="label">IVA (19%):</td>
        <td>{{ number_format($quotation->iva, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td class="label">DESCUENTO ({{ $quotation->discount_percent }}%):</td>
        <td>{{ number_format($quotation->discount, 0, ',', '.') }}</td>
    </tr>
    <tr class="total-row">
        <td class="label">TOTAL:</td>
        <td>{{ number_format($quotation->grand_total, 0, ',', '.') }}</td>
    </tr>
</table>

<div class="footer"></div>
</body>
</html>
