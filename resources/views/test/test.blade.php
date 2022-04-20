<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>


    <table style="border: solid">
        <thead class=" text-primary">
            <th>PRODUCTO</th>
            <th>PRECIO</th>
            <th>COSECHAS</th>
            <th>T</th>
            <th>VALOR PRODUCCION</th>
            <th style="width: 100px">AUTOCONSUMO</th>
            <th style="width: 100px">DESPERDICIO</th>
            <th>VENTA</th>
            <th>SUMA</th>

        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                @if ($item['valor_produccion'] > 0)
                    <tr>
                        <td>{{ $item['producto']->nombre }}</td>
                        <td>{{ $item['producto']->precio_kg }}</td>
                        <td>{{ $item['producto']->cosechas }}</td>
                        <td>{{ $item['t_toneladas'] }}</td>
                        <td>{{ $item['valor_produccion'] }}</td>
                        <td>{{ $item['autoconsumo'] }}</td>
                        <td>{{ $item['desperdicio'] }}</td>
                        <td>{{ $item['venta'] }}</td>
                        <td>{{ $item['venta'] + $item['desperdicio'] + $item['autoconsumo'] }}</td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
</body>

</html>
