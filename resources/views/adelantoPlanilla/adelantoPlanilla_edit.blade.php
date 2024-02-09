@extends('Layouts.menu')

@section('head')
    <meta name="csrf_token" id="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('page-content')
    <div class="d-flex flex-column flex-lg-row justify-content-start justify-content-lg-between align-items-end">
        <div class="col-lg-2 px-0">
            <div class="row">

                <div class="form-group col-12 col-lg mb-0 mt-1 mt-md-0">
                    <label class="text-primary-d1 text-95">Total de adelanto</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="spanSignoMoneda input-group-text">
                            @if($moneda == "colones")
                                {{'₡'}}
                            @else
                                {{'$'}}
                            @endif
                        </span>
                        </div>
                        <input type="text" class="form-control" value="{{ number_format($planillaTotalAdelanto, 2, ".", " ") }}" readonly/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 my-2 my-lg-0 px-0 px-lg-2 text-nowrap">

            <span class="mt-35">
                <a href="#" data-toggle="modal" data-target="#descargatxt" class="mr-1 btn px-2 btn-light-orange font-bolder letter-spacing text-95">
                   <!-- <i class="fa fa-file-invoice-dollar text-110 text-orange-d2 mr-1"></i>-->
                    Archivo Bancario
                </a>
            </span>

            <span class="mt-35">
                <a href="#" data-toggle="modal" data-target="#cierrePlanilla" class="mr-1 btn px-2 btn-light-primary font-bolder letter-spacing text-95">
                  <!--  <i class="fa fa-check text-110 text-info-d2 mr-1"></i>-->
                    Cerrar adelanto
                </a>
            </span>
        </div>
        <div class="col-lg-4 text-nowrap px-0 px-lg-2   pl-md-2">
            <div class="d-inline-flex float-right ml-sm-0">
                <div class="d-flex flex-row-reverse">
                    <div class="px-1">
                        <div class="d-inline-flex dropdown dd-backdrop dd-backdrop-none-lg h-100" data-display="static">
                            <input type="text" class="form-control mr-n3 pr-5 h-100" placeholder="Filtros de búsqueda" readonly/>

                            <a data-display="static" href="#" class="align-self-center btn border-0 btn-outline-default py-1 px-2 btn-h-light-primary btn-a-light-primary radius-1 ml-n35" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"></i>
                            </a>

                            <div style="width: 24rem; max-width: 90vw;" data-display="static" class="shadow radius-1 p-0 dropdown-menu dropdown-animated animated-2 dd-slide-up dd-slide-none-lg dropdown-menu-right brc-primary-m3 mt-lg-1 mr-lg-n2 dropdown-caret">
                                <div class="dropdown-inner">
                                    <h5 class="bgc-secondary-l3 text-secondary-d3 d-md-none text-center mb-2 py-25">
                                        Filtros de búsqueda
                                    </h5>

                                    <form class="dropdown-clickable text-grey-d2" autocomplete="off" method="GET" action="{{ Request::url() }}">
                                        @csrf
                                        <div class="dropdown-body my-25 px-3">
                                            <div class="px-2 px-md-3">
                                                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar ..." />
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Ordenar por:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="orden">
                                                    <option value="nombre" @if($orden=="nombre") selected @endif>Nombre</option>
                                                    <option value="identificacion" @if($orden=="identificacion") selected @endif>Identificación</option>
                                                </select>
                                            </div>

                                            <hr class="brc-default-l3" />

                                            <div class="d-flex align-items-center px-2 px-md-3">
                                                <div class="mr-4">Tipo de orden:</div>
                                                <select class="ace-select text-secondary-d2 no-border brc-h-blue-m3" name="tipo_orden">
                                                    <option value="ASC" @if($tipo_orden=="ASC") selected @endif>Ascendente</option>
                                                    <option value="DESC" @if($tipo_orden=="DESC") selected @endif>Descendente</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dropdown-footer py-2 bgc-secondary-l4 text-center position-relative border-t-1 brc-secondary-l2">
                                            <button type="reset" class="btn px-25 py-15 text-95 btn-outline-default">
                                                Limpiar filtros
                                            </button>
                                            <button type="submit" class="btn px-4 py-15 text-95 btn-default">
                                                Buscar
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- .dropdown-inner -->
                            </div>
                        </div>
                    </div>

                    <div class="px-1">
                        <a title="Recargar" href="{{Request::url()}}" class="btn btn-yellow btn-sm  h-100 d-inline-flex align-items-center">
                            <i class="fa fa-retweet text-115"></i>
                        </a>
                    </div>

                    <div class="px-1">
                        <a title="Exportar Excel" data-toggle="modal" data-target="#descargaExcel" class="btn btn-success btn-sm  h-100 d-inline-flex align-items-center">
                            <i class="fa fa-file-excel text-115 px-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tablas">

    </div>

    <!--Descargar txt-->
    <form method="GET" id="frm-descargarTxt" action="{{ route('descargarTxtAdelantoPlanilla.download',[Crypt::encrypt($idPlanilla)]) }}">
        @csrf
        <div class="modal fade" id="descargatxt" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-blue-d2">
                            Archivo bancario
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ace-scrollbar">
                        <div class="row">
                            <!-- Opciones -->
                            <div class="col-md-6">
                                <div class="col-lg-12 col-sm-12 col-12 pt-2 pt-lg-0">
                                    <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Obtener archivo txt por:') }} </label>
                                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="opcion" name="opcion" >
                                        <option value="1" >Correo</option>
                                        <option value="2" >Descarga</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-lg-12 col-sm-12 col-12 pt-2 pt-lg-0" id="divCorreo">
                                    <label for="id-form-field-focus-1" class="mb-0 @if(isset($resultadoComunicacion->correo_planilla)) text-blue-m1 @else text-orange-m1 @endif">
                                        @if(!isset($resultadoComunicacion->correo_planilla))
                                            <span class="tooltip-warning" data-rel="tooltip" data-placement="bottom" title="No se ha configurado el correo de contabilidad de la empresa.">
                                                <i class="fa-solid fa-triangle-exclamation "></i>
                                            </span>
                                        @endif
                                        {{ __('Enviar archivo por correo') }}
                                    </label>
                                    <input type="text" id="tag-input" name="correo" class="form-control" value="@isset($resultadoComunicacion->correo_planilla) {{ $resultadoComunicacion->correo_planilla }} @endisset"/>
                                </div>
                            </div>
                            <!-- Bancos -->
                            <div class="col-md-6">
                                <input type="hidden" id="id_planilla_encrypt" name="id_planilla_encrypt" value="{{ Crypt::encrypt($idPlanilla) }}">
                                <div id="div_bancos">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-grey font-bold mt-2 mb-2">Banco de la empresa:</div>
                                                <div class="d-flex flex-wrap align-items-center">
                                                    @foreach($bancos as $info_banco)
                                                        @if(in_array($info_banco->codigo, array("BAC", "BCR", "DAVI", "PROM", "SCOT")))
                                                            @if($infoPlanilla->id_banco == $info_banco->id_banco)
                                                                @php
                                                                    switch($info_banco->codigo){
                                                                        case  "BAC": $img_banco = "bac.png"; break;
                                                                        case  "BCR": $img_banco = "bcr.png"; break;
                                                                        case "DAVI": $img_banco = "davivienda.png"; break;
                                                                        case "PROM": $img_banco = "promerica.png"; break;
                                                                        case "SCOT": $img_banco = "scotiabank.png"; break;
                                                                    }
                                                                @endphp

                                                                <img src="{{ url('/img/imagenesBancos/' . $img_banco) }}" width="100" height="75" class="p-2 border dh-zoom-1">
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button id="guardar-txt" type="submit" class="btn btn-primary">
                            Continuar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!--Descargar excel-->
    <form method="GET" id="frm-descargarExcel" action="{{ route('descargarExcelAdelantoPlanilla.download',[Crypt::encrypt($idPlanilla)]) }}">
        @csrf
        <div class="modal fade" id="descargaExcel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-blue-d2">
                            Archivo excel
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ace-scrollbar">
                        <div class="col-lg-6 col-sm-9 col-12 pt-2 pt-lg-0">
                            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Obtener archivo excel por:') }} </label>
                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="opcionExcel" name="opcionExcel" >
                                <option value="1" >Correo</option>
                                <option value="2" >Descarga</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-lg-6 col-sm-9 col-12 pt-2 pt-lg-0" id="divCorreoExcel">
                            <label for="id-form-field-focus-1" class="mb-0 @if(isset($resultadoComunicacion->correo_planilla)) text-blue-m1 @else text-orange-m1 @endif ">
                                @if(!isset($resultadoComunicacion->correo_planilla))
                                    <span class="tooltip-warning" data-rel="tooltip" data-placement="bottom" title="No se ha configurado el correo de contabilidad de la empresa.">
                                                <i class="fa-solid fa-triangle-exclamation "></i>
                                            </span>
                                @endif
                                {{ __('Enviar archivo por correo') }}
                            </label>
                            <input type="text" id="tag-input2" name="correoExcel" class="form-control" value="@isset($resultadoComunicacion->correo_planilla) {{ $resultadoComunicacion->correo_planilla }} @endisset"/>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button id="guardar-excel" type="submit" class="btn btn-primary">
                            Continuar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!--Realiza cierre de planilla-->
    <form method="POST" action="{{ route('registrarAdelantoPlanilla',[$idPlanilla]) }}">
        @csrf
        @method('PUT')

        <div class="modal fade" id="cierrePlanilla" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-message modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title text-blue-d2">
                            ¿Está seguro de cerrar el adelanto de adelanto planilla?
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ace-scrollbar">
                        Esta acción realiza el pago del adelanto de la planilla final del mes.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary" >
                            Aceptar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection

