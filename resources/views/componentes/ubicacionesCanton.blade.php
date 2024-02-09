

<select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="canton" name="canton" onchange="distritos()">
    @foreach($cantones as $canton)
        <option value="{{ $canton->id_canton }}">{{ $canton->canton }}</option>
    @endforeach
</select>

