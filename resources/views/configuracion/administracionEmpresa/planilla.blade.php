<form class="mt-lg-3" id="form-planilla" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Planilla" hidden/>
    <input type="text" name="tab" value="ajustePlanilla-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="input-group col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('País') }} </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" data-name_error="País" id="id_pais" name="id_pais">
                @foreach($catalogoPaises as $paises)
                    @php $opcion=""; @endphp
                    @isset($resultadoPlanilla->id_pais)
                        @if($paises->id_pais == $resultadoPlanilla->id_pais)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset
                    <option value="{{ $paises->id_pais }}" {{$opcion}}>{{ $paises->codigo.'-'.$paises->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de planilla') }}</label>
            <div class="input-group">
                <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple data-name_error="Tipo de planilla" id="selectpicker1" name="id_tipos_planilla[]">
                    @php
                        $mensual ="";
                    @endphp
                    @foreach($catalogoTipoPlanilla as $datos)
                        @php
                            $opcion = "";
                        @endphp
                        @isset($resultadoPlanilla->id_tipos_planilla)
                            @php
                                $planillas = explode(",", $resultadoPlanilla->id_tipos_planilla);
                            @endphp

                            @foreach($planillas as $planilla)
                                @if($datos->id_tipo_planilla == $planilla)
                                    @if($planilla==2)
                                        @php
                                            $mensual ="si";
                                        @endphp
                                    @endif

                                    @php
                                        $opcion = "selected";
                                    @endphp
                                @endif
                            @endforeach
                        @endisset
                        <option value="{{ $datos->id_tipo_planilla }}" {{$opcion}}>{{ $datos->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }} </label>
            <div class="input-group">
                <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple data-name_error="Moneda" id="selectpicker2" name="id_monedas[]">
                    @foreach($catalogoMonedas as $datos)
                        @php
                            $opcion = "";
                        @endphp
                        @isset($resultadoPlanilla->id_monedas)
                            @php
                                $monedas = explode(",", $resultadoPlanilla->id_monedas);
                            @endphp

                            @foreach($monedas as $moneda)
                                @if($datos->id_moneda == $moneda)
                                    @php
                                        $opcion = "selected";
                                    @endphp
                                @endif
                            @endforeach
                        @endisset
                        <option value="{{ $datos->id_moneda }}" {{$opcion}}>{{ $datos->leyenda }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <br>
            <a href="#" class="btn px-4 btn-light-success font-bolder btn-brc-tp mb-1" data-toggle="modal" data-target="#deduccionPatronal">Ver deducciones patronales</a>
        </div>
    </div>

    <div class="form-group row mt-4" id="divTipoPago" @if($mensual=="") style="display: none;" @endif>
        <!-- tipo de pago  -->
        <div class="mt-2 col-lg-4 col-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="El tipo de pago es definido únicamente para la planilla mensual, para indicar si el pago puede ser con o sin adelanto.">
                                        <i class="fa-solid fa-circle-info blue"></i>
                                    </span>
                {{ __('Tipo de pago') }}
            </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control mt-1" id="id_tipo_pago" name="id_tipo_pago" onchange="opcionSeleccionada()">
                @foreach($catalogoTiposPago as $tipoPago)
                    @php $opcion=""; @endphp
                    @isset($resultadoPlanilla->id_tipo_pago)
                        @if($tipoPago->id_tipo_pago == $resultadoPlanilla->id_tipo_pago)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset
                    <option value="{{ $tipoPago->id_tipo_pago }}" {{$opcion}}>{{ $tipoPago->codigo.'-'.$tipoPago->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-1 col-lg-4 col-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1" data-toggle="tooltip" data-placement="top" title=" {{ __('Porcentaje del salario base en el adelanto ') }} ">
                                     <span class="d-inline-block text-truncate" style="max-width: 203px;">
                                    {{ __('Porcentaje del salario base en el adelanto ') }}
                                    </span>
            </label>
            <div class="input-group justify-content-center">
                <input type="number" placeholder="0,00" @isset($resultadoPlanilla->id_tipo_pago) @if($resultadoPlanilla->id_tipo_pago!=1) disabled @endif @endisset lang="en" data-name_error="Porcentaje del salario base en el adelanto" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="porcentaje_salario_adelanto" name="porcentaje_salario_adelanto" value="{{ old('porcentaje_salario_adelanto') ?? $resultadoPlanilla->porcentaje_salario_adelanto ??""}}"/>
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
        <div id="cargas_sociales" class="mt-2 col-lg-4 col-12 @isset($resultadoPlanilla->id_tipo_pago) @if($resultadoPlanilla->id_tipo_pago!=1) d-none @endif @endisset">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1" data-toggle="tooltip" data-placement="top" title=" Cálcular cargas sociales y renta a rebajar con el adelanto de salario">

                                    <span class="d-inline-block">
                                   Cargas sociales y renta en adelanto...
                                    </span>
            </label>
            <br>
            <div class="form-check form-check-inline">
                <div class="">
                    <label>
                        <input type="radio" @isset($resultadoPlanilla->aplicar_cargas_renta_adelanto) @if($resultadoPlanilla->aplicar_cargas_renta_adelanto =="si") checked @endif @endisset name="form-field-select-cargas" id="inlineRadio1" value="Si" class="mr-1">
                        Si
                    </label>
                </div>
            </div>
            <div class="form-check form-check-inline">
                <div class="my-1">
                    <label>
                        <input type="radio" @isset($resultadoPlanilla->aplicar_cargas_renta_adelanto) @if($resultadoPlanilla->aplicar_cargas_renta_adelanto =="no") checked @endif @endisset  name="form-field-select-cargas" id="inlineRadio2" value="No" class="mr-1">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 d-none">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje de cargas sociales y renta a rebajar en adelanto') }} </label>
            <div class="input-group justify-content-center">
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="porcentaje_cargas_adelanto" name="porcentaje_cargas_adelanto" value="{{ old('porcentaje_cargas_adelanto') ?? $resultadoPlanilla->porcentaje_cargas_adelanto ??"0.00"}}"/>
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 d-none">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje de otras deducciones no grabables en adelanto') }} </label>
            <div class="input-group justify-content-center">
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="porcentaje_deducciones_adelanto" name="porcentaje_deducciones_adelanto" value="{{ old('porcentaje_deducciones_adelanto') ?? $resultadoPlanilla->porcentaje_deducciones_adelanto ??"0.00"}}"/>
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="mt-2 col-lg-3 col-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Años de cesantía?') }} </label>
            <input type="text" lang="en" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 number-input mt-1" data-name_error="¿Años de cesantía?" id="anios_cesantia" name="anios_cesantia" value="{{ old('aniosCesantia') ?? $resultadoPlanilla->anios_cesantia ??""}}"/>
        </div>
        <div class="mt-2 col-lg-3 col-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Número patrono CCSS') }} </label>
            <input type="text" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 mt-1" id="numero_patrono_ccss" data-name_error="Número patrono CCSS" name="numero_patrono_ccss" readonly value="{{ old('numero_patrono_ccss') ?? $resultadoEmpresa->identificacion ??""}}"/>
        </div>
    </div>
    <br>
    <h3 class="card-title text-125 text-green-m2">
        <i class="nav-icon fa-solid fa-file-invoice text-green-m2"></i>
        {{ __('Configuración planilla RT virtual') }}
    </h3>
    <hr>
    <div class="form-group row mt-4">
        <div class="col-sm-12">
            <div class="alert bgc-white shadow-sm brc-info-m2 border-none border-l-5 radius-0 d-flex align-items-center" role="alert">
                <i class="fas fa-info-circle mr-3 fa-2x text-info-m3"></i>
                <div id="alerta_incapacidad">
                    <a href="{{ asset('files/config_empresa/Plantillas para presentacion de planillas.rar') }}" class="alert-link text-primary-d2">
                        Descargar la nueva planilla del INS
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="mt-2 col-lg-6 col-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Número póliza INS') }} </label>
            <input type="text" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12 mt-1" id="numero_poliza_ins" data-name_error="Número póliza INS" name="numero_poliza_ins" value="{{ old('numero_poliza_ins') ?? $resultadoEmpresa->identificacion ??""}}"/>
        </div>
        <div class="mt-2 col-lg-4 col-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Porcentaje póliza INS') }} </label>
            <div class="input-group justify-content-center">
                <input type="number" placeholder="0,00" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="porcentaje_poliza_ins" data-name_error="Porcentaje póliza INS" name="porcentaje_poliza_ins" value="{{ old('porcentaje_poliza_ins') ?? $resultadoPlanilla->porcentaje_poliza_ins ??""}}"/>
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="form-group row mx-1 mt-4">--}}

{{--            <div class="alert bgc-primary-l4 brc-primary-m4 d-flex align-items-center text-dark-tp2" role="alert">--}}
{{--                <i class="fas fa-info-circle mr-3 fa-2x text-blue"></i>--}}

{{--                <div>--}}
{{--                    <a href="#" class="alert-link text-primary-d2">--}}
{{--                        Descargar la nueva planilla del INS--}}
{{--                    </a>.--}}

{{--                </div>--}}
{{--            </div>--}}

{{--    </div>--}}
    <br>
    <h3 class="card-title text-125 text-green-m2">
        <i class="nav-icon fa fa-clock text-green-m2"></i>
        {{ __('Vacaciones') }}
    </h3>
    <hr>
    <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
        <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
        <tr>
            <th scope="col" class="text-left text-md-center align-middle">
                Rango de años
            </th>
            <th scope="col" class="text-left text-md-center align-middle">
                Factor
            </th>
            <th scope="col" class="text-left text-md-center align-middle">
                Descripción
            </th>
        </tr>
        </thead>
        <tbody class="mt-1">
        <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango1" name="rango1" value="0-5"/>
            </td>
            <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor1" name="factor1" value="0.833"/>
            </td>
            <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 0.833) = 10 días.
            </td>
        </tr>
        <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango2" name="rango2" value="5-10"/>
            </td>
            <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor2" name="factor2" value="1"/>
            </td>
            <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1) = 12 días.
            </td>
        </tr>
        <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango3" name="rango3" value="10-15"/>
            </td>
            <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor3" name="factor3" value="1.2"/>
            </td>
            <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 1.2) = 15 días.
            </td>
        </tr>
        <tr class="bgc-h-blue-l4 d-style">
            <td data-label="Rango de años:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="rango4" name="rango4" value="15-60"/>
            </td>
            <td data-label="Factor:" class='text-grey-d1 text-right text-md-center small'>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="factor4" name="factor4" value="2"/>
            </td>
            <td data-label="Descripción:" class='text-grey-d1 text-right text-md-center small'>
                Si el colaborador tiene 1 un año de trabajar dispone de (12 meses por 2) = 24 días.
            </td>
        </tr>
        </tbody>
    </table>

    <h3 class="card-title text-125 text-green-m2 mt-4">
        <i class="nav-icon fa fa-children text-green-m2"></i>
        {{ __('Créditos familiares') }}
    </h3>
    <hr>
    <div class="table-responsive border-t-3 brc-blue-m2 mt-2">
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class="border-b-1 brc-default-l3 bgc-blue-l4">
            <!-- <tr>
                <th class="text-center" colspan="3">
                    Créditos familiares
                </th>
            </tr> -->
            <tr>

                <th class="text-center">
                    Relación
                </th>

                <th class="text-center">
                    Monto Mensual
                </th>

                <th class='text-center'>
                    Monto Anual
                </th>
            </tr>
            </thead>

            <tbody class="mt-1">

            <tr class="bgc-h-blue-l4 d-style">

                <td class='text-center'>
                    Cónyugue
                </td>

                <td class='text-grey-d1'>
                    <div class="input-group justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₡ {{number_format($resultado->monto_mensual_conyuge,2)}}</span>
                        </div>
                    </div>
                </td>

                <td class='text-grey-d1'>
                    <div class="input-group justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₡ {{number_format($resultado->monto_anual_conyuge,2)}}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="bgc-h-blue-l4 d-style">

                <td class='text-center'>
                    Hijo
                </td>

                <td class='text-grey-d1'>
                    <div class="input-group justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₡ {{number_format($resultado->monto_mensual_hijo,2)}}</span>
                        </div>
                    </div>
                </td>

                <td class='text-grey-d1'>
                    <div class="input-group justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₡ {{number_format($resultado->monto_anual_hijo,2)}}</span>
                        </div>
                    </div>
                </td>

            </tr>

            </tbody>
        </table>
    </div>

    <div class="modal fade " id="deduccionPatronal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-blue-d2">
                        Deducciones patronales por ley </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ace-scrollbar">
                    <br>Las deducciones son montos establecidos por ley, por lo tanto no son modificables.<br><br>
                    <div class="table-responsive">
                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                            <tr>
                                <th class="text-center" rowspan="2" style="vertical-align : middle;text-align:center;">
                                    Deducciones Patronales
                                </th>
                                <th scope="col" class="text-left text-md-center small align-middle">
                                    Contribuciones
                                </th>
                            </tr>
                            </thead>
                            <tbody class="mt-1">
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    Base mínima de cotización vigente
                                </td>
                                <td class='text-grey-d1'></td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    CCSS S.E.M
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="9.25" min="0.00" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="ccssSEM" name="ccssSEM"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    IVM Patronal
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="5.08" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="IVMPatronal" name="IVMPatronal"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    A.S.F.A
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="5.00" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="ASFA" name="ASFA"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    Cuota patronal banco popular
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="0.25" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="CuotaBP" name="CuotaBP"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    I.M.A.S.
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="0.50" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="IMAS" name="IMAS"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    I.N.A.
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="1.50" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="INA" name="INA"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    LPT Banco Popular patrono
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="0.25" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="LPTBPPatrono" name="LPTBPPatrono"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    LPT Banco Popular obrero
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="1.00" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="LPTBPObrero" name="LPTBPObrero"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    LPT INS
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="1.00" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="LPTINS" name="LPTINS"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    FCL
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="3.00" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="FCL" name="FCL"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    Pensión complementaria obligatoria
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="0.50" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="pensionComplementaria" name="pensionComplementaria"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style table-primary">
                                <td class="text-grey-d1 font-bolder">
                                    Total empresa
                                </td>
                                <td class='text-grey-d1 text-center font-bolder'>
                                    <label id="Patrono" name="Patrono">
                                        27.33%
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
                            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                            <tr>
                                <th class="text-center" rowspan="2" style="vertical-align : middle;text-align:center;">
                                    Deducciones a Colaboradores
                                </th>
                                <th class="text-center">
                                    Contribuciones
                                </th>
                            </tr>
                            </thead>
                            <tbody class="mt-1">
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    CCSS S.E.M
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="5.50" min="0.00" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="ccssSEMColaborador" name="ccssSEMColaborador"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    CCSS IVM
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="3.84" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="CCSSIVM" name="CCSSIVM"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style">
                                <td class="text-grey-d1">
                                    Banco Popular
                                </td>
                                <td class='text-grey-d1'>
                                    <div class="input-group justify-content-center">
                                        <input type="text" value="1.00" min="0" lang="en" class="form-control brc-on-focus brc-blue-m1 col-sm-3 number-input text-right" id="bancoPopular" name="bancoPopular"/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bgc-h-blue-l4 d-style table-primary">
                                <td class="text-grey-d1 font-bolder">
                                    Total Colaborador
                                </td>
                                <td class='text-grey-d1 text-center font-bolder'>
                                    <label id="Colaborador" name="Colaborador">
                                        10.34%
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class="alert alert-info font-bolder">
                        Total general:
                        <label id="TotalGeneral" name="TotalGeneral">
                            37.67%
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="{{ url()->previous() }}" class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Cancelar
            </a>
            <button type="button" id="registrarplanilla" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                    <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Guardar
            </button>
        </div>
    </div>
    <div class="modal fade" id="confirmModalPlanilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                        Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Desea guardar datos de planilla para la empresa?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" id="guardar-planilla" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@if(file_exists(public_path('js/scripts/admin/config_empresa_planilla.min.js')))
    <script src="{{ asset('js/scripts/admin/config_empresa_planilla.min.js') }}?t={{ filemtime(public_path('js/scripts/admin/config_empresa_planilla.min.js')) }}"></script>
@endif

