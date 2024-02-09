<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccionPermisosController extends Controller
{
    public function edit()
    {
        return view('panel.configuracion.accionPersonal.permisos.accionPermisos_edit');
    }

    public function update()
    {
        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->back()
            ->withSuccess("La acción de personal: Permisos, fue modificada con éxito!");
    }
}
