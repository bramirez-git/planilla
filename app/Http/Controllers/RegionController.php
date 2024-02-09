<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function index()
    {
        return view('configuracion.region.region_index');
    }
}