@push('scripts')

    <script type="module">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'get',
                url: "{{ route('generarAdelantoPlanilla.show', [Crypt::encrypt($idPlanilla)]) }}",
                data:{
                    'cantidad':{{$cantidad}},
                    'paginaActual':{{$paginaActual}},
                    'buscar':'{{$buscar}}',
                    'orden':'{{$orden}}',
                    'tipo_orden':'{{$tipo_orden}}'
                },
                beforeSend: function (){
                    waitingDialog.show();
                },
                success: (response) => {
                    $("#tablas").empty().append(response);
                },
                error: function(response){
                    alert(response);
                },
                complete: function (response){
                    waitingDialog.hide();
                }
            });
        });

        $("#opcion").on('change',function(evt)
        {
            let opcion = $("#opcion").val();

            if(opcion==1)
            {
                $("[class='bootstrap-tagsinput']").find('span').remove();
                $("[name='tag-input']").removeClass('form-control');
                $('#divCorreo').find('input, textarea, button, select').attr('disabled', false);
            }
            else
            {
                $("[class='bootstrap-tagsinput']").find('span').remove();
                $("[name='tag-input']").addClass('form-control');
                $('#divCorreo').find('input, textarea, button, select').attr('disabled', true);
            }
        });

        $("#opcionExcel").on('change',function(evt)
        {
            let opcion = $("#opcionExcel").val();

            if(opcion==1)
            {
                $("[class='bootstrap-tagsinput']").find('span').remove();
                $("[name='tag-input']").removeClass('form-control');
                $('#divCorreoExcel').find('input, textarea, button, select').attr('disabled', false);
            }
            else
            {
                $("[class='bootstrap-tagsinput']").find('span').remove();
                $("[name='tag-input']").addClass('form-control');
                $('#divCorreoExcel').find('input, textarea, button, select').attr('disabled', true);
            }
        });
    </script>

    <script type="module">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Formulario txt

        $('#frm-descargarTxt').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                correo: {
                    required: function(element){
                        return $('#divCorreo').is(':visible');
                    }
                },
            },

            messages: {
                correo: {
                    required: "Este campo es requerido."
                },
            },
            errorElement : 'span'
        });

        $("#guardar-txt").on('click', function (evt)
        {
            if($('#frm-descargarTxt').valid())
            {
                $("#descargatxt").modal("hide");
                //$('#frm-descargarTxt').submit();
            }
            else
            {
                return false;
            }
        });

        //Formulario excel

        $('#frm-descargarExcel').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                correoExcel: {
                    required: function(element){
                        return $('#divCorreoExcel').is(':visible');
                    }
                },
            },

            messages: {
                correoExcel: {
                    required: "Este campo es requerido."
                },
            },
            errorElement : 'span'
        });

        $("#guardar-excel").on('click', function (evt)
        {
            if($('#frm-descargarExcel').valid())
            {
                $("#descargaExcel").modal("hide");
                //$('#frm-descargarExcel').submit();
            }
            else
            {
                return false;
            }
        });

    </script>

@endpush
