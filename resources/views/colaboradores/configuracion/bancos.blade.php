<input type="hidden" id="tipoPago" name="tipoPago" value=""/>
 @if($resultadoBancos->isEmpty())
        <!-- DEPOSITO -->
        <form class="mt-lg-3" id="formDeposito" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
            @csrf
            @method('PUT')
            <input type="text" name="tipoForm" value="Bancos" hidden/>
            <input type="text" name="modoPago" value="deposito" hidden/>
            <input type="text" name="tab" value="bancos-tab" hidden/>
            <div class="card">
                <div class="card-header bgc-grey-l4">
                    <div class="text-left">
                        <input type="checkbox" id="chk_deposito" name="chk_deposito" class="bgc-primary" value="deposito" onchange="cambiarTipoPago('deposito');"> Dep&oacute;sito Bancario
                    </div>
                </div>
                <div id="div_deposito" class="card-body" style="display: none;">
                    <div class="form-group row">
                        <div class="col-md-3 col-sm-12">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Banco') }}</label>
                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="banco" name="banco">
                                @foreach($catalogoBancos as $datos)
                                    <option value="{{ $datos->id_banco }}">{{ $datos->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }}</label>
                            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="moneda" name="moneda">
                                @foreach($catalogoMonedas as $datos)
                                    <option value="{{ $datos->id_moneda }}">{{ $datos->leyenda }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label class="mb-0 text-blue-m1"> Cuenta IBAN </label>
                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cuentaIban" name="cuentaIban"/>
                        </div>
                        <div class="col-md-3 col-sm-12 align-self-end">
                            <button type="button" id="registrarDeposito" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Registrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- SINPE MOVIL -->
        <form class="mt-lg-3" id="formSinpeMovil" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
            @csrf
            @method('PUT')
            <input type="text" name="tipoForm" value="Bancos" hidden/>
            <input type="text" name="modoPago" value="sinpe_movil" hidden/>
            <input type="text" name="tab" value="bancos-tab" hidden/>
            <div class="card mt-3">
                <div class="card-header bgc-grey-l4">
                    <div class="text-left">
                        <input type="checkbox" id="chk_sinpe_movil" name="chk_sinpe_movil" class="bgc-primary" value="sinpe_movil" onchange="cambiarTipoPago('sinpe_movil');"> SINPE M&oacute;vil
                    </div>
                </div>
                <div id="div_sinpe_movil" class="card-body" style="display: none;">
                    <div class="form-group row">
                        <div class="col-md-3 col-sm-12">
                            <label class="mb-0 text-blue-m1"> N&uacute;mero Telef&oacute;nico </label>
                            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" id="telefonoSinpe" name="telefonoSinpe" value="{{ str_replace("-", "", $resultadoColaborador->telefono_celular) }}"/>
                            <div id="mensajeError" style="color: red;"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 align-self-end">
                            <button type="button" id="registrarSinpeMovil" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Registrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- CHEQUE -->
        <form class="mt-lg-3" id="formCheque" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
            @csrf
            @method('PUT')
            <input type="text" name="tipoForm" value="Bancos" hidden/>
            <input type="text" name="modoPago" value="cheque" hidden/>
            <input type="text" name="tab" value="bancos-tab" hidden/>
            <div class="card mt-3">
                <div class="card-header bgc-grey-l4">
                    <div class="text-left">
                        <input type="checkbox" id="chk_cheque" name="chk_cheque" class="bgc-primary" value="cheque" onchange="cambiarTipoPago('cheque');"> Cheque
                    </div>
                </div>
                <div id="div_cheque" class="card-body" style="display: none;">
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-12">
                            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                                Un cheque es una orden de pago librada contra un banco que permite a la persona que lo recibe
                                cobrar una cierta cantidad de dinero que está estipulada en el documento y que debe estar
                                disponible en la cuenta bancaria de qui&eacute;n lo expide.
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-12 align-self-end">
                            <button type="button" id="registrarCheque" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Registrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="alert alert-warning mt-4"> No hay m&eacute;todos de pago registrados.</div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            @foreach($resultadoBancos as $datos)
                <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
                <tr>
                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> M&eacute;todo Pago</th>
                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                        @php
                            if(($datos->tipo_pago == "deposito") || ($datos->tipo_pago == "sinpe_movil")){
                                echo "Moneda";
                            }
                        @endphp
                    </th>
                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                        @php
                            if($datos->tipo_pago == "deposito"){
                                echo "Cuenta Planilla";
                            }
                            if($datos->tipo_pago == "sinpe_movil"){
                                echo "Número Teléfono";
                            }
                        @endphp
                    </th>
                    <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción</th>
                </tr>
                </thead>
                <tbody class="mt-1">
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label="Banco:" class='text-grey-d1 text-right text-md-center small'>
                        @php
                            if($datos->tipo_pago == "deposito"){
                                echo sprintf("DEP&Oacute;SITO - %s", $datos->banco);
                            }
                            if($datos->tipo_pago == "sinpe_movil"){
                                echo "SINPE M&Oacute;VIL";
                            }
                            if($datos->tipo_pago == "cheque"){
                                echo "CHEQUE";
                            }
                        @endphp
                    </td>
                    <td data-label="Moneda:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->moneda_leyenda }} </td>
                    <td data-label="Cuenta Planilla:" class='text-grey-d1 text-right text-md-center small'>
                        @php
                            if($datos->tipo_pago == "deposito"){
                                echo $datos->cuenta;
                            }
                            if($datos->tipo_pago == "sinpe_movil"){
                                echo $datos->telefono_sinpe;
                            }
                        @endphp
                    </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id_colaborador_banco}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id_colaborador_banco}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </td>
                </tr>
                <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarBanco{{$datos->id_colaborador_banco}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                    <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el banco colaborador?</div>
                                </div>
                            </div>
                            <div class="modal-footer bgc-white-tp2 border-0">
                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No</button>
                                <a href="{{ route("colaboradoresEliminarBanco",[ $idColaborador,$datos->id_colaborador_banco]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                    Si </a>
                            </div>
                        </div>
                    </div>
                </div>
                </tbody>
            @endforeach
        </table>
    @endif

    <div class="modal fade" id="confirmModalTipoPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de tipo de pago del colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button id="guardarTipoPago" type="submit" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
 <script type="module">
     //Tipo Pago
     $('#guardarTipoPago').on('click', function (evt){
         $('#confirmModalBanco').modal('hide');
         $('#cargando').modal('show');

         var tipoPago = $("#tipoPago").val();
         if(tipoPago == "deposito"){
             $("#formDeposito").submit();
         }
         if(tipoPago == "sinpe_movil"){
             $("#formSinpeMovil").submit();
         }
         if(tipoPago == "cheque"){
             $("#formCheque").submit();
         }
     });

     $('#formDeposito').validate({
         errorElement: 'div',
         errorClass: 'help-block',
         focusInvalid: false,
         rules: {
             cuentaIban: {
                 required: true
             }
         },
         messages: {
             cuentaIban: {
                 required: "Este campo es requerido."
             }
         },
         errorElement : 'span'
     });

     $('#formSinpeMovil').validate({
         errorElement: 'div',
         errorClass: 'help-block',
         focusInvalid: false,
         rules: {
             telefonoSinpe: {
                 required: true
             }
         },
         messages: {
             telefonoSinpe: {
                 required: "Este campo es requerido."
             }
         },
         errorElement : 'span'
     });

     $("#registrarDeposito").on('click', function (evt){
         if($('#formDeposito').valid()) {
             $('#confirmModalTipoPago').modal('show');
         }else{
             return false;
         }
     });

     $("#registrarSinpeMovil").on('click', function (evt){
         if($('#formSinpeMovil').valid()) {
             $('#confirmModalTipoPago').modal('show');
         }else{
             return false;
         }
     });

     $("#registrarCheque").on('click', function (evt){
         if($('#formCheque').valid()) {
             $('#confirmModalTipoPago').modal('show');
         }else{
             return false;
         }
     });
 </script>
 <script type="text/javascript">
     function cambiarTipoPago(tipo_pago){
         var ocultar_todos = false;

         //Deposito
         if(tipo_pago == "deposito"){
             if(($("#chk_deposito").is(":checked"))){
                 $("#chk_sinpe_movil").prop("checked", false);
                 $("#chk_cheque").prop("checked", false);

                 $("#div_sinpe_movil").hide();
                 $("#div_cheque").hide();
                 $("#div_deposito").show();
             }else{
                 ocultar_todos = true;
             }
         }

         if(tipo_pago == "sinpe_movil"){
             if(($("#chk_sinpe_movil").is(":checked"))) {
                 $("#chk_deposito").prop("checked", false);
                 $("#chk_cheque").prop("checked", false);

                 $("#div_deposito").hide();
                 $("#div_cheque").hide();
                 $("#div_sinpe_movil").show();
             }else{
                 ocultar_todos = true;
             }
         }

         if(tipo_pago == "cheque"){
             if(($("#chk_cheque").is(":checked"))) {
                 $("#chk_deposito").prop("checked", false);
                 $("#chk_sinpe_movil").prop("checked", false);

                 $("#div_deposito").hide();
                 $("#div_sinpe_movil").hide();
                 $("#div_cheque").show();
             }else{
                 ocultar_todos = true;
             }
         }

         if(ocultar_todos == true){
             $("#div_sinpe_movil").hide();
             $("#div_cheque").hide();
             $("#div_deposito").hide();
         }

         $("#tipoPago").val(tipo_pago);
     }


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
         var tel1 = $("#telefonoSinpe");


         tel1.on('input', function () {

             var longitudMaxima =  8 ;

             var valor = tel1.val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

             if (valor.length > longitudMaxima) {
                 valor = valor.substring(0, longitudMaxima);
             }


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


             tel1.val(valor);
             quitarMensajeError()
         });



         tel1.on('blur', function () {

             var valor = tel1.val().replace(/\D/g, '');

             var mensajeError = $('#mensajeError');

                 mensajeError.text('El número de teléfono en Costa Rica debe tener al menos 8 dígitos.');

         });

         function quitarMensajeError() {
             $('#mensajeError').text('');
         }
     });
 </script>
