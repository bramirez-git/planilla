<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MiscelaneosController extends Controller
{
    public function index()
    {
        return view('panel.miscelaneos.miscelaneos_index');
    }
}
