@extends('Layouts.menu')

@section('page-content')
    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        Información del Currículum
    </h5>

    <div class="form-group row mt-4">

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Título otorgado') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreTitulo" name="nombreTitulo" readonly/>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de inicio') }}</label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicio" name="fechaInicio" readonly/>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha de finalización') }}</label>
            <div class="input-group input-daterange">
                <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaFin" name="fechaFin" readonly/>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Descripción del documento') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="descripcion" name="descripcionDoc" readonly/>
        </div>
    </div>

    <div class="form-group row mt-4">
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Link URL de la credencial') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="linkDoc" name="linkDoc" readonly/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Documento') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="doc" name="doc" readonly/>
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
