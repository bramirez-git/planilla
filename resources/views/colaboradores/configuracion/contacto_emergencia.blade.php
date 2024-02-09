<form class="mt-lg-3" id="form-contactoEmergencia" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Contactos de Emergencia" hidden/>
    <input type="text" name="tab" value="contactoEmergencia-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Contacto de emergencia') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="contactoEmergencia" name="contactoEmergencia"/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Parentesco de emergencia') }}</label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="parentescoEmergencia" name="parentescoEmergencia">
                @foreach($catalogoParentesco as $datos)
                    @php $opcion=""; @endphp
                    @isset($resultadoINSCCSS->id_parentesco)
                        @if($datos->id_parentesco == $resultadoINSCCSS->id_parentesco)
                            @php $opcion="selected"; @endphp
                        @endif
                    @endisset

                    <option value="{{ $datos->id_parentesco }}" {{$opcion}}>{{ $datos->nombre }}</option>

                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <input name="frm_codigo_pais" value="506" type="hidden" id="frm_codigo_pais">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Teléfono de emergencia') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" data-inputmask-inputformat="0000-0000" id="telefonoEmergencia" name="telefonoEmergencia" />
            <div id="mensajeError" style="color: red;"></div>
        </div>
        <div class="col-md-3 col-sm-12 align-self-end">
            <button type="button" id="registrarContacto" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Contacto
            </button>
        </div>
    </div>
    @if($resultadoContactos->isEmpty())
        <div class="alert alert-warning"> No hay contactos registrados.</div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Contacto</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Parentesco</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Teléfono</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción</th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultadoContactos as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label="Contacto:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->nombre }} </td>
                    <td data-label="Parentesco:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->parentesco }} </td>
                    <td data-label="Teléfono:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->telefono }} </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a data-toggle="modal" data-target="#modalEliminarContactoEmergencia{{$datos->id_contacto}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a data-toggle="modal" data-target="#modalEliminarContactoEmergencia{{$datos->id_contacto}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </td>
                </tr>
                <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarContactoEmergencia{{$datos->id_contacto}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                    <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el contacto del colaborador?</div>
                                </div>
                            </div>
                            <div class="modal-footer bgc-white-tp2 border-0">
                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No</button>
                                <a href="{{ route("colaboradoresEliminarContacto",[ $idColaborador,$datos->id_contacto]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                    Si </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    @endif
    <div class="modal fade" id="confirmModalContactoEmergencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de contacto de emergencia para el colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button id="guardar-ContactoEmergencia" type="submit" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="module">
    let tel1=$('#telefonoEmergencia');
    let dial1=$('#frm_codigo_pais');
    tel1.intlTelInput({
        preferredCountries: ['cr', 'ni', 'pa', 'co', 'ec', 'pe', 'cl', 'ar', 'br', 'us'],
        separateDialCode: true
    });
    tel1.on('countrychange', function(event, countryData){
        dial1.val(countryData.dialCode);
    });
    dial1.on('change', function(event){
        var tel=tel1.val();
        tel1.intlTelInput('setNumber', '+'+this.value);
        tel1.intlTelInput('setNumber', tel);
    });
    dial1.change();
    $("#telefonoEmergencia").inputmask();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //contactos de emergencia
    $('#guardar-ContactoEmergencia').on('click', function (evt){
        $('#confirmModalContactoEmergencia').modal('hide');
        $('#cargando').modal('show');
    });


    $('#form-contactoEmergencia').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            contactoEmergencia: {
                required: true
            },
            parentescoEmergencia: {
                required: true
            },
            telefonoEmergencia: {
                required: true
            }
        },
        messages: {
            contactoEmergencia: {
                required: "Este campo es requerido."
            },
            parentescoEmergencia: {
                required: "Este campo es requerido."
            },
            telefonoEmergencia: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });

    $("#registrarContacto").on('click', function (evt){
        if($('#form-contactoEmergencia').valid()){
            $('#confirmModalContactoEmergencia').modal('show');
        }else{
            return false;
        }
    });

    //contactos de emergencia
    $('#guardar-ContactoEmergencia').on('click', function (evt){
        $('#confirmModalContactoEmergencia').modal('hide');
        $('#cargando').modal('show');
    });



    // función para no permitir letras ni caracteleres especiales a los telefonos
    $(document).ready(function() {
        function manejarKeyup() {
            var $t = $(this);
            var value = $t.val().replace(/\D/g, '');
            $t.val(value);
        }

        $('.telefono').on('input', manejarKeyup);
    });
    $(document).ready(function () {
        var tel1 = $("#telefonoEmergencia");
        tel1.intlTelInput();

        tel1.on('input', function () {
            var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
            var longitudMaxima = (codigoPais === 'cr') ? 8 : 15;

            var valor = tel1.val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

            if (valor.length > longitudMaxima) {
                valor = valor.substring(0, longitudMaxima);
            }

            // No aplicar guiones si es internacional
            if (codigoPais !== 'cr') {
                tel1.inputmask('remove'); // Eliminar la máscara
            } else {
                // Verificar los dígitos iniciales para Costa Rica (2, 8, 6, 7)
                if (!/^([248679])/.test(valor) && valor !== '') {
                    valor = '';
                } else {
                    tel1.inputmask({
                        mask: '9999-9999',
                        showMaskOnHover: false,
                        showMaskOnFocus: false
                    });
                }
            }

            tel1.val(valor);
            quitarMensajeError()
        });

        tel1.on('countrychange', function () {
            var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
            if (codigoPais !== 'cr') {
                // Para números internacionales, aplicar máscara de 15 dígitos
                tel1.inputmask({
                    mask: '999999999999999',
                    showMaskOnHover: false,
                    showMaskOnFocus: false
                });
            } else {
                tel1.val('');
            }
        });

        tel1.on('blur', function () {
            var codigoPais = tel1.intlTelInput('getSelectedCountryData').iso2;
            var valor = tel1.val().replace(/\D/g, '');

            var mensajeError = $('#mensajeError');

            if (codigoPais === 'cr' && valor.length < 8) {

                mensajeError.text('El número de teléfono en Costa Rica debe tener al menos 8 dígitos.');
            } else {

                quitarMensajeError();
            }
        });

        function quitarMensajeError() {
            $('#mensajeError').text('');
        }
    });

</script>
