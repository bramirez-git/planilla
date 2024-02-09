<div class="d-flex flex-column flex-md-row justify-content-between">
    <div class="text-nowrap align-self-start mb-sm-0 pb-4"></div>
    <div class="text-nowrap align-self-start pl-md-2">
        <div class="d-inline-flex align-items-center ml-sm-0 pb-4">
            <div class="d-flex flex-row-reverse">
                <div class="px-1"></div>
                <div class="px-1"></div>
                <div class="px-1">
                    <div class="dropdown d-inline-block h-100">
                        <button class="btn btn-outline-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Más acciones
                            <i class="fa fa-angle-down ml-2 text-90"></i>
                        </button>
                        <div class="dropdown-menu dropdown-caret">
                            @if(!empty($resultado))
                                <a onClick="descargar_excel();" class="dropdown-item">Descargar excel</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('configuracionPadronCompleto.create') }}">
                                Subir padrón
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(empty($resultado))
    <div class="alert alert-warning alert-lg bgc-warning-l4 border-0 border-t-3 brc-warning-m2 mb-3 radius-0 pr-3 py-3 d-flex">
        No se encuentran registros
    </div>
@else
    <div class="table-responsive border-t-3 brc-blue-m2">
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th class="text-center text-secondary-d2 text-95 text-600">
                    Cédula
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Primer Nombre
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Segundo Nombre
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Primer Apellido
                </th>

                <th class="text-center text-secondary-d2 text-95 text-600">
                    Segundo Apellido
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">
                <tr class="bgc-h-blue-l4 d-style">
                    <td class='d-none d-sm-table-cell text-primary-d2 text-grey-d1 text-center'>
                        <strong>{{ $resultado['cedula'] }}</strong>
                    </td>
                    <td class='d-none d-sm-table-cell text-grey-d1 text-center'>
                        {{ $resultado['primer_nombre'] }}
                    </td>
                    <td class='d-none d-sm-table-cell text-grey-d1 text-center'>
                        {{ $resultado['segundo_nombre'] }}
                    </td>
                    <td class='d-none d-sm-table-cell text-grey-d1 text-center'>
                        {{ $resultado['primer_apellido'] }}
                    </td>
                    <td class='d-none d-sm-table-cell text-grey-d1 text-center'>
                        {{ $resultado['segundo_apellido'] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @include('componentes.paginacion')
@endif
