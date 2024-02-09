<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionesController extends Controller
{

    public function index()
    {
        return view('recursosHumanos.configuraciones.configuraciones_index');
    }

}
