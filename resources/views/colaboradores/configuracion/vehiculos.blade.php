<form class="mt-lg-3" id="form-Vehiculo" autocomplete="off" method="POST" action="{{route('colaboradoresConfiguracion.update',[$idColaborador])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Vehículos" hidden/>
    <input type="text" name="tab" value="vehiculos-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-2 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo Vehículo') }}</label>
            <select data-placeholder="Seleccione..." class="chosen-select form-control" id="tipoVehiculo" name="tipoVehiculo">
                @foreach($catalogoTiposVehiculos as $datos)

                    <option value="{{ $datos->id_tipo_vehiculo }}">{{ $datos->nombre }}</option>

                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Marca') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="marca" name="marca"/>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Modelo') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="modelo" name="modelo"/>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Color') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="color" name="color"/>
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Placa') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="placa" name="placa"/>
        </div>
        <div class="text-nowrap col-md-1 col-sm-12 align-self-end pt-3">
            <button type="button" id="registrarVehiculo" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2"> <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i> </span> Agregar Vehículo
            </button>
        </div>
    </div>
    @if($resultadoVehiculos->isEmpty())
        <div class="alert alert-warning"> No hay vehiculos registrados.</div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Tipo Vehículo</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Marca</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Modelo</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Color</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Placa</th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold"> Acción</th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultadoVehiculos as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label="Tipo Vehículo:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->tipo_vehiculo }} </td>
                    <td data-label="Marca:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->marca }} </td>
                    <td data-label="Modelo:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->modelo }} </td>
                    <td data-label="Color:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->color }} </td>
                    <td data-label="Placa:" class='text-grey-d1 text-right text-md-center small'> {{ $datos->placa }} </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'><!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a data-toggle="modal" data-target="#modalEliminarVehiculos{{$datos->id_vehiculo}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a data-toggle="modal" data-target="#modalEliminarVehiculos{{$datos->id_vehiculo}}" class="dropdown-item">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i> {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </td>
                </tr>
                <div class="modal fade" data-backdrop-bg="bgc-white" id="modalEliminarVehiculos{{$datos->id_vehiculo}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
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
                                    <div class="text-secondary-d2 text-105"> ¿Está seguro que desea eliminar el vehiculo del colaborador?</div>
                                </div>
                            </div>
                            <div class="modal-footer bgc-white-tp2 border-0">
                                <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal"> No</button>
                                <a href="{{ route("colaboradoresEliminarVehiculo",[ $idColaborador,$datos->id_vehiculo]) }}" class="btn px-4 btn-danger" id="id-danger-yes-btn">
                                    Si </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    @endif
    <div class="modal fade " id="confirmModalVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary-d3" id="exampleModalLabel"> Mensaje </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Desea guardar datos de vehículos para el colaborador?
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"> Cancelar</button>
                    <button id="guardar-Vehiculo" type="submit" class="btn btn-primary"> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="module">
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //Vehiculos
    $('#guardar-Vehiculo').on('click', function (evt) {
        $('#confirmModalVehiculo').modal('hide');
        $('#cargando').modal('show');
    });


    $('#form-Vehiculo').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            marca: {
                required: true
            },
            modelo: {
                required: true
            },
            color: {
                required: true
            },
            placa: {
                required: true
            }
        },

        messages: {
            marca: {
                required: "Este campo es requerido."
            },
            modelo: {
                required: "Este campo es requerido."
            },
            color: {
                required: "Este campo es requerido."
            },
            placa: {
                required: "Este campo es requerido."
            }
        },
        errorElement : 'span'
    });

    $("#registrarVehiculo").on('click', function (evt){
        if($('#form-Vehiculo').valid()){
            $('#confirmModalVehiculo').modal('show');
        }else{
            return false;
        }
    });

</script>
