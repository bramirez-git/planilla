@extends('Layouts.menu')

@section('page-content')
    <h5 class="page-title text-dark-m2 text-140 text-success-l1">
        Información de Embargo
    </h5>

    <div class="form-group row mt-4">

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de embargo') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="tipoEmbargo" name="tipoEmbargo" readonly/>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de cuenta a debitar') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroCuenta" name="numeroCuenta" readonly/>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }}</label>

            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="moneda" name="moneda" readonly/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Monto de embargo') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">₡</span>
                </div>
                <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="montoPrestamo" name="montoPrestamo" readonly/>
            </div>
        </div>
    </div>

    <div class="form-group row mt-4">

        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha') }}</label>
            <input type="text"  class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicio" name="fechaInicio" readonly/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Beneficiario') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="beneficiario" name="beneficiario" readonly/>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de Expediente') }}</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroExpediente" name="numeroExpediente" readonly/>
        </div>
    </div>
    <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
        <div class="md-3 col-md-9 col-sm-12 text-nowrap">
            <a href="#" class="btn btn-outline-red btn-text-dark btn-h-red btn-a-red btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-red h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-file-pdf mr-1 text-white text-120 mt-3px"></i>
                    </span>
                Descargar
            </a>
        </div>
    </div>
@endsection
