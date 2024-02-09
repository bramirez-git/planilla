@extends('Layouts.menuPanel')

@section('page-content')

    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('panelMiscelaneosNotificaciones.store')}}">
        @csrf
        <div class="row pb-3">
            <div class="col-sm-8">
                <div class="form-group row">
                    <div class="col-md-6 col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre') }}</label>
                        <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre1" name="nombre1"  required="true"/>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Medio de envío') }} </label>
                        <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoIdentificacion" name="tipoIdentificacion" required="true">
                            <option value=""></option>
                            <option value="1">Sendgrid</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción') }}</label>
                        <div class="card bcard border-1 brc-dark-l1">
                            <div class="card-body p-0">
                                <textarea id="summernote" name="editordata"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-sm-12">
                        <label for="id-form-field-1" class="mb-0 text-blue-m1"> Documentos </label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="documento" aria-describedby="inputGroupFileAddon01" multiple>
                                <label class="custom-file-label" for="inputGroupFile01">Seleccionar documentos</label>
                            </div>
                        </div>
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
                        <button type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                                            <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                                                <i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
                                            </span>
                            Registrar
                        </button>
                    </div>
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
                            ¿Desea guardar la notificación?
                            <br />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary" >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4" id='external-events'>
                <div class="bgc-white shadow-sm p-35 radius-1">
                    <p class="text-120 text-primary-d2">
                        Variables
                    </p>

                    <p id="alert-2" class="alert bgc-grey-l4 border-none border-l-4 brc-purple-m1">
                        Click para utilizar la variable.
                    </p>

                    <div>
                        {{ _('Nombre Colaborador: ') }}<button type="button" class='variables_clic badge bgc-blue-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-blue-d1 text-white text-95">
                            ##Nombre_Colaborador##
                        </button>
                        <br>
                        {{ _('Correo Colaborador: ') }}<button type="button" class='variables_clic badge bgc-green-d2 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-green-d2 text-white text-95">
                            ###Correo_colaborador#
                        </button>
                        <br>
                        {{ _('Nombre empresa: ') }}<button type="button" class='variables_clic badge bgc-red-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                            ##Nombre_Empresa##
                        </button>
                        <br>
                        {{ _('Extensión: ') }}<button type="button" class='variables_clic badge bgc-purple-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                            ##Extension##
                        </button>
                        <br>
                        {{ _('Mi firma: ') }}<button type="button" class='variables_clic badge bgc-orange-d1 text-white border-0 py-2 ml-2 text-90 mb-1 radius-2px' data-class="bgc-orange-d1 text-white text-95">
                            ##Mi_firma##
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </form>
@endsection
