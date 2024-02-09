<?php

namespace App\Http\Controllers\Herramientas;

use App\Exports\ExportarExcel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportarController extends Controller
{
    public function exportarArchivo(Request $request,$nombreArchivo)
    {
        $datosDescargar = json_decode($request->session()->get('excelDescargar'));

        $export = new ExportarExcel([
            $datosDescargar
        ]);

        return Excel::download($export,$nombreArchivo.'.xlsx');
    }

    public function descargaArchivo($ruta)
    {
        $ruta = Crypt::decrypt($ruta);

        if (asset($ruta))
        {
            return response()->download($ruta);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }
}
