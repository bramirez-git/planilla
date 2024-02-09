<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportarExcel implements FromView,ShouldAutoSize
{
    protected $datosDescargar;
    protected $titulos;

    public function __construct(array $datosDescargar)
    {
        $this->datosDescargar = $datosDescargar;

        //obtiene los titulos
        $this->titulos = array_keys((array)$this->datosDescargar[0][0]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('componentes.descargarExcel',['datosDescargar' => $this->datosDescargar[0],
            'titulos' => $this->titulos]);
    }
}
