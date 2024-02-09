
<table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
    <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
    <tr>
        <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
            Concepto
        </th>

        <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
            Detalle
        </th>

        <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
            Deducción
        </th>
    </tr>
    </thead>

    <tbody class="mt-1">
    <tr class="bgc-h-blue-l4 d-style">
        <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center '>
            CCSS S.E.M.
        </td>

        <td data-label="Porcentaje:" class='text-grey-d1 text-right text-md-center '>
                        <span class="badge badge-primary badge-md mb-2">
                            {{$resultado->porcentaje_ccss_sem}}%
                        </span>
        </td>

        <td data-label="Deducción:" class='text-grey-d1 text-right text-md-center '>
                        <span class="badge badge-primary badge-md mb-2">
                            @if($moneda=="colones")
                                {{'₡'}}
                            @else
                                {{'$'}}
                            @endif
                            {{number_format($resultado->monto_ccss_sem,2)}}
                        </span>
        </td>
    </tr>
    <tr class="bgc-h-blue-l4 d-style">
        <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center '>
            CCSS I.V.M.
        </td>

        <td data-label="Porcentaje:" class='text-grey-d1 text-right text-md-center '>
                    <span class="badge badge-primary badge-md mb-2">
                        {{$resultado->porcentaje_ccss_ivm}}%
                    </span>
        </td>

        <td data-label="Deducción:" class='text-grey-d1 text-right text-md-center '>
                    <span class="badge badge-primary badge-md mb-2">
                        @if($moneda=="colones")
                            {{'₡'}}
                        @else
                            {{'$'}}
                        @endif
                        {{number_format($resultado->monto_ccss_ivm,2)}}
                    </span>
        </td>
    </tr>
    <tr class="bgc-h-blue-l4 d-style">
        <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center '>
            Banco Popular
        </td>

        <td data-label="Porcentaje:" class='text-grey-d1 text-right text-md-center '>
                    <span class="badge badge-primary badge-md mb-2">
                        {{$resultado->porcentaje_banco_popular}}%
                    </span>
        </td>

        <td data-label="Deducción:" class='text-grey-d1 text-right text-md-center '>
                    <span class="badge badge-primary badge-md mb-2">

                            @if($moneda=="colones")
                            {{'₡'}}
                        @else
                            {{'$'}}
                        @endif
                        {{number_format($resultado->monto_banco_popular,2)}}
                    </span>
        </td>
    </tr>
    <tr class="bgc-h-blue-l4 d-style">
        <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center '>
            Renta
        </td>

        <td data-label="Porcentaje:" class='text-grey-d1 text-right text-md-center '>

        </td>

        <td data-label="Deducción:" class='text-grey-d1 text-right text-md-center '>
                    <span class="badge badge-primary badge-md mb-2">

                            @if($moneda=="colones")
                            {{'₡'}}
                        @else
                            {{'$'}}
                        @endif
                        {{number_format($resultado->monto_renta,2)}}
                    </span>
        </td>
    </tr>
    <tr class="bgc-h-blue-l4 d-style">
        <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center '>
            Conyugue/hijos
        </td>

        <td data-label="Porcentaje:" class='text-grey-d1 text-right text-md-center '>
            <span class="badge badge-primary badge-md mb-2">
                Cónyugue: {{$resultado->monto_conyuge}}
                <br><br>
                Monto por hijo: {{$resultado->monto_hijo}}
            </span>
        </td>

        <td data-label="Deducción:" class='text-grey-d1 text-right text-md-center '>
            <span class="badge badge-primary badge-md mb-2">
                @if($moneda=="colones")
                    {{'₡'}}
                @else
                    {{'$'}}
                @endif
                    {{number_format($resultado->monto_conyuge_hijos,2)}}
            </span>
        </td>
    </tr>
    <tr class="bgc-h-blue-l4 d-style">
        <td data-label="Detalle:" class='text-grey-d1 text-right text-md-center '>
            Total deducciones
        </td>

        <td data-label="Porcentaje:" class='text-grey-d1 text-right text-md-center '>

        </td>

        <td data-label="Deducción:" class='text-grey-d1 text-right text-md-center '>
                    <span class="badge badge-primary badge-md mb-2">

                            @if($moneda=="colones")
                            {{'₡'}}
                        @else
                            {{'$'}}
                        @endif
                        {{number_format($resultado->total_cargas_renta,2)}}
                    </span>
        </td>
    </tr>
    </tbody>
</table>
