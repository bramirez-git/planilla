@extends('Layouts.menu')

@section('page-content')

    <form class="mt-lg-3" id="frm-colaboradores" autocomplete="off" method="POST" action="{{route('colaboradores.update',[$resultado->id_colaborador])}}">
        @csrf
        @method('PUT')
        <div class="form-group row mt-4">

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="numeroColaborador" class="mb-0 text-blue-m1">
                    <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Si deja en blanco el sistema genera un código aleatorio">
                        <i class="fa-solid fa-circle-info blue"></i>
                    </span>{{ __('Número de colaborador') }}
                </label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="numeroColaborador" name="numeroColaborador" value="{{ old('numeroColaborador') ?? $resultado->numero_colaborador }}" readonly/>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="tipoIdentificacion" class="mb-0 text-blue-m1"> {{ __('Tipo de identificación') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="tipoIdentificacion" name="tipoIdentificacion">
                    @foreach($tiposIdentificaciones as $tipoIdentificacion)
                        @php $opcion=""; @endphp
                        @if($tipoIdentificacion->id_tipo_identificacion == $resultado->id_tipo_identificacion)
                            @php $opcion="selected"; @endphp
                        @endif
                        <option value="{{ $tipoIdentificacion->id_tipo_identificacion }}" {{$opcion}}>{{ $tipoIdentificacion->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="identificacion" class="mb-0 text-blue-m1"> {{ __('Identificación') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="identificacion" name="identificacion" value="{{ old('identificacion') ?? $resultado->identificacion }}" />
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="nombre1" class="mb-0 text-blue-m1"> {{ __('Primer Nombre') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre1" name="nombre1" value="{{ old('nombre1') ?? $resultado->primer_nombre }}" />
            </div>

        </div>

        <div class="form-group row mt-4">
            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="nombre2" class="mb-0 text-blue-m1"> {{ __('Segundo Nombre') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombre2" name="nombre2" value="{{ old('nombre2') ?? $resultado->segundo_nombre }}"/>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="apellido1" class="mb-0 text-blue-m1"> {{ __('Primer Apellido') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="apellido1" name="apellido1" value="{{ old('apellido1') ?? $resultado->primer_apellido }}" />
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="apellido2" class="mb-0 text-blue-m1"> {{ __('Segundo Apellido') }}</label>
                <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="apellido2" name="apellido2" value="{{ old('apellido2') ?? $resultado->segundo_apellido }}" />
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="genero"> {{ __('Género') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="genero" name="genero" >
                    @foreach($generos as $genero)
                        @php $opcion=""; @endphp
                        @if($genero->id_genero == $resultado->id_genero)
                            @php $opcion="selected"; @endphp
                        @endif
                        <option value="{{ $genero->id_genero }}" {{$opcion}}>{{ $genero->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row mt-4">

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="fechaNacimiento" class="mb-0 text-blue-m1"> {{ __('Fecha de Nacimiento') }}</label>
                <div class="input-group input-daterange">
                    <input type="text" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') ?? date("d/m/Y",strtotime($resultado->fecha_nacimiento)) }}" />
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="estadoCivil" class="mb-0 text-blue-m1"> {{ __('Estado Civil') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="estadoCivil" name="estadoCivil">
                    @foreach($estadosCiviles as $estadoCivil)
                        @php $opcion=""; @endphp
                        @if($estadoCivil->id_estado_civil == $resultado->id_estado_civil)
                            @php $opcion="selected"; @endphp
                        @endif
                        <option value="{{ $estadoCivil->id_estado_civil }}" {{$opcion}}>{{ $estadoCivil->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <input name="frm_codigo_pais" value="{{ isset($resultado->frm_cod_paisCelular) ? $resultado->frm_cod_paisCelular : '506' }}" type="hidden" id="frm_codigo_pais">
                <label for="telefonoCelular" class="mb-0 text-blue-m1"> {{ __('Teléfono Celular') }}</label>
                <input type="text" value="{{ old('telefonoCelular', isset($resultado->frm_telefonoCeluar) ? $resultado->frm_telefonoCeluar : '') }}" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" id="telefonoCelular" name="telefonoCelular"/>

                <div id="mensajeErrorCelular" style="color: red;"></div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <input name="frm_codigo_pais2" value="{{ isset($resultado->frm_cod_paisCasa) ? $resultado->frm_cod_paisCasa : '506' }}" type="hidden" id="frm_codigo_pais2">
                <label for="telefonoCasa" class="mb-0 text-blue-m1">{{ __('Teléfono de Casa') }}</label>
                <input type="text" value="{{ old('telefonoCasa', isset($resultado->frm_telefonoCasa) ? $resultado->frm_telefonoCasa : '') }}" class="form-control brc-on-focus brc-blue-m1 col-sm-12 telefono" id="telefonoCasa" name="telefonoCasa"/>
                <div id="mensajeErrorFijo" style="color: red;"></div>

            </div>
        </div>

        <div class="form-group row mt-4">

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="correo" class="mb-0 text-blue-m1"> {{ __('Correo Electrónico Personal') }}</label>
                <input type="text" data-inputmask="'alias': 'email'" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="correo" name="correoPersonal" value="{{ old('correoPersonal') ?? $resultado->correo_personal }}" />
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="provincia" class="mb-0 text-blue-m1"> {{ __('Provincia') }} </label>
                <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="provincia" name="provincia" onchange="cantones()">
                    @foreach($provincias as $provincia)
                        @php $opcion=""; @endphp
                        @if($provincia->id_provincia == $resultado->id_provincia)
                            @php $opcion="selected"; @endphp
                        @endif
                        <option value="{{ $provincia->id_provincia }}" {{$opcion}}>{{ $provincia->provincia }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="canton" class="mb-0 text-blue-m1"> {{ __('Cantón') }} </label>
                <div id="cantones">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="canton" name="canton" onchange="distritos()">
                        @foreach($cantones as $canton)
                            @php $opcion=""; @endphp
                            @if($canton->id_canton == $resultado->id_canton)
                                @php $opcion="selected"; @endphp
                            @endif
                            <option value="{{ $canton->id_canton }}" {{$opcion}}>{{ $canton->canton }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 pt-2 pt-lg-0">
                <label for="distrito" class="mb-0 text-blue-m1"> {{ __('Distrito') }} </label>
                <div id="distritos">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="distrito" name="distrito" onchange="barrios()">
                        @foreach($distritos as $distrito)
                            @php $opcion=""; @endphp
                            @if($distrito->id_distrito == $resultado->id_distrito)
                                @php $opcion="selected"; @endphp
                            @endif
                            <option value="{{ $distrito->id_distrito }}" {{$opcion}}>{{ $distrito->distrito }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>



        <div class="form-group row mt-4">

            <div class="col-md-3 col-sm-6 col-12">
                <label for="barrio" class="mb-0 text-blue-m1"> {{ __('Barrio') }} </label>
                <div id="barrios">
                    <select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio" >
                        @foreach($barrios as $barrio)
                            @php $opcion=""; @endphp
                            @if($barrio->id_barrio == $resultado->id_barrio)
                                @php $opcion="selected"; @endphp
                            @endif
                            <option value="{{ $barrio->id_barrio }}" {{$opcion}}>{{ $barrio->barrio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-9">
                <label class="mb-0 text-blue-m1"> {{ __('Domicilio') }}</label>
                <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" id="direccion" name="direccion" >{{ old('direccion') ?? $resultado->direccion }} </textarea>

            </div>
        </div>


        <div class="form-group row mt-4">

            <div class="col-md-4">
                <label class="mb-0 text-blue-m1 text-center"> {{ __('Foto de colaborador') }}</label>

                <div class="pos-rel d-style radius-1  overflow-hidden pt-4">
                    <a href="#" class="show-lightbox">
                        @if($existe_path)

                         <div class="d-style  mx-2  overflow-hidden mb-3 mb-sm-0 ">
                                <img alt="Planilla" src="data:image/jpeg;base64,{{ $foto }}" class=" m-auto d-block img-thumbnail" height="150">
                              <input type="text" value="{{ Crypt::encrypt($resultado->foto) }}" hidden name="fotoActual"/>
                              </div>
                        @else
                          <div class="d-style  mx-2  overflow-hidden mb-3 mb-sm-0 ">
                                <img alt="Planilla" src="{{ asset('img/default-usuario.png') }}" class=" m-auto d-block img-thumbnail" height="150">

                              </div>
                        @endif
                    </a>
                </div>


                <a href="#id-more-buttons" class="d-style px-4 btn btn-white collapsed my-3 col-md-12 col-sm-12" data-toggle="collapse" aria-expanded="false">
                    <span class="d-collapsed">
                        Cambiar foto
                        <i class="fa fa-angle-double-right ml-35"></i>
                    </span>
                    <span class="d-n-collapsed text-600">
                        <i class="fa fa-angle-double-left"></i>
                    </span>
                </a>
            </div>
            <div id="id-more-buttons" class="collapse col-md-3 col-sm-12">
                <label class="mb-0 text-blue-m1"> {{ __('Adjuntar foto de colaborador') }}</label>

                <div class="input-group pt-4">
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
                <button type="button" id="registrar" class="btn btn-outline-blue btn-text-dark btn-h-blue btn-a-blue btn-bold radius-1 d-inline-flex align-items-center pl-3px py-3px mb-1">
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
                        ¿Desea modificar el registro del colaborador?
                        <br />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" id="guardar" class="btn btn-primary" >
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
