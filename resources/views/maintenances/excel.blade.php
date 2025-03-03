<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mantenimientos</title>
</head>
<body>
    <table>
        <tr>
            <td colspan="16">
                <h1>Mantenimientos de {{ $start }} a {{ $end }}</h1>
            </td>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->fecha }}</td>
                <td>{{ $item->cliente }}</td>
                <td>{{ $item->rut }}</td>
                <td>{{ $item->contacto }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->telefono }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->subtotal }}</td>
                <td>{{ $item->iva }}</td>
                <td>{{ $item->descuento }}</td>
                <td>{{ $item->descuento_total }}</td>
                <td>{{ $item->grand_total }}</td>
                <td>{{ $item->start_date_maintenance }}</td>
                <td>{{ $item->end_date_maintenance }}</td>
                <td>{{ $item->time_recordatory }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>