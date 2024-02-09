<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReclutamientoController extends Controller
{

    public function index()
    {
        return view('recursosHumanos.reclutamiento.reclutamiento_index');
    }
}
