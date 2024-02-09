<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionesSolicitudesController extends Controller
{

    public function index()
    {
        return view('recursosHumanos.configuraciones.solicitudes.configuraciones_solicitudes_index');
    }

    public function create()
    {
        return view('recursosHumanos.configuraciones.solicitudes.configuraciones_solicitudes_create');
    }

    public function store()
    {
        return redirect()
            ->route('rh_configuracionTipoSolicitudes.index')
            ->withSuccess("El tipo de solicitud fue registrado con éxito!");
    }

    public function edit($tipoVacaciones)
    {
        return view('recursosHumanos.configuraciones.solicitudes.configuraciones_solicitudes_edit');
    }

    public function update($tipoVacaciones)
    {
        return redirect()
            ->route('rh_configuracionTipoSolicitudes.index')
            ->withSuccess("El tipo de solicitud fue modificado con éxito!");
    }

    public function destroy($tipoVacaciones)
    {
        return redirect()
            ->route('rh_configuracionTipoSolicitudes.index')
            ->withSuccess("El tipo de solicitud fue eliminado con éxito!");
    }
}
