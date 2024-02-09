@extends('Layouts.menu')

@section('page-content')
   <form class="mt-lg-3" id="frm-departamentos" name="frm-departamentos" autocomplete="off" method="POST" action="{{route('departamentos.store')}}">
        @csrf
        <div class="form-group row mt-4">

            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Código de departamento') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="codigoDepartamento" name="codigoDepartamento"  />
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de departamento') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreDepartamento" name="nombreDepartamento"  />
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Estado') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="estadoDepartamento" name="estadoDepartamento" >
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción de departamento') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcionDepartamento" name="descripcionDepartamento"  ></textarea>
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
    </form>
@endsection
