@extends('Layouts.menuPanel')

@section('page-content')
    <form class="mt-lg-3" id="frm-noticias" name="frm-noticias" autocomplete="off" method="POST" action="{{route('noticiasPanel.store')}}">
        @csrf
        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Titulo') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="titulo" name="titulo"  />
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Estado') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="estado" name="estado" >
                    <option value="activa">Activo</option>
                    <option value="inactiva">Inactivo</option>
                    <option value="pendiente">Pendiente</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha Publicación') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaPublicacion" name="fechaPublicacion" required="true"/>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('URL') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="url" name="url"  />
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion"  ></textarea>
            </div>
        </div>

        <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
            <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                <a href="{{ url()->previous() }}"  class="btn btn-outline-grey btn-text-dark btn-h-grey btn-a-grey btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-grey h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-times mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Cancelar
                </a>
                <button type="button" id="registrar"  class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Registrar
                </button>
            </div>
        </div>


        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary-d3" id="exampleModalLabel">
                            Mensaje
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        ¿Desea guardar el registro de la noticia?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="Submit" class="btn btn-primary"  id="guardar">
                            Guardar
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
        $('#guardar').on('click', function (evt)
        {
            $('#confirmModal').modal('hide');
            $('#cargando').modal('show');
        });

        $('#frm-noticias').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                titulo: {
                    required: true
                },
                fechaPublicacion: {
                    required: true
                },
                url: {
                    required: true
                },
                descripcion: {
                    required: true
                }
            },

            messages: {
                titulo: {
                    required: "Este campo es requerido."
                },
                fechaPublicacion: {
                    required: "Este campo es requerido."
                },
                url: {
                    required: "Este campo es requerido."
                },
                descripcion: {
                    required: "Este campo es requerido."
                }
            },
            errorElement : 'span'
        });

        $("#registrar").on('click', function (evt)
        {
            if($('#frm-noticias').valid())
            {
                $('#confirmModal').modal('show');
            }
            else{
                return false;
            }
        });

    </script>
@endpush
