<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpersonalizacionController extends Controller
{
    public function index()
    {
        return view('impersonalizacion.impersonalizacion_index');
    }
}
