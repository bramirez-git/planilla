<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('configuracion.usuarios.usuarios_index');
    }

    public function create()
    {
        return view('configuracion.usuarios.usuarios_create');
    }

    public function store()
    {
        return redirect()
            ->route('usuario.index')
            ->withSuccess("El usuario fue registrado con éxito!");
    }

    public function edit($idUsuario)
    {
        return view('configuracion.usuarios.usuarios_edit');
    }

    public function update($idUsuario)
    {
        return redirect()
            ->route('usuario.index')
            ->withSuccess("El usuario fue modificado con éxito!");
    }

    public function destroy($idUsuario)
    {
        return redirect()
            ->route('usuario.index')
            ->withSuccess("El usuario con la identificacion {$idUsuario} fue eliminado con éxito!");
    }
}
