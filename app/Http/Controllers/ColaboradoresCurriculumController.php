<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class ColaboradoresCurriculumController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        $fechaInicio = Carbon::createFromFormat('d/m/Y','15/10/2021');
        $fechaFin = Carbon::createFromFormat('d/m/Y', '15/11/2023');
        $fechaInicio= Carbon::parse($fechaInicio)->isoFormat('MMMM [del] YYYY');
        $fechaFin= Carbon::parse($fechaFin)->isoFormat('MMMM [del] YYYY');


        $conjuntoResultados = [
            'idColaborador' => $request["id_colaborador"],
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin];

        return view('colaboradores.curriculum.colaboradoresCurriculum_index',$conjuntoResultados);
    }

    public function create()
    {
        return view('colaboradores.curriculum.colaboradoresCurriculum_create');
    }

    public function store(Request $request)
    {
        return redirect()->back()->withSuccess("Se registró el atestado del currículum con éxito!");
    }


    public function show($idColaborador)
    {
        $id_colaborador = Crypt::decrypt($idColaborador);
        return view('colaboradores.curriculum.colaboradoresCurriculum_show');
    }
}
