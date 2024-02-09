<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccionVacacionesController extends Controller
{
    public function edit()
    {
        return view('panel.configuracion.accionPersonal.vacaciones.accionVacaciones_edit');
    }

    public function update()
    {
        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->back()
            ->withSuccess("La acción de personal: Vacaciones, fue modificada con éxito!");
    }
}
