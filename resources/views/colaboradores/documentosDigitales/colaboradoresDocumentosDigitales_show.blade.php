@extends('Layouts.menu')

@section('page-content')
    <div class="form-group row mt-3">
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Nombre de documento</label>
            <input type="text" value="{{$resultadoAccion->nombre}}" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreDocumento" name="nombreDocumento" readonly>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                            <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Introduzca palabras con las que se pueda identificar el documento, separado por enter">
                                <i class="fa-solid fa-circle-info blue"></i>
                            </span>{{ __('Palabras claves') }}
            </label>
            <input type="text" value="{{$resultadoAccion->palabras_clave}}" class="form-control palabrasClaves" id="palabrasClaves" name="palabrasClaves" readonly/>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Fecha de Documento</label>
            <input type="text" value="{{$resultadoAccion->fecha}}" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaRegistro" name="fechaRegistro" readonly>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Comentarios:</label>
            <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" name="descripcionDocumento" style="height: 38px" readonly> {{$resultadoAccion->comentarios}}</textarea>
        </div>
    </div>
@endsection
