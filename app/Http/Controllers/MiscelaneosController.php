<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscelaneosController extends Controller
{

    public function index()
    {
        return view('configuracion.miscelaneos.miscelaneos_index');
    }
}
