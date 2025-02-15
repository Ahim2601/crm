<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>

</head>
<body>
    <table cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif">
        <tr>
            <th colspan="4" style="text-align: left; ">
                @if($quotation->bussines == 'Raisa')
                <img src="{{ public_path('assets/img/logo.png') }}" alt="logo" height="100">
                @endif
                @if($quotation->bussines == 'Ciro')
                <img src="{{ public_path('assets/img/logo-ciro-negro.png') }}" alt="logo" height="100">
                @endif
            </th>

            <th colspan="4" style="text-align: right;">
                <h3 style="line-height: 0;">
                    Cotización N° {{ $quotation->id }}
                </h3>
                <h4 style="line-height: 0;">{{ \Carbon\Carbon::now('America/Santiago')->translatedFormat('l, d \d\e F \d\e Y'); }}</h5>
            </th>
        </tr>
        <tr style="margin-top: 40px;">
            <td colspan="8" style="text-align: center;padding-top: 20px;padding-bottom: 20px">
                <strong>COTIZACIÓN</strong>
            </td>
        </tr>
    </table>
    <table cellspacing="0" border="2"
            style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;
            text-align: center; font-size: 12px">
            <tr>
                <td colspan="2" style="background-color: #046c74; color: #fff">
                    <strong>RUT:</strong>
                </td>
                <td colspan="2" style="background-color: #046c74; color: #fff">
                    <strong>Cliente:</strong>
                </td>
                <td colspan="2" style="background-color: #046c74; color: #fff">
                    <strong>Contacto:</strong>
                </td>
                <td colspan="2"style="background-color: #046c74; color: #fff" >
                    <strong>Teléfono:</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    {{ $quotation->customer->rut }}
                </td>
                <td colspan="2">
                    {{ $quotation->customer->business_name }}
                </td>
                <td colspan="2">
                    {{ $quotation->customer->name }}
                </td>
                <td colspan="2">
                    {{ $quotation->customer->phone }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background-color: #046c74; color: #fff">
                    <strong>Email:</strong>
                </td>
                <td colspan="4" style="background-color: #046c74; color: #fff">
                    <strong>Dirección:</strong>
                </td>
                <td colspan="2" style="background-color: #046c74; color: #fff">
                    <strong>Forma de Pago:</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" >
                    <span>{{ $quotation->customer->email }}</span>
                </td>
                <td colspan="4" >
                    <span>{{ $quotation->customer->address }}</span>
                </td>
                <td colspan="2" >
                    <span>Contado</span>
                </td>
            </tr>
    </table>
    <table  cellspacing="0" 2" cellpadding="2" style="border-radius: 5px; width: 100%; margin-top: 20px; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif">
        <thead>
            <tr style="text-align: center; font-size: 12px; background-color: #046c74; color: #fff">
                <th>Item</th>
                <th>Referencia</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Unidad</th>
                <th>Valor</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotation->items as $item)
                <tr style="text-align: center; font-size: 12px">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->reference }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->quantity * $item->price , 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot style="border-top: 1px solid #0483b2; padding-top: 20px; font-size: 12px">
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold">SubTotal:</td>
                <td style="text-align: center;">{{ number_format($quotation->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold">IVA (%19):</td>
                <td style="text-align: center;">{{ number_format($quotation->iva, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold">Total:</td>
                <td style="text-align: center;">$ {{ number_format($quotation->grand_total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <table  cellspacing="0" cellpadding="2" style="border-radius: 5px; width: 100%; margin-top: 40px; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif">
        <tbody>
            <tr>
                <td colspan="4" style="font-size: 14px;">
                    <strong>Observaciones:</strong> {{ $quotation->note }}
                </td>
            </tr>
        </tbody>
    </table>
    @if($quotation->bussines == 'Raisa')
    <div style="position: fixed; bottom: 0; width: 100%;">
        <div style="text-align: justify;font-family: Arial, Helvetica, sans-serif; font-size: 12px">
            <p>
                Formas de pago: Efectivo , Transferencia y tarjetas de crédito (a esta última se aplica un 3% al total por el uso de la tarjeta). <br>
                Garantía: 1 año por la marca + 2 años por Raisa Climatizaciones realizando las mantenciones preventivas al día. <br>
                Incluye: 3 mts de cañeria y cableado de interconexión.<br/>
                Contacto +569 3083 8331     contacto@raisaclimatizaciones.cl      www.raisaclimatizaciones.cl
            </p>
        </div>
    </div>
    @endif
    @if($quotation->bussines == 'Ciro')

    @endif

</body>
</html>
