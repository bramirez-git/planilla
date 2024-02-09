<?php

namespace App\Http\Controllers\Panel;

use App\Exports\ImportarExcel;
use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CatalogoCCSSController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getOcupacionesCCSS";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        //se guardan variables de busqueda
        $buscar = "";
        $columna = "";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = trim($request['buscar']);
            $parametros .= ',"filtro" : "'.$buscar.'"';
        }

        if(is_array($request['filtro'])){

            $filtro=$request['filtro'];

            if(!empty($filtro['buscar'])){
                $parametros.=',"columna" : "'.$filtro['buscar'].'"';
            }

            if(!empty($filtro['orden'])){
                $parametros.=',"orden" : "'.$filtro['orden'].'"';
            }

            if(!empty($filtro['tipo_orden'])){
                $parametros.=',"tipo_orden" : "'.$filtro['tipo_orden'].'"';
            }

        }

        $paginaActual = 1;
        if(isset($request["pagina"]))
        {
            $parametros .= ',"pagina" : "'.$request["pagina"].'"';
            $paginaActual = $request["pagina"];
        }

        $cantidad = 300;
        if(isset($request["cantidad"]))
        {
            $parametros .= ',"cantidad" : "'.$request["cantidad"].'"';
            $cantidad = $request["cantidad"];
        }

        $parametros .= '}';

        //se consume el api
        $catalogoOcupaciones = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($catalogoOcupaciones['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$catalogoOcupaciones['codigo'],
                 'error' =>$catalogoOcupaciones['codigo_error']]);
        }

        //si no dio error
        if($catalogoOcupaciones['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($catalogoOcupaciones['info']);
            //$request->session()->put('excelDescargar', $datosDescargar);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }

        $conjuntoResultados = [
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar??"",
            'to_look_for'=>$filtro['buscar']??"",
            'columna'=>$columna,
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'total'=>$catalogoOcupaciones['total_registos'],
            'total_paginas'=>$catalogoOcupaciones['total_paginas'],
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
        ];

        return view('panel.configuracion.catalogoCCSS.catalogoCCSS_index',$conjuntoResultados);
    }

    public function create()
    {
        session()->now('dropZone','1');
        return view('panel.configuracion.catalogoCCSS.catalogoCCSS_create');
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', 180);
        $correctos=0;

        //si recibe el archivo
        if($request->hasFile("archivo_excel")) {
            //lo convierte en array
            $datos = Excel::toArray(new ImportarExcel(), $request->file("archivo_excel"));

            $datos = $datos[0];
            if($request['incluye_titulo'])
            {
                unset($datos[0]);
            }

            $array_catalogo=[];
            foreach ($datos as $fila)
            {
                if(trim($fila[0])!="")
                {
                    $rowArray['codigo']= trim($fila[0]);
                    $rowArray['clasificacion']= trim($fila[1]);
                    $rowArray['nombre']= trim($fila[2]);
                    $array_catalogo[]=$rowArray;
                }
            }

            //variables a usar en el api
            $url = env("API_DIR")."insertarOcupacionCCSS";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'array_catalogo' => $array_catalogo
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            if(isset($respuesta['error']))
            {
                return $correctos;
            }

            //si no dio error
            if(isset($respuesta['estado']))
            {
                if($respuesta['estado'] == 'ok')
                {
                    $correctos++;
                }
            }

        }

        return $correctos;
    }
    public function plantillaCatalogoCCSS()
    {
        // Aquí asumimos que los archivos se almacenan en la carpeta 'archivos' dentro del almacenamiento de Laravel
        $path =public_path() . '/files/panel/Plantilla_Ocupaciones_CCSS.xlsx';
        return response()->download($path);
    }

    public function descargar_excel(Request $request){

        //Genera datos de excel
        $url = env("API_DIR")."exportarExcelOcupacionesCCSS";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'filtro' => isset($request['buscar']) ? $request['buscar'] : '',
            'orden' => isset($request['orden']) ? $request['orden'] : '',
            'columna' => isset($request['columna']) ? $request['columna'] : '',
            'tipo_orden' => isset($request['tipo_orden']) ? $request['tipo_orden'] : '',
        ];
        
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        if(!is_null($respuesta)) {
            //si da respuesta de error
            if (isset($respuesta['error'])) {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoFinal = collect(json_decode($datosDescargar));
                $resultadoExcel = $resultadoFinal[0];

                $datos_excel = [
                    'url' => $resultadoExcel,
                    'message' => '¡Descarga completada con éxito!',
                    'success' => true,
                ];

                return $datos_excel;
            }

        }else{
            $datos_excel = [
                'url' => '',
                'message' => 'Error, no se encontraron datos para generar el archivo',
                'success' => false,
            ];
            return $datos_excel;
        }
    }
}
