@extends('Layouts.menu')

@section('page-content')
   <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('politicaEmpresarial.update',['1'])}}">
        @csrf
        @method('PUT')
        <div class="form-group row mt-4">
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Código de Documento') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="codigoDocumento" name="codigoDocumento"  required="true"/>
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre del documento') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreDocumento" name="nombreDocumento"  required="true"/>
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Fecha de Registro</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaRegistro" name="fechaRegistro" required="true">
                </div>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Documento') }} </label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="documento"
                               aria-describedby="inputGroupFileAddon01" accept="application/pdf">
                        <label class="custom-file-label" for="inputGroupFile01">Seleccionar documento</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Departamentos con acceso') }}</label>
                <div>
                    <select class="form-control" data-style="btn-outline-default btn-h-outline-primary btn-a-outline-primary" multiple id="selectpicker1">
                        <option>Marketing</option>
                        <option>Publicidad</option>
                        <option>Informática</option>
                        <option>Recursos Humanos</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Estado') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="estadoDepartamento" name="estadoDepartamento" required="true">
                    <option value=""></option>
                    <option value="1">Publicado</option>
                    <option value="2">Borrador</option>
                </select>
            </div>
        </div>

       <div class="form-group row mt-4">
           <div class="col-md-8 col-sm-12">
               <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción de documento') }}</label>
               <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcionDocumento" name="descripcionDocumento" style="height: 38px" required="true"></textarea>
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
                    Modificar
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
                        ¿Desea modificar la política empresarial?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="Submit" class="btn btn-primary" >
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
