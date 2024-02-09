<table>
    <thead>
        <tr>
            @foreach($titulos as $titulo)
                <th>
                    {{ Str::replace('_', ' ', $titulo) }}
                </th>
            @endforeach
        </tr>
    </thead>

    <tbody>

    @foreach($datosDescargar as $datos)
        <tr>
            @foreach($datos as $dato)
            <td>
                {{ $dato }}
            </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
