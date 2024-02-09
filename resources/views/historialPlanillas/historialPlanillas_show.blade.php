<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 px-0">
                    <div class="table-responsive">
                        @php
                            $simbolo_moneda = '₡';
                            if($resultadoPlanilla->moneda == "dolares"){
                                $simbolo_moneda = '$';
                            }
                        @endphp

                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                            <tr>
                                <th class="text-left text-md-center small align-middle">
                                    <strong> Identificaci&oacute;n</strong>
                                </th>

                                <th class="text-left text-md-center small align-middle">
                                    <strong> Primer Apellido</strong>
                                </th>

                                <th class="text-left text-md-center small align-middle">
                                    <strong> Segundo Apellido</strong>
                                </th>

                                <th class="text-left text-md-center small align-middle">
                                    <strong> Nombre</strong>
                                </th>

                                <th class="text-left text-md-center small align-middle">
                                    <strong> Salario Base</strong>
                                </th>

                                <!--<th class="text-left text-md-center small align-middle">
                                    <strong> Días laborados</strong>
                                </th>-->

                                @if($resultadoPlanilla->adelanto_salario == "si")
                                    <th class="text-left text-md-center small align-middle">
                                        <strong> Salario adelanto</strong>
                                    </th>

                                    <th class="text-left text-md-center small align-middle">
                                        <strong> Salario cierre</strong>
                                    </th>
                                @endif

                                <th class="text-left text-md-center small align-middle">
                                    <strong> Salario devengado</strong>
                                </th>

                                <th class="text-left text-md-center small align-middle">
                                    <strong>Resumen</strong>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="mt-1">
                            @foreach($resultado as $resultadoColaboradores)
                                <tr class="bgc-h-blue-l4 d-style">

                                    <td data-label="Identificaci&oacute;n:"
                                        class='text-grey-d1 text-right text-md-center small'>
                                        {{$resultadoColaboradores->identificacion}}
                                    </td>

                                    <td data-label="Primer Apellido:"
                                        class='text-grey-d1 text-right text-md-center small'>
                                        {{$resultadoColaboradores->primer_apellido}}
                                    </td>

                                    <td data-label="Segundo Apellido:"
                                        class='text-grey-d1 text-right text-md-center small'>
                                        {{$resultadoColaboradores->segundo_apellido}}
                                    </td>

                                    <td data-label="Nombre:" class='text-grey-d1 text-right text-md-center small'>
                                        {{$resultadoColaboradores->primer_nombre}}
                                        {{$resultadoColaboradores->segundo_nombre}}
                                    </td>

                                    <td data-label="Salario Base:" class="text-grey-d1 text-right text-md-center small">
                                        {{ $simbolo_moneda }}
                                        {{ number_format($resultadoColaboradores->salario_base, 2) }}
                                    </td>

                                    <!--<td data-label="Días laborados:" class="text-grey-d1 text-right text-md-center small">
                                        {{$resultadoColaboradores->total_dias_laborados}}
                                    </td>-->

                                    @if($resultadoPlanilla->adelanto_salario == "si")
                                        <td data-label="Salario adelanto:" class="text-grey-d1 text-right text-md-center small">
                                            {{ $simbolo_moneda }}
                                            {{ number_format($resultadoColaboradores->salario_adelanto,2) }}
                                        </td>

                                        <td data-label="Salario cierre:" class="text-grey-d1 text-right text-md-center small">
                                            {{ $simbolo_moneda }}
                                            {{ number_format($resultadoColaboradores->salario_devengado,2) }}
                                        </td>
                                    @endif

                                    <td data-label="Salario devengado:" class="text-grey-d1 text-right text-md-center small">
                                        <strong>
                                            {{ $simbolo_moneda }}

                                            @if($resultadoPlanilla->adelanto_salario == "si")
                                                {{ number_format($resultadoColaboradores->salario_adelanto + $resultadoColaboradores->salario_devengado,2) }}
                                            @else
                                                {{ number_format($resultadoColaboradores->salario_devengado,2) }}
                                            @endif
                                        </strong>
                                    </td>

                                    <td data-label="Resumen:">
                                        <div class="text-md-center">
                                            <div class="m-auto d-md-inline-block d-block align-middle">
                                                <span class="badge badge-primary badge-md mb-2 py-1">
                                                    <strong>
                                                        <a href="{{
                                                            route('resumenHistorialPlanilla',[
                                                                Crypt::encrypt($resultadoColaboradores->id_planilla),
                                                                Crypt::encrypt($resultadoColaboradores->id_colaborador)
                                                            ]) }}"
                                                                title="Datos de Resumen"
                                                                class="btn btn-primary text-100 p-0 ajax-popup-link">
                                                            &nbsp;<i class="fa fa-eye"></i>
                                                        </a>
                                                    </strong>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<input type="text" value="{{ $idPlanilla }}" id="idPlanilla" name="idPlanilla" hidden>

<script type="module">
    $(document).ready(function() {
        var magnific = $('.ajax-popup-link').magnificPopup({
            type: 'ajax',
            fixedContentPos: true,
            showCloseBtn: true,
            closeBtnInside: false,
            callbacks: {
                beforeOpen: function() {
                    // Mostrar tu propio modal de carga antes de abrir el modal Magnific Popup
                    waitingDialog.show();
                },
                ajaxContentAdded: function() {
                    // Ocultar tu modal de carga después de que se haya cargado el contenido AJAX
                    waitingDialog.hide();
                }
            }
        });
    });
</script>
