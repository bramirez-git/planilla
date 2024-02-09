<form class="mt-lg-3" id="form-bancos" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Bancos" hidden/>
    <input type="text" name="tab" value="bancos-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de planilla') }}</label>
            <div>
                <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple id="selectpicker3" name="id_tipos_planilla_banco[]">
                    @if(isset($resultadoPlanilla->id_tipos_planilla))
                        @php
                            $planillas = explode(",", $resultadoPlanilla->id_tipos_planilla);
                        @endphp

                        @foreach($catalogoTipoPlanilla as $datos)
                            @foreach($planillas as $planilla)
                                @if($datos->id_tipo_planilla==$planilla)
                                    <option value="{{ $datos->id_tipo_planilla }}" {{$opcion}}>{{ $datos->nombre }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        @foreach($catalogoTipoPlanilla as $datos)
                            <option value="{{ $datos->id_tipo_planilla }}">{{ $datos->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }} </label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_moneda_Banco" name="id_moneda_Banco">
                @if(isset($resultadoPlanilla->id_monedas))
                    @php
                        $monedas = explode(",", $resultadoPlanilla->id_monedas);
                    @endphp

                    @foreach($catalogoMonedas as $datos)
                        @foreach($monedas as $moneda)
                            @if($datos->id_moneda==$moneda)
                                <option value="{{ $datos->id_moneda }}" {{$opcion}}>{{ $datos->leyenda }}</option>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    @foreach($catalogoMonedas as $datos)
                        <option value="{{ $datos->id_moneda }}">{{ $datos->leyenda }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Banco') }}</label>
            <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="id_banco" name="id_banco">
                @foreach($catalogoBancos as $datos)
                    <option value="{{ $datos->id_banco }}">{{ $datos->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Cuenta IBAN') }} </label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="cuentaIban" name="cuentaIban"/>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12 align-self-end">
            <button type="button" id="registrarbancos" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                    <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                </span>
                Agregar
            </button>
        </div>
    </div>
    @if($resultadoBancos->isEmpty())
        <div class="alert alert-warning">
            No hay bancos registrados.
        </div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Tipo de Planilla
                </th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Banco
                </th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Moneda
                </th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Cuenta IBAN
                </th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Acción
                </th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultadoBancos as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label=" Tipo de Planilla:" class='text-grey-d1 text-right text-md-center small'>
                        {{ $datos->tipo_planilla }}
                    </td>
                    <td data-label="Banco:" class='text-grey-d1 text-right text-md-center small'>
                        {{ $datos->banco }}
                    </td>
                    <td data-label="Banco:" class='text-grey-d1 text-right text-md-center small'>
                        @if($datos->moneda == "colones")
                            {{ "Colones" }}
                        @else
                            {!! "D&oacute;lares" !!}
                        @endif
                    </td>
                    <td data-label=" Cuenta IBAN:" class='text-grey-d1 text-right text-md-center small'>
                        {{ $datos->cuenta_iban }}
                    </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                                        {{ __('Acción') }}
                                    </div>
                                    <a data-toggle="modal" data-target="#modalEliminarBanco{{$datos->id}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </td>
                </tr>

                <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarBanco{{$datos->id}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content bgc-transparent brc-danger-m2 shadow">
                            <div class="modal-header py-2 bgc-danger-tp1 border-0  radius-t-1">
                                <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="dangerModalLabel">
                                    ¡Atención! </h5>
                                <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-150">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bgc-white-tp2 p-md-4 pl-md-5">
                                <div class="d-flex align-items-top mr-2 mr-md-5">
                                    <i class="fas fa-exclamation-triangle fa-2x text-orange-d2 float-rigt mr-4 mt-1"></i>
                                    <div class="text-secondary-d2 text-105">
                                        ¿Está seguro que desea eliminar el banco de la empresa?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bgc-white-tp2 border-0">
                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                    No
                                </button>
                                <a href="{{ route("empresaEliminarBanco",[ Crypt::encrypt(session()->get("id_cliente")), $datos->id]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                    Si
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    @endif
    <div class="modal fade" id="confirmModalBancos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    ¿Desea guardar datos de bancos para la empresa?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" id="guardar-bancos" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form><!--validaciones-->
<script type="module">
    //IBAN mascara
    $("#cuentaIban").inputmask({
        mask: 'CR 9999 9999 9999 9999 9999',
        placeholder: 'CR 9999 9999 9999 9999 9999',
        showMaskOnHover: true,
        showMaskOnFocus: true,
        onBeforePaste: function (pastedValue, opts) {
            var processedValue = pastedValue;

            //do something with it

            return processedValue;
        }
    });

    $('#selectpicker1').selectpicker();
    $('#selectpicker2').selectpicker();
    $('#selectpicker3').selectpicker();
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //4- Bancos
    $('#guardar-bancos').on('click', function(evt){
        $('#confirmModalBancos').modal('hide');
        $('#cargando').modal('show');
    });
    $('#form-bancos').validate({
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
        errorElement: 'span'
    });
    $("#registrarbancos").on('click', function(evt){
        if($('#form-bancos').valid()){
            $('#confirmModalBancos').modal('show');
        }else{
            return false;
        }
    });
</script>
