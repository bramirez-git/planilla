<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccionIncapacidadController extends Controller
{
    public function edit()
    {
        return view('panel.configuracion.accionPersonal.incapacidad.accionIncapacidad_edit');
    }

    public function update()
    {
        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->back()
            ->withSuccess("La acción de personal: incapacidad, fue modificada con éxito!");
    }
}
