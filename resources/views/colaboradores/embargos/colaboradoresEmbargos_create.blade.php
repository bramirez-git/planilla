@extends('Layouts.menu')

@section('page-content')
    <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('colaboradoresEmbargos.store')}}">
        @csrf
        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Tipo de embargo') }}</label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoEmbargo" name="tipoEmbargo" required="true">
                    <option value=""></option>
                    <option value="1">Embargo</option>
                    <option value="2">Pensión</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de cuenta a debitar') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroCuentaDebitar" name="numeroCuentaDebitar" required="true"/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Moneda') }}</label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="moneda" name="moneda" required="true">
                    <option value=""></option>
                    <option value="1">Colones</option>
                    <option value="2">Dólares</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Monto de embargo') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">₡</span>
                    </div>
                    <input type="text" min="0" lang="en" step="0.5" class="form-control brc-on-focus brc-blue-m1 col-sm-12 number-input" id="montoPrestamo" name="montoPrestamo" required="true"/>
                </div>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Fecha') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaInicio" name="fechaInicio" required="true"/>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Beneficiario') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="beneficiario" name="beneficiario" required="true"/>
            </div>

            <div class="col-md-3 col-sm-12">
                <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Número de Expediente') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroExpediente" name="numeroExpediente" required="true"/>
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


                <button type="button" data-toggle="modal" data-target="#calcularEmbargos" class="btn btn-outline-danger btn-text-dark btn-h-danger btn-a-danger btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                    <span class="bgc-danger h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
                        <i class="fa fa-calculator mr-1 text-white text-120 mt-3px"></i>
                    </span>
                    {{ __('Calculadora embargos') }}
                </button>

                <button type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                    Registrar
                </button>
            </div>
            @include('componentes.calculadoraEmbargos')
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
                        ¿Desea guardar el embargo?
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
    </form>
@endsection
