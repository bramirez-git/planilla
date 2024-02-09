<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
//use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
//use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
//use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class PadronCompletoController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index()
    {
        session()->now('plupload','0');

        return view('panel.configuracion.padronCompleto.padronCompleto_index');
    }

    public function padron_show(Request $request)
    {
        session()->now('plupload','0');

        //Pagina
        $paginaActual = 1;
        if(isset($request["pagina"])){
            $paginaActual = $request["pagina"];
        }

        //Cantidad
        $cantidad = 300;
        if(isset($request["cantidad"])){
            $cantidad = $request["cantidad"];
        }
        //Filtro
        $filtro = "";
        if(is_array($request['filtros'])){

            $filtros=$request['filtros'];

            if(isset($filtros['cedula']) && trim($filtros['cedula']) != "") {
                $filtro = $filtros['cedula'];
            }

        }

        //Consulta padron electoral
        $url = env("API_DIR")."busquedaPadronElectoralPorCedula";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'cedula' => $filtro,
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //En caso de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
            return response()->json(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
//            return view('panel.configuracion.padronCompleto.padronCompleto_show')->with(['errorMessage' => $respuesta['error']]);
        }

        $resultadoFinal = array();
        $totalPaginas = 0;
        $totalRegistros = 0;
        if((isset($respuesta['estado'])) && ($respuesta['estado'] == 'ok') && isset($respuesta['info'][0])){
            $datosDescargar = json_encode($respuesta['info'][0]);
            $resultadoFinal = collect(json_decode( $datosDescargar));
        }

        //Guarda en session datos para el exportar a Excel
        $request->session()->put('sesionBuscadorFiltro', $filtro);

        $conjuntoResultados = [
            'success'=> true,
            'total_paginas' => $totalPaginas,
            'total' => $totalRegistros,
            'paginaActual'=> $paginaActual,
            'cantidad'=> $cantidad,
            'filtro' => $filtro,
            'resultado' => $resultadoFinal
        ];

        return view('panel.configuracion.padronCompleto.padronCompleto_show', $conjuntoResultados);
    }

    public function create()
    {
        session()->now('plupload','1');
        return view('panel.configuracion.padronCompleto.padronCompleto_create');
    }

    public function cargarPadronElectoral(Request $request){
        $targetDir = public_path('files/panel/carga_padron');
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
        }

        // Return Success JSON-RPC response
        session()->put('archivo_padron_electoral', $fileName);
        session()->save();
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }

    public function guardarPadronElectoral(Request $request){
        $resultado = "error";

        if((isset($_POST["mantenimiento"])) && ($_POST["mantenimiento"] == "guardar_padron")) {
            if (session()->has('archivo_padron_electoral')){
                $nombre_archivo_padron_electoral = session()->get('archivo_padron_electoral');

                if($nombre_archivo_padron_electoral != ""){
                    //Cargar datos del padron electoral
                    $urlPadron = env("API_DIR")."cargarPadronElectoral";
                    $conjuntoParametrosPadron = [
                        'usuario' => env("API_USUARIO"),
                        'clave' => env("API_CLAVE"),
                        'url_txt_padron_electoral' => url('/files/panel/carga_padron/') . "/" . $nombre_archivo_padron_electoral
                    ];
                    $respuestaPadron = $this->general->consultaApiMedianteParametrosProcesosPesados($urlPadron, $conjuntoParametrosPadron);

                    //Si da respuesta de error
                    if((isset($respuestaPadron["estado"])) && ($respuestaPadron["estado"] == "ok")){
                        $resultado = "ok";
                    }
                }
            }
        }
        echo $resultado;
        die();
    }

    public function descargarExcelPadron(Request $request)
    {
        if((isset($_POST["mantenimiento"])) && ($_POST["mantenimiento"] == "exportar_excel")){
            //Datos del buscador y orden
            $filtro = $request->session()->get('sesionBuscadorFiltro');
            $buscar = $request->session()->get('sesionBuscadorBuscar');
            $orden  = $request->session()->get('sesionBuscadorOrden');
            $tipoOrden = $request->session()->get('sesionBuscadorTipoOrden');

            //Descargar pdf del prestamo
            $url = env("API_DIR")."exportarExcelPadronElectoral";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'filtro' => $filtro,
                'buscar' => $buscar,
                'orden' => $orden,
                'tipo_orden' => $tipoOrden
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);


            //Url del excel del padron electoral
            $url_excel_padron = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_excel_padron = $respuesta["info"];
                }
            }

            return $url_excel_padron;
        }
    }

}
