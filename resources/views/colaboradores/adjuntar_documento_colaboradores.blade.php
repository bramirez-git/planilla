<form enctype="multipart/form-data" method="POST" id="frm-documento-colaboradores" action="{{route('leerArchivo')}}">
{{ csrf_field() }}
    <div class="col-md-6 col-sm-12">
        <p for="id-form-field-1" class="mb-0 text-blue-m1"> Ingresar archivo .txt </p>
        <input type="file" id="documento" name="documento" required accept=".txt">
    </div>
</form>



