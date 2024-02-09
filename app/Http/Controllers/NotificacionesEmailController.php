<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesEmailController extends Controller
{

    public function create()
    {
        session()->now('wysiwyg','1');
        return view('configuracion.miscelaneos.notificacionesEmail.notificacionesEmail_create');
    }

    public function store()
    {
        return redirect()
            ->route('miscelaneos.index')
            ->withSuccess("La notificación fue registrada con éxito!");
    }

    public function edit($idNotificacionEmail)
    {
        session()->now('wysiwyg','1');
        return view('configuracion.miscelaneos.notificacionesEmail.notificacionesEmail_edit');
    }

    public function update($idNotificacionEmail)
    {
        return redirect()
            ->route('miscelaneos.index')
            ->withSuccess("La notificación fue modificada con éxito!");
    }

    public function destroy($idNotificacionEmail)
    {
        return redirect()
            ->route('miscelaneos.index')
            ->withSuccess("La notificación con el id {$idNotificacionEmail} fue eliminado con éxito!");
    }
}
