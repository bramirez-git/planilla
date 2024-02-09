@extends('Layouts.menu')

@section('page-content')

    <div class="row">
        <div class="col-12 col-md-9" id='calendar-container'>
            <div class="card bcard">
                <div class="card-body p-lg-4">
                    <div id='calendar' class="text-blue-d1"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mt-3 mt-md-0" id='external-events'>
            <div class="bgc-white shadow-sm p-35 radius-1">
                <p class="text-120 text-primary-d2">
                    Filtros de búsqueda
                </p>

                <div class="mt-2">
                    <label for="tipoActividad" class="mb-0 text-blue-m1"> {{ __('Tipo de Actividad') }} </label>
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoActividad" name="tipoActividad" >
                        <option value=""></option>
                        <option value="1">Acciones de personal</option>
                        <option value="2">Cumpleaños</option>
                        <option value="3">Colaboradores</option>
                        <option value="4">Feriados</option>
                    </select>
                </div>

                <div class="mt-2" id="divAccionPersonal" style="display: none">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Acción de personal') }}</label>
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoAccion" name="tipoAccion" >
                        @foreach($accionesPersonal as $accionPersonal)
                            <option value="{{ $accionPersonal->id_categoria.'-'.$accionPersonal->codigo }}">{{ $accionPersonal->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2" id="divColaboradores" style="display: none">
                    <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> {{ __('Colaboradores') }}</label>
                    <select multiple id="form-field-chosen-2" class="chosen-select form-control">
                        @foreach($colaboradores as $colaborador)
                            <option value="{{ $colaborador->id_colaborador }}">{{ $colaborador->primer_nombre.' '.$colaborador->segundo_nombre.' '.$colaborador->primer_apellido.' '.$colaborador->segundo_apellido}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 border-t-1 brc-secondary-l2 pt-35 mx-n25">
                    <div class="md-3 col-md-9 col-sm-12 text-nowrap">
                        <button type="button" id="buscar" data-toggle="modal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
                        <span class="bgc-blue h-5 px-25 pt-2 ml-n1 my-n1 mr-2">
							<i class="fa fa-check mr-1 text-white text-120 mt-3px"></i>
						</span>
                            Buscar
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
