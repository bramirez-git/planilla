<form autocomplete="off" enctype="multipart/form-data" method="POST" id="frm-documentos-digitales" action="{{route('documentos.store')}}">
    @csrf
    <input type="text" value="{{Crypt::encrypt($idColaborador)}}" hidden name="idColaborador">
    <div class="form-group row mt-3">
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Nombre de documento</label>
            <input type="text" class="form-control brc-on-focus brc-blue-m1 col-sm-12" id="nombreDocumento" name="nombreDocumento" required="true">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1">
                            <span class="tooltip-info" data-rel="tooltip" data-placement="bottom" title="Introduzca palabras con las que se pueda identificar el documento, separado por enter">
                                <i class="fa-solid fa-circle-info blue"></i>
                            </span>{{ __('Palabras claves') }}
            </label>
            <input type="text" class="form-control palabrasClaves" id="palabrasClaves" name="palabrasClaves"/>
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-1" class="mb-0 text-blue-m1"> Documento </label>
            <!--<div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="documento" name="documento" aria-describedby="documento" multiple>
                    <label class="custom-file-label" for="documento"></label>
                </div>
            </div>-->
            <input type="file" id="documento" name="documento">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Fecha de Documento</label>
            <input type="date" data-inputmask-alias="date" data-inputmask-inputformat="mm/dd/yyyy" class="form-control text-left brc-on-focus brc-blue-m1 col-sm-12" id="fechaRegistro" name="fechaRegistro" required="true">
        </div>
    </div>
    <div class="form-group row mt-4">
        <div class="col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Comentarios:</label>
            <textarea class="form-control brc-h-blue-l3 brc-h-blue-m1 col-sm-12" id="id-textarea-limit2" maxlength="200" placeholder="Límite de texto 200 caracteres" name="descripcionDocumento" style="height: 38px" required="true"></textarea>
        </div>
    </div>
    </div>
</form>
