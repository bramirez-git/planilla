<form autocomplete="off" enctype="multipart/form-data" method="POST" id="frm-enviar-correo" action="{{route('documentos.update',[Crypt::encrypt($id_colaborador)])}}">
    @csrf
    @method('PUT')
    <input type="text" value="{{Crypt::encrypt($id_documento)}}" hidden name="id_documento">
    <div class="form-group row mt-3">
        <div class="col-md-12 col-sm-12">
            <label for="id-form-field-focus-1" class="mb-0 text-blue-m1"> Nombre de documento</label>
            <input type="text" id="tag-input" class="form-control" name="correo" required="true">
        </div>
    </div>

</form>
