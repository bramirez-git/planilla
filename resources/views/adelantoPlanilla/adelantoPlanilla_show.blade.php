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

                                    <th class="text-left text-md-center small align-middle px-1 px-md-2 px-xl-5">
                                        <strong class="">Adelanto sugerido</strong>
                                    </th>

                                    <th class="text-left text-md-center small align-middle">
                                        <strong>Adelanto Final</strong>
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
                                                {{ number_format($resultadoColaboradores->salario_colaborador,2) }}
                                            </span>
                                        </td>

                                        <td data-label="Salario Base Sugerido:" class='text-grey-d1 text-right text-md-center'>
                                            <span class="badge badge-primary badge-md py-2">
                                                {{ $signo_moneda }}
                                                {{ number_format($resultadoColaboradores->salario_neto,2) }}
                                            </span>
                                        </td>
                                        <td data-label="Ajustes:" class='text-grey-d1 text-right text-md-center'>
                                            <div class="text-md-center">
                                                <div class="m-auto d-md-inline-block d-block align-middle">
                                                    <span class="badge badge-md mb-2 py-0">
                                                        <strong>
                                                            <a href="#" data-toggle="modal"
                                                               data-target="#adelantoSugerido{{$resultadoColaboradores->identificacion}}"
                                                               title="Datos de Ajustes"
                                                               class="btn btn-raised btn-info text-100 p-1">
                                                                {{ $signo_moneda }}
                                                                {{ number_format($resultadoColaboradores->salario_devengado,2) }}
                                                                &nbsp;<i class="fa fa-gear"></i>
                                                            </a>
                                                        </strong>
                                                    </span>
                                                </div>
                                                <div class="m-auto d-md-inline-block d-block align-middle">
                                                    <form method="POST"
                                                          action="{{ route('generarAdelantoPlanilla.update',[$resultadoColaboradores->id_colaborador]) }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="text" name="id_planilla" value="{{$resultadoColaboradores->id_planilla}}" hidden>
                                                        <div class="modal fade"
                                                             id="adelantoSugerido{{$resultadoColaboradores->identificacion}}"
                                                             tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-blue-d2">
                                                                            Adelante sugerido
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
                                                                                        <div class="form-group w-100 mx-lg-2">
                                                                                            <div class="row mt-3 px-1 d-flex justify-content-start">
                                                                                                <div
                                                                                                    class="col-8 mt-2 mt-lg-0">
                                                                                                    <label
                                                                                                        for="id-form-field-focus-1"
                                                                                                        class="mb-0 text-blue-m1">
                                                                                                        Nuevo Monto</label>
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
                                                                                                            id="montoSalarioNuevo{{$resultadoColaboradores->id_colaborador}}"
                                                                                                            name="montoSalarioNuevo{{$resultadoColaboradores->id_colaborador}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-auto col-xl-2 align-self-end px-lg-2  mt-2 mt-lg-0">
                                                                                                    <button
                                                                                                        type="submit"
                                                                                                        id="btnOtrasDeducciones{{$resultadoColaboradores->id_colaborador}}"
                                                                                                        class="btn btn-outline-blue btn-text-dark btn-h-info btn-a-info btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mt-4 mt-md-0">
                                                                                                        <span class="bgc-info h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                                                                            <i class="fa fa-plus mr-1 text-white text-100 mt-3px"></i>
                                                                                                        </span>
                                                                                                        <span>Guardar</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
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

<!--script de cambio de boton generar-->
<script>
    $(document).ready(function() {
        $('.spinner_hide').hide();

        $('#btn2').click(function()
        {
            $('#headingTwo').addClass('d-inline-block');
            $('#headingOne').addClass('d-none');
        });
    });
</script>

<script src="{{ asset('estilos/application/js/appPlanilla/jquery.magnific-popup.js') }}"></script>
<script type="module">
    $(document).ready(function() {
        var magnific = $('.ajax-popup-link').magnificPopup({
            type: 'ajax',
            fixedContentPos: true,
            showCloseBtn: true,
            closeBtnInside: false
        });
    });
</script>
