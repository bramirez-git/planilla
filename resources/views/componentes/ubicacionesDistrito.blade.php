

<select data-placeholder="Seleccione una opción..." class="chosen-select form-control" id="distrito" name="distrito" onchange="barrios()">
    @foreach($distritos as $distrito)
        <option value="{{ $distrito->id_distrito }}">{{ $distrito->distrito }}</option>
    @endforeach
</select>

