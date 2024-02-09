<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportesPanelController extends Controller
{
    public function index()
    {
        return view('panel.reportes.reportes_index');
    }
}
