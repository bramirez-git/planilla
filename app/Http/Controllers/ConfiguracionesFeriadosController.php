<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionesFeriadosController extends Controller
{

    public function index()
    {
        return view('recursosHumanos.configuraciones.feriados.configuraciones_feriados_index');
    }

    public function create()
    {
        return view('recursosHumanos.configuraciones.feriados.configuraciones_feriados_create');
    }

    public function store()
    {
        return redirect()
            ->route('rh_configuracionFeriados.index')
            ->withSuccess("El feriado fue registrado con éxito!");
    }

    public function edit($idFeriado)
    {
        return view('recursosHumanos.configuraciones.feriados.configuraciones_feriados_edit');
    }

    public function update($idFeriado)
    {
        return redirect()
            ->route('rh_configuracionFeriados.index')
            ->withSuccess("El feriado fue modificado con éxito!");
    }

    public function destroy($idFeriado)
    {
        return redirect()
            ->route('rh_configuracionFeriados.index')
            ->withSuccess("El feriado fue eliminado con éxito!");
    }
}
