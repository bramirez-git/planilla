

<select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="barrio" name="barrio" >
    @foreach($barrios as $barrio)
        <option value="{{ $barrio->id_barrio }}">{{ $barrio->barrio }}</option>
    @endforeach
</select>

