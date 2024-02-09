@extends('Layouts.menu')

@section('page-content')
    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        Información de Amonestación
    </h5>

    <div class="form-group row mt-4">

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Nombre de la amonestación') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre" name="nombre" readonly/>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de Amonestación') }}</label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fecha" name="fecha" readonly/>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Clasificación') }}</label>
            <select class="form-control" id="clasificacion" name="clasificacion" readonly>
                <option value="0">Leve</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> {{ __('Tipo') }} </label>
            <select class="form-control" id="tipo" name="tipo" readonly>
                <option value="0">Verbal</option>
            </select>
        </div>
    </div>

    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción') }}</label>
            <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" id="descripcion" name="descripcion" readonly></textarea>
        </div>
        <div id="div-doc" class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">{{ __('Documento asociado') }}</label>
            <iframe src="{{ asset('estilos/assets/storage/documentos/vacaciones.pdf') }}" width="100%" height="500px"></iframe>
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
        </div>
    </div>
@endsection
