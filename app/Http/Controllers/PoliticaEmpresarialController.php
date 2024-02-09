<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliticaEmpresarialController extends Controller
{

    public function index()
    {
        return view('recursosHumanos.politicaEmpresarial.politicaEmpresarial_index');
    }

    public function create()
    {
        return view('recursosHumanos.politicaEmpresarial.politicaEmpresarial_create');
    }

    public function store()
    {
        return redirect()
            ->route('politicaEmpresarial.index')
            ->withSuccess("La política empresarial fue registrada con éxito!");
    }

    public function edit($idPolitica)
    {
        return view('recursosHumanos.politicaEmpresarial.politicaEmpresarial_edit');
    }

    public function update($idPolitica)
    {
        return redirect()
            ->route('politicaEmpresarial.index')
            ->withSuccess("La política empresarial fue modificada con éxito!");
    }

    public function destroy($idPolitica)
    {
        return redirect()
            ->route('politicaEmpresarial.index')
            ->withSuccess("La política empresarial fue eliminada con éxito!");
    }
}
