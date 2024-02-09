<form class="mt-lg-3" id="form-ocupaciones" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
    @csrf
    @method('PUT')
    <input type="text" name="tipoForm" value="Ocupaciones" hidden/>
    <input type="text" name="tab" value="ocupaciones-tab" hidden/>
    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Código de la ocupación') }}</label>
            <input type="text" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" id="codigoPuesto" name="codigoPuesto"/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de la ocupación') }}</label>
            <input type="text" class="input-group form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombrePuesto" name="nombrePuesto"/>
        </div>
        <div class="col-md-3 col-sm-12 align-self-end">
            <button type="button" id="registrarocupaciones" class="btn btn-outline-green btn-text-dark btn-h-green btn-a-green btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px">
                                    <span class="bgc-green h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                        <i class="fa fa-plus mr-1 text-white text-120 mt-3px"></i>
                                    </span>
                Agregar Ocupación
            </button>
        </div>
    </div>
</form>
<div class="mt-3 border-t-1 brc-secondary-l2 py-35 mx-n25">
    @if($resultadoPuestos->isEmpty())
        <div class="alert alert-warning">
            No hay ocupaciones registradas.
        </div>
    @else
        <table id="simple-table" class="resp mb-0 table table-striped table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
            <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
            <tr>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Código de la ocupación
                </th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Nombre de la ocupación
                </th>
                <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                    Acción
                </th>
            </tr>
            </thead>
            <tbody class="mt-1">
            @foreach($resultadoPuestos as $datos)
                <tr class="bgc-h-blue-l4 d-style">
                    <td data-label=" Código de puesto:" class='text-grey-d1 text-right text-md-center small'>
                        {{$datos->codigo}}
                    </td>
                    <td data-label="Puesto:" class='text-grey-d1 text-right text-md-center small'>
                        {{$datos->nombre}}
                    </td>
                    <td data-label="Acción:" class='text-grey-d1 text-right text-md-center small'>
                        <!-- action buttons -->
                        <div class='d-none d-lg-flex justify-content-center'>
                            <a href="#" data-toggle="modal" data-target="#editModal{{$datos->id_puesto}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <a data-form-id="{{$datos->id_puesto}}" class="delete-btn mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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
                                    <a href="#" data-toggle="modal" data-target="#editModal{{$datos->id_puesto}}" class="dropdown-item">
                                        <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                                        Editar
                                    </a>
                                    <a class="btn delete-btn dropdown-item" data-form-id="{{$datos->id_puesto}}">
                                        <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                                        {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form method="POST" id="frm-delete-puesto-{{$datos->id_puesto}}" action="{{ route('puestosEmpresa.delete',[$datos->id_puesto]) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <form method="POST" action="{{ route('puestosEmpresa.update',[$datos->id_puesto]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal fade" data-backdrop-bg="bgc-white" id="editModal{{$datos->id_puesto}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content bgc-transparent brc-warning-m2 shadow">
                                        <div class="modal-header py-2 bgc-warning-tp1 border-0  radius-t-1">
                                            <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                                Editar puesto </h5>
                                            <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="text-150">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body bgc-white-tp2 p-md-4">
                                            <div>
                                                <div class="text-secondary-d2 text-105">
                                                    Código de puesto:
                                                    <input type="text" value="{{$datos->codigo}}" class="form-control col-sm-12" id="codigoPuestoEditar" name="codigoPuestoEditar"/>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="text-secondary-d2 text-105">
                                                    Nombre de puesto:
                                                    <input type="text" value="{{$datos->nombre}}" class="form-control col-sm-12" id="nombrePuestoEditar" name="nombrePuestoEditar"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bgc-white-tp2 border-0">
                                            <button type="button" class="btn px-4 btn-light-grey" data-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn px-4 btn-warning" id="id-danger-yes-btn">
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div><!--validaciones-->
<script type="module">
    //6- Ocupaciones
    $('#guardar-ocupaciones').on('click', function(evt){
        $('#confirmModalOcupaciones').modal('hide');
        $('#cargando').modal('show');
    });
    $('#form-ocupaciones').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            codigoPuesto: {
                required: true,
                maxlength: 5  // Define que el campo debe tener menos de 5 caracteres
            },
            nombrePuesto: {
                required: true
            }
        },
        messages: {
            codigoPuesto: {
                required: "Este campo es requerido.",
                maxlength: "El código debe tener menos de 5 caracteres."
            },
            nombrePuesto: {
                required: "Este campo es requerido."
            }
        },
        errorPlacement: function(error, element){
            if(element.hasClass("form-control")){
                error.insertAfter(element.closest('.input-group'));
            }else{
                error.insertAfter(element);
            }
        }
    });
    $("#registrarocupaciones").on('click', function(evt){
        if($('#form-ocupaciones').valid()){
            confirmar('', '¿Desea guardar el registrado de la ocupación?', 'question', function(){
                waitingDialog.show();
                $('#form-ocupaciones').submit();
            });
        }else{
            return false;
        }
    });
    $('.delete-btn').on('click', function(event){
        // Evita que el enlace realice su acción predeterminada (navegar a otra página)
        event.preventDefault();
        // Obtiene el ID del formulario del atributo de datos del enlace
        var formId=$(this).data('form-id');
        confirmar('', ' ¿Está seguro que desea eliminar la ocupación?', 'question', function(){
            waitingDialog.show();
            // Selecciona el formulario por su ID dinámico y envíalo
            $('#frm-delete-puesto-'+formId).submit();
        });
    });
</script>

