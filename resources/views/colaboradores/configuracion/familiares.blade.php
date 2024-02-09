<form class="mt-lg-3" id="form-familiares" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Familiares" hidden/>
    <input type="text" name="tab" value="familiares-tab" hidden/>

    <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
        <h5 class="alert-heading text-primary-d1 font-bolder">
            Créditos familiares
        </h5>

        <div class="card-body bgc-white border-1 border-t-0 brc-success-m3">
            <h5><i class="fas fa-person text-blue-m1"></i> Cónyugue</h5>
            <div style="margin-left: 20px;">
                <p>&bull; Cuando ambos cónyugues sean contribuyentes sólo uno de ellos podrá aplicarse los créditos</p>
                <p>&bull; El crédito aplica para el cónyugue siempre y cuando no exista separación legal.</p>
            </div>
            
            <h5><i class="fas fa-children text-info"></i> Hijos</h5>
            <div style="margin-left: 20px;">
                <p>&bull; Cuando sean menores de edad.</p>
                <p>&bull; Que estén imposibilitados para proveerse su propio sustento debido a incapacidad física o mental.</p>
                <p>&bull; Cuando estén realizando estudios superiores, siempre y cuando no sean mayores de 25 años.</p>
                <p>&bull; En caso de que ambos cónyugues sean contribuyentes, los créditos por los hijos sólo pueden ser deducido por uno de ellos.</p>
            </div>
            <!-- <div class="jqtree tree-dotted" id="id-jqtree-files"></div> -->
        </div>
    </div>

    <div class="form-group row mt-4">
        <div class="col-md-4 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Tiene cónyuge?') }} </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tieneConyugue" name="tieneConyugue">
                <option value="si" {{ ($resultadoConyugue->trabaja_conyuge != '') ? 'selected' : '' }}>Si</option>
                <option value="no" {{ ($resultadoConyugue->trabaja_conyuge == '') ? 'selected' : '' }}>No</option>
            </select>
            <span id="" class="text-muted" style="color: #5cb85c !important;"></span>
        </div>
    </div>


    <div class="form-group row mt-4 contribuyente" style="display: none;">
        <div class="col-md-4 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('¿Es el cónyuge contribuyente?') }} </label>
            @php
                $opcionSi="";
                $opcionNo="";
            @endphp
            @isset($resultadoConyugue)
                @if($resultadoConyugue->trabaja_conyuge == "si")
                    @php $opcionSi="selected"; @endphp
                @elseif($resultadoConyugue->trabaja_conyuge == "no")
                    @php $opcionNo="selected"; @endphp
                @endif
            @endisset
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="conyugeDependiente" name="conyugeDependiente">
                @if($opcionSi!="selected" && $opcionNo!="selected")
                    <option value=""></option>
                @endif
                <option value="si" {{ $opcionSi }}>Si</option>
                <option value="no" {{ $opcionNo }}>No</option>
            </select>
            <span id="mensajeConyuge" class="text-muted" style="color: #5cb85c !important;"></span>
        </div>
    </div>
    <h3 class="card-title text-125">
        <i class="nav-icon fa fa-arrows-down-to-people"></i> {{ __('Datos de los hijos') }}
    </h3>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Nacimiento') }}</label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaNacimientoHijo" name="fechaNacimientoHijo"/>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Estudiante') }} </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="hijoEstudiante" name="hijoEstudiante">
                <option value="si">Si</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 align-self-end">
            <button type="button" id="registrarFamiliar" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Hijo
            </button>
        </div>
    </div>
    @if($resultadoFamiliares->isEmpty())
        <div class="alert alert-warning"> No hay familiares registrados.</div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Fecha de Nacimiento</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Estudiante</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Edad</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción</th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultadoFamiliares as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label="Fecha de Nacimiento:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->fecha_nacimiento }} </td>
                    <td data-label="Estudiante:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->estudiante }} </td>
                    <td data-label="Edad:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->edad }} </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a data-toggle="modal" data-target="#modalEliminarFamiliar{{$datos->id_familiar}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </div>
                        <!-- show a dropdown in mobile -->
                        <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                            <a href='#' class='btn btn-default btn-xs py-15 radius-round dropdown-toggle' data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                                <div class="dropdown-inner">
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2"> {{ __('Acción') }} </div>
                                    <a data-toggle="modal" data-target="#modalEliminarFamiliar{{$datos->id_familiar}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </td>
                </tr>
                <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarFamiliar{{$datos->id_familiar}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                            <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel"> ¡Atención! </h5>
                                <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-150">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                <div class="d-flex align-items-top mr-2 mr-md-5">
                                    <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                    <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el familiar del colaborador?</div>
                                </div>
                            </div>
                            <div class="modal-footer bgc-white-tp2 border-0">
                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No</button>
                                <a href="{{ route("colaboradoresEliminarFamiliar",[ $idColaborador,$datos->id_familiar]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                    Si </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    @endif
    <div class="modal fade" id="confirmModalFamiliares" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de familiares para el colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button id="guardar-Familiar" type="submit" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="module">

    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };

    //Dfecha mascara
    $('.input-daterange').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        endDate: new Date()
    });
    $("#fechaNacimientoHijo").inputmask();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //Familiares
    $('#conyugeDependiente').on('change', function (evt){
        let conyugeDependiente = $('#conyugeDependiente').val();

        $.ajax({
            type:'GET',
            url: "{{ route('colaboradoresEditarConyugue') }}",
            data: {'conyugeDependiente':conyugeDependiente,
                'idColaborador':{{$idColaborador}} },
            global:false,
            success: (response) => {
                if (response) {
                    mostrarAlertaExito(response);
                }
            },
            error: function(response){
                alert(response.responseJSON.message);
            }
        });
    });


    $('#guardar-Familiar').on('click', function (evt){
        $('#confirmModalFamiliares').modal('hide');
        $('#cargando').modal('show');
    });


    $('#form-familiares').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            fechaNacimientoHijo: {
                required: true
            }
        },

        messages: {
            fechaNacimientoHijo: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });

    $("#registrarFamiliar").on('click', function (evt){
        if($('#form-familiares').valid()){
            $('#confirmModalFamiliares').modal('show');
        }else{
            return false;
        }
    });

    $(document).ready(function() {
        function setMensaje(selectedValue) {
            var mensaje = '';
            if (selectedValue === 'si') {
                mensaje = 'No aplica el Crédito Fiscal';
            } else if (selectedValue === 'no') {
                mensaje = 'Si aplica el Crédito Fiscal';
            }

            $('#mensajeConyuge').text(mensaje);
        }

        var valorInicial = $('#tieneConyugue').val();
        mostrarOcultarSegunTieneConyugue(valorInicial);

        $('#tieneConyugue').change(function() {
            var selectedValue = $(this).val();
            mostrarOcultarSegunTieneConyugue(selectedValue);
        });

        function mostrarOcultarSegunTieneConyugue(valor) {
            if (valor == 'si') {
                $('.contribuyente').show();
            } else {
                $('.contribuyente').hide();
            }
        }
    });

</script>


