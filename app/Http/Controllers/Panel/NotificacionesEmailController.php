<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificacionesEmailController extends Controller
{

    public function create()
    {
        session()->now('wysiwyg','1');
        return view('panel.miscelaneos.notificacionesEmail.notificacionesEmail_create');
    }

    public function store()
    {
        return redirect()
            ->route('panelMiscelaneos.index')
            ->withSuccess("La notificación fue registrada con éxito!");
    }

    public function edit($idNotificacionEmail)
    {
        session()->now('wysiwyg','1');
        return view('panel.miscelaneos.notificacionesEmail.notificacionesEmail_edit');
    }

    public function update($idNotificacionEmail)
    {
        return redirect()
            ->route('panelMiscelaneos.index')
            ->withSuccess("La notificación fue modificada con éxito!");
    }

    public function destroy($idNotificacionEmail)
    {
        return redirect()
            ->route('panelMiscelaneos.index')
            ->withSuccess("La notificación con el id {$idNotificacionEmail} fue eliminado con éxito!");
    }
}
