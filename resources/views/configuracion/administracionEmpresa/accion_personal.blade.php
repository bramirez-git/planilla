
<div class="mt-3  brc-secondary-l2 py-35 mx-n25">
    <table id="simple-table" class="resp mb-0 table  table-borderless table-bordered-x  text-dark-m2 radius-1 overflow-hidden border-t-3 brc-blue-m2">
        <thead class=" border-b-1 brc-default-l3 bgc-blue-l4">
        <tr>
            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                Código de acción de personal
            </th>
            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                Nombre de acción de personal
            </th>
            <th scope="col" class="text-left text-md-center align-middle font-weight-bold">
                Acción
            </th>
        </tr>
        </thead>
        <tbody class="mt-1">
        @foreach($accionesPersonal as $accionPersonal)
            <tr class="bgc-h-blue-l4 d-style">
                <td data-label="Código de acción de personal:" class='text-grey-d1 text-right text-md-center small'>
                    {{$accionPersonal->codigo}}
                </td>
                <td data-label="Nombre de acción de personal:" class='text-grey-d1 text-right text-md-center small'>
                    {{$accionPersonal->nombre}}
                </td>
                <td data-label=" Acción:" class='text-grey-d1 text-right text-md-center small'>
                    <!-- action buttons -->
                    <div class='d-none d-lg-flex justify-content-center'>
                        <a href="{{route("administracionEmpresa.edit",[Crypt::encrypt($accionPersonal->id_categoria)])}}"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>

                    <!-- show a dropdown in mobile -->
                    <div class='dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg'>
                        <a href="#" data-toggle="modal" data-target="#editModal{{$accionPersonal->id_categoria}}" class="btn btn-default btn-xs py-15 radius-round"><i class="fa fa-pencil-alt"></i></a>
                    </div>
                    <form method="POST" action="{{ route('accionPersonal.update',[Crypt::encrypt(session()->get('id_cliente'))]) }}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="tipoForm" value="Acción de personal" hidden/>
                        <input type="text" name="tab" value="accionPersonal-tab" hidden/>
                        <div class="modal fade" data-backdrop-bg="bgc-white" id="editModal{{$accionPersonal->id_categoria}}" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bgc-transparent brc-warning-m2 shadow">
                                    <div class="modal-header py-2 bgc-warning-tp1 border-0  radius-t-1">
                                        <h5 class="modal-title text-white-tp1 text-110 pl-2 font-bolder" id="warningModalLabel">
                                            Editar acción de personal </h5>
                                        <button type="button" class="position-tr btn btn-xs btn-outline-white btn-h-yellow btn-a-yellow mt-1px mr-1px btn-brc-tp" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="text-150">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bgc-white-tp2 p-md-4">
                                        <div>
                                            <div class="text-secondary-d2 text-105">
                                                Nombre acción de personal:
                                                <input type="text" class="form-control col-sm-12" id="nombreAccionEdit" name="nombreAccionEdit"/>
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
</div>
<script type="module">
    if ($('.chosen-select').length){
        $(".chosen-select").chosen({allow_single_deselect: true});
    }
    //7- Acción de personal
    $('#guardar-accionespersonal').on('click', function(evt){
        $('#confirmModalAccionesPersonal').modal('hide');
        $('#cargando').modal('show');
    });
    $('#form-accionPersonal').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            codigoAccionPersonal: {
                required: true
            }
        },
        messages: {
            codigoAccionPersonal: {
                required: "Este campo es requerido."
            }
        },
        errorElement: 'span'
    });
    $("#registraraccionespersonal").on('click', function(evt){
        if($('#form-accionPersonal').valid()){
            $('#confirmModalAccionesPersonal').modal('show');
        }else{
            return false;
        }
    });
</script>
