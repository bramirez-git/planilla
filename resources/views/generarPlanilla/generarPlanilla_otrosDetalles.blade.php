
@if($resultado->isEmpty())
    <div class="alert alert-warning">
        No se aplican otras deducciones y/o incrementos.
    </div>
@else
    <div class="card-body p-0 p-lg-2">

        <div class="table-responsive">
            <table class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                    <tr>
                        <!--
                        <th class="bgc-info text-white text-center font-bold" style="width:8%;">
                            Aplicar
                        </th>
                        -->
                        <th class="bgc-info text-white text-center font-bold" style="width:42%;">
                            Concepto
                        </th>
                        <th class="bgc-info text-white text-center font-bold" style="width:20%;">
                            Acción
                        </th>
                        <th class="bgc-info text-white text-center font-bold" style="width:20%;">
                            Valor
                        </th>
                        <th class="bgc-info text-white" style="width:10%;"></th>
                    </tr>
                </thead>

                <tbody class="mt-1">
                    @foreach($resultado as $resultadoDetalles)
                        <tr class="bgc-h-blue-l4 d-style">
                            <td data-label="Concepto" class="text-grey-d1 text-left">
                                <div class="mt-1">
                                    @if($resultadoDetalles->cancelado == 1)
                                        <del class="text-orange">
                                            {{ $resultadoDetalles->concepto }}
                                        </del>
                                    @else
                                        {{ $resultadoDetalles->concepto }}
                                    @endif
                                </div>
                            </td>
                            <td data-label="Acción" class="text-grey-d1 text-center">
                                <div class="mt-1">
                                    @php
                                        $tipo_ajuste = "";
                                        switch($resultadoDetalles->tipo){
                                            case "deduccion":  $tipo_ajuste = "Deducción"; break;
                                            case "incremento": $tipo_ajuste = "Incremento"; break;
                                        }
                                    @endphp

                                    @if($resultadoDetalles->cancelado == 1)
                                        <del class="text-orange">
                                            {{ $tipo_ajuste }}
                                        </del>
                                    @else
                                        {{ $tipo_ajuste }}
                                    @endif
                                </div>
                            </td>
                            <td data-label="Valor" class="text-grey-d1">
                                <div class="mt-1">
                                    @if($resultadoDetalles->cancelado == 1)
                                        <del class="text-orange">
                                            @if($resultadoDetalles->moneda == "colones")
                                                {{'₡'}}
                                            @else
                                                {{'$'}}
                                            @endif
                                            {{ number_format($resultadoDetalles->monto, 2, ".", ",") }}
                                        </del>
                                    @else
                                        @if($resultadoDetalles->moneda == "colones")
                                            {{'₡'}}
                                        @else
                                            {{'$'}}
                                        @endif
                                        {{ number_format($resultadoDetalles->monto, 2, ".", ",") }}
                                    @endif
                                </div>
                            </td>
                            <td class="text-grey-d1 text-center text-md-center">
                                @if($resultadoDetalles->cancelado == 0)
                                    <button type="button" id="eliminar_detalle{{$resultadoDetalles->id_planilla_ajuste}}" class="btn btn-light-red btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                @else
                                    <button type="button" id="eliminar_detalle{{$resultadoDetalles->id_planilla_ajuste}}" class="btn btn-light-success btn-sm">
                                        <i class="fa fa-check"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <script>
                            $('#eliminar_detalle{{$resultadoDetalles->id_planilla_ajuste}}').click(function(){
                                waitingDialog.show();
                                let id_planilla = "{{ Crypt::encrypt($resultadoDetalles->id_planilla) }}";
                                let id_colaborador = "{{$resultadoDetalles->id_colaborador}}";
                                let id_prestamo = "{{$resultadoDetalles->id_prestamo}}";
                                let id_ajuste = "{{$resultadoDetalles->id_planilla_ajuste}}";
                                let clasificacion = "{{$resultadoDetalles->clasificacion}}";

                                $.ajax({
                                    method:'GET',
                                    url: "{{ route('eliminarDetalleOtrasDeducciones.delete') }}",
                                    data:{
                                        'id_colaborador':id_colaborador,
                                        'id_planilla':id_planilla,
                                        'id_prestamo':id_prestamo,
                                        'id_ajuste':id_ajuste,
                                        'clasificacion':clasificacion
                                    },
                                    success: (response) => {
                                        if(response.success){
                                            mostrarAlertaExito('Se eliminaron los ajustes para el colaborador');
                                            window.location = response.url;
                                        }else{
                                            mostrarAlertaError(response[0],response[1]);
                                        }
                                    },
                                    error: function(response){
                                        alert(response.responseJSON.message);
                                    },
                                    complete: function (response){
                                        waitingDialog.hide();
                                    }
                                });
                            });
                        </script>
                    @endforeach
                </tbody>
                <tfoot class="text-dark-tp3 bgc-grey-l4 border-b-1 brc-transparent">
                    <tr>
                        <td colspan="2" class="bgc-info text-white text-center font-bold">
                            Total
                        </td>
                        <td class="bgc-info text-white text-center font-bold">
                            @if($resultadoPlanilla->moneda == "colones")
                                {{'₡'}}
                            @else
                                {{'$'}}
                            @endif
                            {{ number_format($totalOtrasDeducciones, 2, ".", ",") }}
                        </td>
                        <td class="bgc-info"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endif
