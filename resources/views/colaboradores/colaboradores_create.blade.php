@extends('Layouts.menu')

@section('page-content')

    <form class="mt-lg-3" id="frm-colaboradores" name="frm-colaboradores" autocomplete="off" method="POST" action="{{route('colaboradores.store')}}">
        @csrf
        <input name="frm_codigo_pais" value="{{ route('obtenerNombre.edit') }}" type="hidden" id="url_obtener_nombre">
        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="tipoIdentificacion" class="mb-0 text-blue-m1"> {{ __('Tipo de identificación') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoIdentificacion" name="tipoIdentificacion" >
                    @foreach($tiposIdentificaciones as $tipoIdentificacion)
                        <option value="{{ $tipoIdentificacion->id_tipo_identificacion }}">{{ $tipoIdentificacion->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="identificacion" class="mb-0 text-blue-m1"> {{ __('Identificación') }}</label>
                <div class="input-group input-group-fade">
                    <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="identificacion" name="identificacion" value="{{ old('identificacion') }}"/>
                    <div class="input-group-append">
                        <button class="btn btn-outline-default btn-bold" type="button" id="buscarCedula">Buscar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="numeroColaborador" class="mb-0 text-blue-m1">
                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Si deja en blanco el sistema genera un código aleatorio">
                        <i class="fa-solid fa-circle-info blue"></i>
                    </span>{{ __('Número de colaborador') }}
                </label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 d-inline-block" id="numeroColaborador" name="numeroColaborador" value="{{ old('numeroColaborador') }}"  />
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="nombre1" class="mb-0 text-blue-m1"> {{ __('Primer Nombre') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 input-group" id="nombre1" name="nombre1" value="{{ old('nombre1') }}" readonly/>
            </div>

        </div>

        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="nombre2" class="mb-0 text-blue-m1"> {{ __('Segundo Nombre') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre2" name="nombre2" value="{{ old('nombre2') }}" readonly />
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="apellido1" class="mb-0 text-blue-m1"> {{ __('Primer Apellido') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 input-group" id="apellido1" name="apellido1" value="{{ old('apellido1') }}" readonly />
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="apellido2" class="mb-0 text-blue-m1"> {{ __('Segundo Apellido') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12 input-group" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" readonly />
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="genero" class="mb-0 text-blue-m1"> {{ __('Género') }} </label>
                <div class="input-group">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="genero" name="genero">
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->id_genero }}">{{ $genero->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="fechaNacimiento" class="mb-0 text-blue-m1"> {{ __('Fecha de Nacimiento') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left  brc-on-focus brc-blue-m1 col-sm-12" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}"/>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="estadoCivil" class="mb-0 text-blue-m1"> {{ __('Estado Civil') }} </label>

                <div class="input-group">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="estadoCivil" name="estadoCivil" >
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        @foreach($estadosCiviles as $estadoCivil)
                            <option value="{{ $estadoCivil->id_estado_civil }}">{{ $estadoCivil->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <input name="frm_codigo_pais" value="506"  type="hidden" id="frm_codigo_pais">
                <label for="telefonoCelular" class="mb-0 text-blue-m1"> {{ __('Teléfono Celular') }}</label>
                <div class="input-group">
                    <input type="text" placeholder="0000-0000" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" id="telefonoCelular" name="telefonoCelular" value="{{ old('telefonoCelular') }}"/>
                    <div id="mensajeErrorCelular" style="color: red;"></div>
                </div>

            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <input name="frm_codigo_pais2" value="506" type="hidden" id="frm_codigo_pais2">
                <label for="telefonoCasa" class="mb-0 text-blue-m1"> {{ __('Teléfono de Casa') }}</label>
                <div class="input-group">
                    <input type="text" placeholder="0000-0000" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" id="telefonoCasa" name="telefonoCasa" value="{{ old('telefonoCasa') }}"/>
                    <div id="mensajeErrorFijo" style="color: red;"></div>
                </div>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="correoPersonal" class="mb-0 text-blue-m1"> {{ __('Correo Electrónico Personal') }}</label>
                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12 input-group" id="correoPersonal" name="correoPersonal" value="{{ old('correoPersonal') }}"/>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="provincia" class="mb-0 text-blue-m1"> {{ __('Provincia') }} </label>
                <div class="input-group">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="provincia" name="provincia" onchange="cantones()">
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id_provincia }}">{{ $provincia->provincia }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="canton" class="mb-0 text-blue-m1"> {{ __('Cantón') }} </label>

                <div id="cantones" class="input-group">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="canton" name="canton" onchange="distritos()">
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        @foreach($cantones as $canton)
                            <option value="{{ $canton->id_canton }}">{{ $canton->canton }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="distrito" class="mb-0 text-blue-m1"> {{ __('Distrito') }} </label>
                <div id="distritos" class="input-group">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="distrito" name="distrito" onchange="barrios()">
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        @foreach($distritos as $distrito)
                            <option value="{{ $distrito->id_distrito }}">{{ $distrito->distrito }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-12 mt-2 mt-md-0">
                <label for="barrio" class="mb-0 text-blue-m1"> {{ __('Barrio') }} </label>
                <div id="barrios" class="input-group">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio" >
                        <option value="" selected="selected" disabled="">Seleccione una opción...</option>
                        @foreach($barrios as $barrio)
                            <option value="{{ $barrio->id_barrio }}">{{ $barrio->barrio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
                <label class="mb-0 text-blue-m1"> {{ __('Domicilio') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12 input-group" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" id="direccion" name="direccion" >{{ old('direccion') }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-4">
            <div class="col-md-3 col-sm-12">
                <label class="mb-0 text-blue-m1"> {{ __('Adjuntar foto de colaborador') }}</label>

                <div class="input-group">
                    <div class="cropme" style="width: 220px; height: 220px;"></div>
                    <div id="cropMessage"></div>
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
                <button type="button" id="registrar" data-toggle="modal" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
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
                        ¿Desea guardar el registro del colaborador?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary" id="guardar">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('componentes.modalCargando')
@endsection
<script type="module">

    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };

    //Dfecha mascara
    $('.input-daterange').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es',
        orientation: 'bottom',
        endDate: new Date()
    });
</script>
