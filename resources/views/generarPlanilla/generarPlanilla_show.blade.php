<input type="hidden" id="cantidad_show" value="{{ $cantidad??"" }}"/>
<input type="hidden" id="paginaActual_show" value="{{$paginaActual??"" }}"/>
<input type="hidden" id="buscar_show" value="{{ $buscar??"" }}"/>
<input type="hidden" id="orden_show" value="{{ $orden??"" }}"/>
<input type="hidden" id="tipo_orden_show" value="{{ $tipo_orden??"" }}"/>
<input type="hidden" id="url_generarPlanilla_show" value="{{ route('generarPlanilla.show', [$idPlanilla]) }}"/>
<input type="hidden" id="id_planilla_blade_show" value="{{Crypt::decrypt($idPlanilla)??""}}"/>
<input type="hidden" id="url_registrarPlanillaExtras" value="{{ route('registrarPlanillaExtras') }}"/>
<div class="accordion" id="accordionExample">
    <div class="card">
        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    @php
                        $signo_moneda = "₡";
                        if($resultadoPlanilla->moneda == "dolares"){
                            $signo_moneda = "$";
                        }
                    @endphp

                    <div class="col-12 py-4 px-0">
                        <div class="table-responsive border-t-3 brc-blue-m2">
                            <table id="simple-table-horas" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
                                    <tr data-id-dr="0">
                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Identificaci&oacute;n</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Primer Apellido</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Segundo Apellido</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Nombre</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Horas Normal a pagar</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Horas Extra&nbsp;a pagar</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Horas Doble&nbsp;a pagar</strong>
                                        </th>

                                        <th scope="col"
                                            class="text-left text-md-center small align-middle px-1 px-md-2 px-xl-5">
                                            <strong class="">Días Feriados a pagar</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Días Feriados&nbsp;no obligatorio</strong>
                                        </th>

                                        <th scope="col" class="text-left text-md-center small align-middle">
                                            <strong> Guardar</strong>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="mt-1">
                                    @foreach($resultado as $resultadoColaboradores)
                                    <tr class="bgc-h-blue-l4 d-style" data-id-dr="{{$resultadoColaboradores->id_colaborador}}">
                                        <td data-label="Identificaci&oacute;n:"
                                            class='text-grey-d1 text-right text-md-center small'>
                                            {{$resultadoColaboradores->identificacion}}
                                        </td>
                                        <td data-label="Primer Apellido:"
                                            class='text-grey-d1 text-right text-md-center small'>
                                            {{$resultadoColaboradores->primer_apellido}}
                                        </td>
                                        <td data-label=" Segundo Apellido:"
                                            class='text-grey-d1 text-right text-md-center small'>
                                            {{$resultadoColaboradores->segundo_apellido}}
                                        </td>
                                        <td data-label="Nombre:" class='text-grey-d1 text-right text-md-center small'>
                                            {{$resultadoColaboradores->primer_nombre}}
                                            {{$resultadoColaboradores->segundo_nombre}}
                                        </td>
                                        <td data-label="Horas Normal a pagar"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <input type="number" value="{{$resultadoColaboradores->horas_normal}}"
                                                min="0.00" lang="en"
                                                class="number-input text-right form-control form-control-sm dato"
                                                id="horaNormal_{{$resultadoColaboradores->identificacion}}_extra"
                                                name="horaNormal_{{$resultadoColaboradores->identificacion}}_extra">
                                        </td>
                                        <td data-label="Horas Extra&nbsp;a pagar"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <input type="number" value="{{$resultadoColaboradores->horas_extra}}"
                                                min="0.00" lang="en"
                                                class="number-input text-right form-control form-control-sm dato"
                                                id="horaExtra_{{$resultadoColaboradores->identificacion}}_extra"
                                                name="horaExtra_{{$resultadoColaboradores->identificacion}}_extra">
                                        </td>
                                        <td data-label="Horas Doble&nbsp;a pagar"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <input type="number" value="{{$resultadoColaboradores->horas_doble}}"
                                                min="0.00" lang="en"
                                                class="number-input text-right form-control form-control-sm dato"
                                                id="horaDoble_{{$resultadoColaboradores->identificacion}}_extra"
                                                name="horaDoble_{{$resultadoColaboradores->identificacion}}_extra">
                                        </td>
                                        <td data-label="Días Feriados a pagar"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <input type="number" value="{{$resultadoColaboradores->dias_feriados}}"
                                                min="0.00" lang="en"
                                                class="number-input text-right form-control form-control-sm dato"
                                                id="horaFeriado_{{$resultadoColaboradores->identificacion}}_extra"
                                                name="horaFeriado_{{$resultadoColaboradores->identificacion}}_extra">
                                        </td>
                                        <td data-label="Días Feriados&nbsp;no obligatorio"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <input type="number"
                                                value="{{$resultadoColaboradores->dias_feriados_no_obligatorios}}"
                                                min="0.00" lang="en"
                                                class="number-input text-right form-control form-control-sm dato"
                                                id="horaFeriado2_{{$resultadoColaboradores->identificacion}}_extra"
                                                name="horaFeriado2_{{$resultadoColaboradores->identificacion}}_extra">
                                        </td>
                                        <td data-label="Guardar" class="text-grey-d1 text-md-center">
                                            <div class="row">
                                                <div class="col-md-2 text-left mr-2">
                                                    <button class="btn btn-light-blue btn-sm mb-1"
                                                            id="guardar{{$resultadoColaboradores->id_colaborador}}">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 text-left">
                                                    <button class="btn btn-light-grey btn-sm mb-1"
                                                            id="info{{$resultadoColaboradores->id_colaborador}}">
                                                        <i class="fa-solid fa-circle-check" id="check{{$resultadoColaboradores->id_colaborador}}"></i>
                                                    </button>
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
    <div class="card">

        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">

                    <div class="col-12 px-0">
                        <div class="table-responsive" style="height:600px;">

                            <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4 sticky-top">
                                    <tr>
                                        <th></th>
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

                                        <th class="text-left text-md-center small align-middle px-1 px-md-2 px-xl-5">
                                            <strong class="">Ajustes</strong>
                                        </th>

                                        <th class="text-left text-md-center small align-middle">
                                            <strong> Salario bruto</strong>
                                        </th>

                                        <th class="text-left text-md-center small align-middle">
                                            <strong> Neto</strong>
                                        </th>

                                        <th class="text-left text-md-center small align-middle">
                                            <strong> Adelanto de salario</strong>
                                        </th>

                                        <th class="text-left text-md-center small align-middle px-xl-4">
                                            <strong class=" "> Otros Ajustes</strong>
                                        </th>

                                        <th class="text-left text-md-center small align-middle">
                                            <strong> Salario a pagar</strong>
                                        </th>


                                    </tr>
                                </thead>

                                <tbody class="mt-1">
                                    @foreach($resultado as $resultadoColaboradores)
                                    <tr class="bgc-h-blue-l4 d-style">
                                        <td>
                                            @if($resultadoColaboradores->tipo_pago != "")
                                                <a href="#" class="tooltip-info pe-none" data-rel="tooltip" data-placement="bottom" title="Configurado correctamente">
                                                    <span class="d-inline-block radius-round bgc-primary-d1 py-1 border-2 text-center brc-white-tp1">
                                                        <i class="fa fa-check w-4 text-90 text-white-tp1"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="{{ route('revisarConfiguracionColaborador',[
                                                            Crypt::encrypt($resultadoColaboradores->id_colaborador),
                                                            Crypt::encrypt($resultadoColaboradores->id_planilla)])
                                                          }}"
                                                   class="ajax-popup-link tooltip-info"
                                                   data-rel="tooltip" data-placement="bottom" title="Falta Configuraci&oacute;n">
                                                    <span class="d-inline-block radius-round bgc-warning-d1 py-1 border-2 text-center brc-white-tp1">
                                                        <i class="fa fa-warning w-4 text-90 text-white-tp1"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        </td>

                                        <td data-label="Identificaci&oacute;n:" class='text-grey-d1 text-right text-md-center small'>
                                            <label class="mt-2">
                                                {{$resultadoColaboradores->identificacion}}
                                            </label>
                                        </td>

                                        <td data-label="Primer Apellido:" class='text-grey-d1 text-right text-md-center small'>
                                            <label class="mt-2">
                                                {{$resultadoColaboradores->primer_apellido}}
                                            </label>
                                        </td>

                                        <td data-label="Segundo Apellido:" class='text-grey-d1 text-right text-md-center small'>
                                            <label class="mt-2">
                                                {{$resultadoColaboradores->segundo_apellido}}
                                            </label>
                                        </td>

                                        <td data-label="Nombre:" class='text-grey-d1 text-right text-md-center small'>
                                            <label class="mt-2">
                                                {{$resultadoColaboradores->primer_nombre}}
                                                {{$resultadoColaboradores->segundo_nombre}}
                                            </label>
                                        </td>

                                        <td data-label="Salario Base:" class='text-grey-d1 text-right text-md-center'>
                                            <span class="badge badge-primary badge-md py-2">
                                                {{ $signo_moneda }}
                                                {{ number_format($resultadoColaboradores->salario_base,2) }}
                                            </span>
                                        </td>

                                        <!--<td data-label="Días laborados:"
                                            class='text-grey-d1 text-right text-md-center small'>
                                            {{$resultadoColaboradores->total_dias_laborados}}
                                        </td>-->

                                        <td data-label="Ajustes:" class='text-grey-d1 text-right text-md-center'>
                                            <div class="text-md-center">
                                                <div class="m-auto d-md-inline-block d-block align-middle">

                                                    <span class="badge badge-md mb-2 py-0">
                                                        <strong>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#ajustesModal{{$resultadoColaboradores->identificacion}}"
                                                                title="Datos de Ajustes"
                                                                class="btn btn-raised btn-info text-100 p-1">
                                                                {{ $signo_moneda }}
                                                                {{ number_format($resultadoColaboradores->total_ajustes,2) }}
                                                                &nbsp;<i class="fa fa-gear"></i>
                                                            </a>
                                                        </strong>
                                                    </span>
                                                </div>
                                                <div class="m-auto d-md-inline-block d-block align-middle">
                                                    <form method="POST"
                                                        action="{{ route('generarPlanilla.update',['1']) }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal fade"
                                                            id="ajustesModal{{$resultadoColaboradores->identificacion}}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-message modal-dialog-scrollable modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-blue-d2">
                                                                            Datos de Ajustes
                                                                        </h5>

                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body ace-scrollbar">
                                                                        <div class="form-group row mt-3">
                                                                            <div class="col-md-12">
                                                                                <div class="card bcard h-100">
                                                                                    <div class="card-header">
                                                                                        <span
                                                                                            class="card-title text-125 font-bold">
                                                                                            Incrementos al salario bruto
                                                                                        </span>
                                                                                    </div>

                                                                                    <div class="card-body">
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Horas normal a pagar
                                                                                                </label>
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="horaNormal_{{$resultadoColaboradores->identificacion}}" name="horaNormal_{{$resultadoColaboradores->identificacion}}"
                                                                                                value="{{$resultadoColaboradores->horas_normal}}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteNormal" name="equivalenteNormal" value="{{ number_format($resultadoColaboradores->monto_horas_normal,2)}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Horas extra a pagar
                                                                                                </label>
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="horaExtra_{{$resultadoColaboradores->identificacion}}" name="horaExtra_{{$resultadoColaboradores->identificacion}}"
                                                                                                value="{{$resultadoColaboradores->horas_extra}}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteExtra" name="equivalenteExtra"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_horas_extra,2)}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Horas doble a pagar
                                                                                                </label>
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="horaDoble_{{$resultadoColaboradores->identificacion}}" name="horaDoble_{{$resultadoColaboradores->identificacion}}"
                                                                                                value="{{$resultadoColaboradores->horas_doble}}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteDoble" name="equivalenteDoble"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_horas_doble,2)}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Días feriados a pagar
                                                                                                </label>
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="horaFeriado_{{$resultadoColaboradores->identificacion}}" name="horaFeriado_{{$resultadoColaboradores->identificacion}}"
                                                                                                value="{{$resultadoColaboradores->dias_feriados}}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteFeriados" name="equivalenteFeriados"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_dias_feriados,2)}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Días feriados no obligatorio
                                                                                                </label>
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="horaFeriado2_{{$resultadoColaboradores->identificacion}}" name="horaFeriado2_{{$resultadoColaboradores->identificacion}}"
                                                                                                value="{{$resultadoColaboradores->dias_feriados_no_obligatorios}}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteFeriados" name="equivalenteFeriados"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_dias_feriados_no_obligatorios,2)}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Días vacaciones a pagar') }}
                                                                                                    <span type="button" class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_vacaciones_pagar = "";
                                                                                                    if(number_format($resultadoColaboradores->dias_vacaciones_pagar, 0) == 1){
                                                                                                        $str_vacaciones_pagar = "1 día";
                                                                                                    }else{
                                                                                                        $str_vacaciones_pagar = sprintf("%s días", number_format($resultadoColaboradores->dias_vacaciones_pagar, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="diasVacaciones" name="diasVacaciones"
                                                                                                value="{{ $str_vacaciones_pagar }}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteVacaciones" name="equivalenteVacaciones"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_dias_vacaciones_pagar,2)}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Otros rubros que suman al salario') }}
                                                                                                    <span type="button" class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Ingrese el monto">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="otrosRubrosIncrementos" name="otrosRubrosIncrementos"
                                                                                                       onChange="guardarTotalOtrosRubrosIncrementos('{{ Crypt::decrypt($idPlanilla) }}', '{{ $resultadoColaboradores->id_colaborador }}');"
                                                                                                        value="{{ number_format($resultadoColaboradores->monto_otros_rubros_incrementos, 2) }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                           id="equivalenteOtrosRubrosIncrementos" name="equivalenteOtrosRubrosIncrementos"
                                                                                                           value="{{ number_format($resultadoColaboradores->monto_otros_rubros_incrementos, 2) }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 mt-3 mt-lg-0">
                                                                                <div class="card bcard h-100">
                                                                                    <div class="card-header">
                                                                                        <span
                                                                                            class="card-title text-125 font-bold">
                                                                                            Deducciones al salario bruto
                                                                                        </span>
                                                                                    </div>

                                                                                    <div class="card-body">
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Días de incapacidad') }}
                                                                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_incapacidades = "";
                                                                                                    if(number_format($resultadoColaboradores->dias_incapacidad, 0) == 1){
                                                                                                        $str_incapacidades = "1 día";
                                                                                                    }else{
                                                                                                        $str_incapacidades = sprintf("%s días", number_format($resultadoColaboradores->dias_incapacidad, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="diasIncapacidad" name="diasIncapacidad" value="{{ $str_incapacidades }}">
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                           value="{{ number_format($resultadoColaboradores->monto_dias_incapacidad, 2, ".", ",") }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Días de licencia') }}
                                                                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_licencias = "";
                                                                                                    if(number_format($resultadoColaboradores->dias_licencias, 0) == 1){
                                                                                                        $str_licencias = "1 día";
                                                                                                    }else{
                                                                                                        $str_licencias = sprintf("%s días", number_format($resultadoColaboradores->dias_licencias, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12" value="{{ $str_licencias }}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                           value="{{ number_format($resultadoColaboradores->monto_dias_licencias, 2, ".", ",") }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Amonestaciones') }}
                                                                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_amonestaciones = "";
                                                                                                    if(number_format($resultadoColaboradores->dias_amonestaciones, 0) == 1){
                                                                                                        $str_amonestaciones = "1 día";
                                                                                                    }else{
                                                                                                        $str_amonestaciones = sprintf("%s días", number_format($resultadoColaboradores->dias_amonestaciones, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="diasAmonestaciones" name="diasAmonestaciones"
                                                                                                value="{{ $str_amonestaciones }}">
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteAmonestaciones" name="equivalenteAmonestaciones"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_dias_amonestaciones, 2, ".", ",") }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Ausencias') }}
                                                                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_ausencias = "";
                                                                                                    if(number_format($resultadoColaboradores->ausencias, 0) == 1){
                                                                                                        $str_ausencias = "1 día";
                                                                                                    }else{
                                                                                                        $str_ausencias = sprintf("%s días", number_format($resultadoColaboradores->ausencias, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                id="diasAusencias" name="diasAusencias"
                                                                                                value="{{ $str_ausencias }}">
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    id="equivalenteAusencias" name="equivalenteAusencias"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_ausencias, 2, ".", ",") }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Permisos con goce de salario') }}
                                                                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_permisos_con_goce = "";
                                                                                                    if(number_format($resultadoColaboradores->permisos, 0) == 1){
                                                                                                        $str_permisos_con_goce = "1 día";
                                                                                                    }else{
                                                                                                        $str_permisos_con_goce = sprintf("%s días", number_format($resultadoColaboradores->permisos, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12" value="{{ $str_permisos_con_goce }}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                    value="{{ number_format($resultadoColaboradores->monto_permisos, 2, ".", ",") }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mt-3">
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    {{ __('Permisos sin goce de salario') }}
                                                                                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Monto se toma desde las acciones de personal">
                                                                                                        <i class="fa-solid fa-circle-info blue"></i>
                                                                                                    </span>
                                                                                                </label>

                                                                                                @php
                                                                                                    $str_permisos_sin_goce = "";
                                                                                                    if(number_format($resultadoColaboradores->permisos_sin_goce, 0) == 1){
                                                                                                        $str_permisos_sin_goce = "1 día";
                                                                                                    }else{
                                                                                                        $str_permisos_sin_goce = sprintf("%s días", number_format($resultadoColaboradores->permisos_sin_goce, 0, ".", ","));
                                                                                                    }
                                                                                                @endphp
                                                                                                <input type="text" readonly class="form-control brc-on-focus brc-blue-m1 col-sm-12" value="{{ $str_permisos_sin_goce }}">
                                                                                            </div>
                                                                                            <div class="col-md-6 col-sm-12 text-md-left">
                                                                                                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1 mt-4 mt-md-0">
                                                                                                    Monto equivalente
                                                                                                </label>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">{{ $signo_moneda }}</span>
                                                                                                    </div>
                                                                                                    <input type="text" readonly lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                       value="{{ number_format($resultadoColaboradores->monto_permisos_sin_goce, 2, ".", ",") }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                            <div class="form-group row mt-4">
                                                                            <div class="col-sm-6"><p class="text-info font-bold text-150 float-right">Total</p></div>
                                                                            <div class="col-sm-6">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text">₡</span>
                                                                                    </div>
                                                                                    <input type="text" readonly min="0" lang="en" step="0.5"
                                                                                        value="{{ number_format($resultadoColaboradores->total_ajustes, 2, ".", ",") }}"
                                                                                        class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                        id="calculoTotal" name="calculoTotal">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                                    </div>
                                                                                </div><!-- /.card -->
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">
                                                                            Cerrar
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Salario bruto:" class='text-grey-d1 text-right text-md-center'>
                                            <span class="badge badge-primary badge-md py-2">
                                                {{ $signo_moneda }}
                                                {{ number_format($resultadoColaboradores->salario_bruto,2) }}
                                            </span>
                                        </td>
                                        <td data-label="Neto:" class='text-grey-d1 text-right text-md-center'>
                                            <div class="text-md-center">
                                                <div class="m-auto d-md-inline-block d-block align-middle">
                                                    <span class="badge badge-md mb-2 py-0">
                                                         <a href="#" data-toggle="modal"
                                                            id="btnDetallesDeducciones_{{$resultadoColaboradores->id_colaborador}}"
                                                            title="Detalle deducciones de ley"
                                                            class="btn btn-raised btn-info text-100 p-1">
                                                            {{ $signo_moneda }}
                                                            {{ number_format($resultadoColaboradores->salario_neto,2) }}
                                                            &nbsp;<i class="fa fa-eye"></i>
                                                         </a>
                                                    </span>
                                                </div>
                                                <div class="m-auto d-md-inline-block d-block align-middle">


                                                    <div class="modal fade"
                                                        id="deducciones{{$resultadoColaboradores->id_colaborador}}"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl modal-dialog-message modal-dialog-scrollable modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-blue-d2">
                                                                        Detalle de deducciones
                                                                    </h5>

                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body ace-scrollbar"
                                                                    id="deducciones{{$resultadoColaboradores->id_colaborador}}_detalle">

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">
                                                                        Cerrar
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Adelanto de salario:"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <span class="badge badge-primary badge-md py-2">
                                                {{ $signo_moneda }}
                                                {{ number_format($resultadoColaboradores->salario_adelanto,2) }}
                                            </span>
                                        </td>
                                        <td data-label="Otras deducciones:"
                                            class='text-right text-md-center'>
                                            <div class="text-md-center">

                                                <div class="m-auto d-md-inline-block d-block align-middle">
                                                   <span class="badge badge-md mb-2 py-0">
                                                        <a href="#" data-toggle="modal"
                                                            id="btnDetallesOtrasDeducciones_{{$resultadoColaboradores->id_colaborador}}"
                                                            title="Datos de Otros Ajustes"
                                                            class="btn btn-raised btn-info text-100 p-1">
                                                            {{ $signo_moneda }}
                                                            {{ number_format($resultadoColaboradores->total_final_otros,2) }}
                                                            <i class="fa fa-gear"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="m-auto d-md-inline-block d-block align-middle">

                                                    <form action="#"
                                                        id="formDeducciones{{$resultadoColaboradores->id_colaborador}}">
                                                        <div class="modal fade"
                                                            id="otrasDeducciones{{$resultadoColaboradores->identificacion}}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl modal-dialog-message modal-dialog-scrollable modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-blue-d2">
                                                                            Datos de Otros Ajustes
                                                                        </h5>
                                                                    </div>
                                                                    <hr class="border-6">
                                                                    <div class="container-fluid mt-n3 mb-n3">
                                                                        <div role="button" class="d-style border-1 bgc-primary-l4 brc-primary-m3 px-3 pt-25 pb-1 pos-rel shadow-sm overflow-hidden radius-1 text-justify">
                                                                            <p class="text-grey pos-rel">
                                                                                En ésta pantalla puede realizar ajustes al pago del colaborador, aquí puede realizar un aumento o una deducción
                                                                                que no contemplan deducciones de ley (CCSS y RENTA). Por ejemplo alguna compensación adicional al salario o bien
                                                                                alguna deducción relacionados a préstamos, rebajas de algo en particular que sume o aumente el monto.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body ace-scrollbar">
                                                                        <div class="form-group row mt-3">
                                                                            <div class="col-md-12">
                                                                                <div class="card bcard h-100">
                                                                                    <div class="card-header">
                                                                                        <div class="form-group w-100 mx-lg-2">
                                                                                            <div class="row mt-3 px-1 d-flex justify-content-start">
                                                                                                <div
                                                                                                    class="col-xl-4 col-lg-6 px-lg-2 mt-2 mt-lg-0">
                                                                                                    <label
                                                                                                        for="id-form-field-focus-1"
                                                                                                        class="mb-0 text-blue-m1">Concepto</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control brc-on-focus brc-blue-m1 col-sm-12"
                                                                                                        id="conceptoDetalle{{$resultadoColaboradores->id_colaborador}}"
                                                                                                        name="conceptoDetalle{{$resultadoColaboradores->id_colaborador}}">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-xl-3 col-lg-6 px-lg-2 mt-2 mt-lg-0">
                                                                                                    <label
                                                                                                        for="id-form-field-focus-1"
                                                                                                        class="mb-0 text-blue-m1">Acción</label>
                                                                                                    <select
                                                                                                        data-placeholder="Seleccione una opción..."
                                                                                                        class="chosen-select form-control"
                                                                                                        id="tipo{{$resultadoColaboradores->id_colaborador}}"
                                                                                                        name="tipo{{$resultadoColaboradores->id_colaborador}}">
                                                                                                        <option
                                                                                                            value="incremento">
                                                                                                            Incrementa
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="deduccion">
                                                                                                            Deducción
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-xl-3 col-lg-6 px-lg-2 mt-2 mt-lg-0">
                                                                                                    <label
                                                                                                        for="id-form-field-focus-1"
                                                                                                        class="mb-0 text-blue-m1">
                                                                                                        Monto</label>
                                                                                                    <div
                                                                                                        class="input-group">
                                                                                                        <div
                                                                                                            class="input-group-prepend">
                                                                                                            <span
                                                                                                                class="input-group-text">₡</span>
                                                                                                        </div>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            min="0"
                                                                                                            lang="en"
                                                                                                            step="0.5"
                                                                                                            class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input"
                                                                                                            id="montoOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}"
                                                                                                            name="montoOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-auto col-xl-2 align-self-end px-lg-2  mt-2 mt-lg-0">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        id="btnOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}"
                                                                                                        class="btn btn-outline-info btn-text-dark btn-h-info btn-a-info btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mt-4 mt-md-0">
                                                                                                        <span class="bgc-info h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                                                                            <i class="fa fa-plus mr-1 text-white text-100 mt-3px"></i>
                                                                                                        </span>
                                                                                                        <span>Agregar</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        id="otrasDeducciones{{$resultadoColaboradores->id_colaborador}}_detalle">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">
                                                                            Cerrar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Salario devengado:"
                                            class='text-grey-d1 text-right text-md-center'>
                                            <span class="badge badge-primary badge-md py-2">
                                                {{ $signo_moneda }}
                                                {{ number_format($resultadoColaboradores->salario_devengado,2) }}
                                            </span>
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

</div>

   <!-- with white backdrop -->
            <div class="modal fade" data-backdrop-bg="bgc-white" id="dangerModal" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
              <div class="modal-dialog " role="document">
                <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                  <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                    <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                      ADVERTENCIA!
                    </h5>

                    <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="text-150">&times;</span>
                    </button>
                  </div>


                  <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                    <div class="d-flex align-items-top mr-2 mr-md-5">
                      <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                      <div class="text-secondary-d2 text-105">
                       Error en los datos
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer bgc-white-tp2 border-0">
                    <button type="button" class="btn px-4 btn-danger" id="id-danger-yes-btn" data-dismiss="modal">
                      Cerrar
                    </button>
                  </div>
                </div>
              </div>
            </div>
@include('componentes.paginacion')


<input type="text" value="{{$idPlanilla}}" id="idPlanilla" hidden>

@foreach($resultado as $resultadoColaboradores)
    <script type="module">
        $('#guardar{{$resultadoColaboradores->id_colaborador}}').on('click',function(evt)
        {
            waitingDialog.show();

            let horas_normal = $("#horaNormal_{{$resultadoColaboradores->identificacion}}_extra").val();
            let horas_extra = $("#horaExtra_{{$resultadoColaboradores->identificacion}}_extra").val();
            let horas_doble = $("#horaDoble_{{$resultadoColaboradores->identificacion}}_extra").val();
            let horas_feriado = $("#horaFeriado_{{$resultadoColaboradores->identificacion}}_extra").val();
            let horas_feriado2 = $("#horaFeriado2_{{$resultadoColaboradores->identificacion}}_extra").val();
            let id_colaborador = {{$resultadoColaboradores->id_colaborador}};
            let id_planilla = {{Crypt::decrypt($idPlanilla)}};

            $.ajax({
                method:'GET',
                url: "{{ route('registrarPlanillaExtras') }}",
                data:{'horas_normal':horas_normal,'horas_extra':horas_extra,'horas_doble':horas_doble,'horas_feriado':horas_feriado,
                    'dias_feriados_no_obligatorios':horas_feriado2,'id_colaborador':id_colaborador,'id_planilla':id_planilla},
                success: (response) => {
                    if(response==1)
                    {
                        mostrarAlertaExito('Las horas fueron guardadas para el colaborador con éxito');
                    }
                    else
                    {
                        mostrarAlertaError(response[0],response[1]);
                    }
                },
                error: function(response){
                    alert(response.responseJSON.message);
                },
                complete: function (response)
                {
                    waitingDialog.hide();
                }
            });
        });

        $('#btnDetallesDeducciones_{{$resultadoColaboradores->id_colaborador}}').on('click',function(evt)
        {
            waitingDialog.show();
            $.ajax({
                type:'get',
                url: "{{ route('obtenerDetalleDeducciones.show', [$idPlanilla,$resultadoColaboradores->id_colaborador,$resultadoPlanilla->moneda]) }}",
                success: (response) => {
                    $("#deducciones{{$resultadoColaboradores->id_colaborador}}_detalle").empty().append(response);
                    $('#deducciones{{$resultadoColaboradores->id_colaborador}}').modal('show');
                },
                error: function(response){
                    alert(response);
                },
                complete: function (response)
                {
                    waitingDialog.hide();
                }
            });
        });

        $('#btnDetallesOtrasDeducciones_{{$resultadoColaboradores->id_colaborador}}').on('click',function(evt)
        {
            waitingDialog.show();
            $.ajax({
                type:'get',
                url: "{{ route('obtenerDetalleOtrasDeducciones.show', [$idPlanilla,$resultadoColaboradores->id_colaborador,$resultadoColaboradores->total_final_otros]) }}",
                success: (response) => {
                    $("#otrasDeducciones{{$resultadoColaboradores->id_colaborador}}_detalle").empty().append(response);
                    $('#otrasDeducciones{{$resultadoColaboradores->identificacion}}').modal('show');
                },
                error: function(response){
                    alert(response);
                },
                complete: function (response)
                {
                    waitingDialog.hide();
                }
            });
        });

        $('#formDeducciones{{$resultadoColaboradores->id_colaborador}}').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                conceptoDetalle{{$resultadoColaboradores->id_colaborador}}: {
                    required: true
                },
                montoOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}: {
                    required: true
                }
            },

            messages: {
                conceptoDetalle{{$resultadoColaboradores->id_colaborador}}: {
                    required: "Este campo es requerido."
                },
                montoOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $('#btnOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}').on('click',function(evt)
        {
            if($('#formDeducciones{{$resultadoColaboradores->id_colaborador}}').valid())
            {
                $('#otrasDeducciones{{$resultadoColaboradores->identificacion}}').modal('hide');
                waitingDialog.show();

                let id_planilla = {{Crypt::decrypt($idPlanilla)}};
                let id_colaborador = {{$resultadoColaboradores->id_colaborador}};
                let id_moneda = {{$resultadoPlanilla->id_moneda}};
                let tipo = $("#tipo{{$resultadoColaboradores->id_colaborador}}").val();
                let concepto = $("#conceptoDetalle{{$resultadoColaboradores->id_colaborador}}").val();
                let monto = $("#montoOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}").val();

                $.ajax({
                    method:'GET',
                    url: "{{ route('guardarDetalleOtrasDeducciones.create') }}",
                    data:{
                        'id_colaborador':id_colaborador,
                        'id_planilla':id_planilla,
                        'id_moneda':id_moneda,
                        'tipo':tipo,
                        'concepto':concepto,
                        'monto':monto
                    },
                    success: (response) => {
                        if(response==1)
                        {
                            mostrarAlertaExito('Se realizaron los ajustes para el colaborador');
                            $.ajax({
                                type:'get',
                                url: "{{ route('generarPlanilla.show', [$idPlanilla]) }}",
                                data:{'cantidad':{{$cantidad}},'paginaActual':{{$paginaActual}},
                                    'buscar':'{{$buscar}}','orden':'{{$orden}}','tipo_orden':'{{$tipo_orden}}'},
                                success: (response) => {
                                    $("#tablas").empty().append(response);
                                },
                                error: function(response){
                                    alert(response);
                                },
                                complete: function (response)
                                {
                                    waitingDialog.hide();
                                }
                            });
                        }
                        else
                        {
                            mostrarAlertaError(response[0],response[1]);
                            $('#otrasDeducciones{{$resultadoColaboradores->identificacion}}').modal('show');
                        }
                    },
                    error: function(response){
                        alert(response.responseJSON.message);
                    },
                    complete: function (response)
                    {
                        waitingDialog.hide();
                    }
                });
            }
            else{
                return false;
            }
        });
    </script>
@endforeach

<!--script de cambio de boton generar-->
<script>
    $(document).ready(function() {
        $('.spinner_hide').hide();
        $('#guardarFeriados').click(function()
        {
            waitingDialog.show();

            $.ajax({
                type:'get',
                url: "{{ route('generarPlanilla.show', [$idPlanilla]) }}",
                data:{'cantidad':{{$cantidad}},'paginaActual':{{$paginaActual}},
                    'buscar':'{{$buscar}}','orden':'{{$orden}}','tipo_orden':'{{$tipo_orden}}'},
                success: (response) => {
                    $("#tablas").empty().append(response);
                },
                error: function(response){
                    alert(response);
                },
                complete: function (response)
                {
                    waitingDialog.hide();
                }
            });

            $('#headingOne').removeClass('d-none');
            $('#headingTwo').removeClass('d-inline-block');
        });

        $('#btn2').click(function()
        {
            $('#headingTwo').addClass('d-inline-block');
            $('#headingOne').addClass('d-none');
        });



        var guardar_row_fuera = false; // Variable para almacenar la fila activa
        // Variable para almacenar la fila activa
        var filaActiva = null;
        $('#simple-table-horas').on('click', 'tr', function () {
            // Obtén la referencia de la fila en la que se hizo clic
            var fila = $(this);
            if(filaActiva){
                var fila_id = $(this).data('id-dr');
                var filaActiva_id=filaActiva.data('id-dr');
                // Si ya había una fila activa, quita cualquier estilo o realiza acciones necesarias
                if (fila_id != filaActiva_id && filaActiva_id !=0) {
                    var hora_normal=filaActiva.find('td:eq(4) input').val();
                    var hora_extra=filaActiva.find('td:eq(5) input').val();
                    var hora_doble=filaActiva.find('td:eq(6) input').val();
                    var feriados_pago=filaActiva.find('td:eq(7) input').val();
                    var feriados_no_pago=filaActiva.find('td:eq(8) input').val();
                    let id_planilla = {{Crypt::decrypt($idPlanilla)}};
                    $("#check"+filaActiva_id).removeClass("fa-solid fa-circle-check");
                    $("#check"+filaActiva_id).addClass("fa-solid fa-circle-notch fa-spin");
                    // MensajeExito('Las horas fueron guardadas para el colaborador con éxito');
                    $("#info"+filaActiva_id).removeClass("btn-light-grey");
                    $("#info"+filaActiva_id).addClass("btn-light-green");
                    $.ajax({
                        method:'GET',
                        url: "{{ route('registrarPlanillaExtras') }}",
                        data:{'horas_normal':hora_normal,'horas_extra':hora_extra,'horas_doble':hora_doble,'horas_feriado':feriados_pago,
                            'dias_feriados_no_obligatorios':feriados_no_pago,'id_colaborador':filaActiva_id,'id_planilla':id_planilla},
                        success: (response) => {
                            if(response==1)
                            {
                                $("#check"+filaActiva_id).removeClass("fa-solid fa-circle-notch fa-spin");
                                $("#check"+filaActiva_id).addClass("fa-solid fa-circle-check");
                            }
                            else
                            {
                                mostrarAlertaError(response[0],response[1]);
                            }
                        },
                        error: function(response){
                            alert(response.responseJSON.message);
                        },
                        complete: function (response)
                        {

                        }
                    });
                }
            }

            // Actualiza la fila activa
            filaActiva = fila;
            guardar_row_fuera=true;

            // Ahora puedes acceder a 'fila' en cualquier parte de tu código para obtener información sobre la fila que se hizo clic.
        });

        $(document).click(function(event) {
            // Verifica si el clic ocurrió fuera de las filas
            if($(event.target).closest("tr").length===0){
                if(!filaActiva){
                    return;
                }
                if(guardar_row_fuera){
                    var filaActiva_id=filaActiva.data('id-dr');
                    if(filaActiva_id!=0){
                        var hora_normal=filaActiva.find('td:eq(4) input').val();
                        var hora_extra=filaActiva.find('td:eq(5) input').val();
                        var hora_doble=filaActiva.find('td:eq(6) input').val();
                        var feriados_pago=filaActiva.find('td:eq(7) input').val();
                        var feriados_no_pago=filaActiva.find('td:eq(8) input').val();
                        let id_planilla={{Crypt::decrypt($idPlanilla)}};
                        $("#check"+filaActiva_id).removeClass("fa-solid fa-circle-check");
                        $("#check"+filaActiva_id).addClass("fa-solid fa-circle-notch fa-spin");
                        // MensajeExito('Las horas fueron guardadas para el colaborador con éxito');
                        $("#info"+filaActiva_id).removeClass("btn-light-grey");
                        $("#info"+filaActiva_id).addClass("btn-light-green");
                        $.ajax({
                            method: 'GET',
                            url: "{{ route('registrarPlanillaExtras') }}",
                            data: {
                                'horas_normal': hora_normal,
                                'horas_extra': hora_extra,
                                'horas_doble': hora_doble,
                                'horas_feriado': feriados_pago,
                                'dias_feriados_no_obligatorios': feriados_no_pago,
                                'id_colaborador': filaActiva_id,
                                'id_planilla': id_planilla
                            },
                            success: (response)=>{
                                if(response==1){
                                    $("#check"+filaActiva_id).removeClass("fa-solid fa-circle-notch fa-spin");
                                    $("#check"+filaActiva_id).addClass("fa-solid fa-circle-check");
                                }else{
                                    mostrarAlertaError(response[0], response[1]);
                                }
                            },
                            error: function(response){
                                alert(response.responseJSON.message);
                            },
                            complete: function(response){
                                guardar_row_fuera=false;
                                filaActiva=null;
                            }
                        });
                    }
                }
            }
        });
    });

    function guardarTotalOtrosRubrosIncrementos(idPlanilla, idColaborador){
        var totalOtrosRubrosIncrementos = parseFloat($("#otrosRubrosIncrementos").val()).toFixed(2);

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_path + "/guardarTotalOtrosRubrosIncrementos",
            data: "accion=guardarOtrosRubros&idPlanilla=" + idPlanilla + "&idColaborador=" + idColaborador + "&monto=" + totalOtrosRubrosIncrementos,
            global: false,
            beforeSend: function() {
                waitingDialog.show();
            },
            success: function(respuesta){
                $("#equivalenteOtrosRubrosIncrementos").val(totalOtrosRubrosIncrementos);

                if(respuesta == "ok"){
                    mensaje_swal("success", "Se ha guardado el valor ingresado", function(){
                        fn_reload();
                    });
                }else{
                    mensaje_swal("error", "Se ha presentado un error al guardar el valor", function(){
                        fn_reload();
                    });
                }
            },
            complete: function(response) {

            },
            error: function (response) {
                alert(response.responseJSON.message);
            }
        });
    }
</script>
<script type="module">
    $(document).ready(function() {
        if ($('.number-input').length) {
            var numberInput = document.getElementsByClassName('number-input');
            for(var i = 0; i < numberInput.length; i++){
                numberInput[i].addEventListener('keydown', function (evt) {
                    !/(^\d*\.?\d*$)|(Backspace|Control|Meta)/.test(evt.key) && evt.preventDefault();

                    if($(this).val().includes("."))
                    {
                        var e = evt || window.evt;
                        var key = e.keyCode || e.which;

                        if ( key === 110 || key === 190 || key === 188 ) {

                            evt.preventDefault();
                        }
                    }
                });
            }
        }

        var magnific = $('.ajax-popup-link').magnificPopup({
            type: 'ajax',
            fixedContentPos: true,
            showCloseBtn: true,
            closeBtnInside: false
        });
    });
</script>

