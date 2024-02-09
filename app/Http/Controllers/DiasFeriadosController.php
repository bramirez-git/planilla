<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiasFeriadosController extends Controller
{

    public function index()
    {
        return view('diasFeriados.diasFeriados_index');
    }
}
