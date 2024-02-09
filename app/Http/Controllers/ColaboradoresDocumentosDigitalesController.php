<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
use ZipArchive;

class ColaboradoresDocumentosDigitalesController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);

        //variables a usar en el api
        $url = env("API_DIR")."getColaboradorDocumentos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_colaborador": "'.$id_colaborador.'"';

        //se guardan variables de busqueda
        $buscar = "";
        $categoria="";
        $fecha="";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = $request['buscar'];
            $parametros .= ',"buscar" : "'.$buscar.'"';
        }

        if(isset($request['categoria']) && trim($request['categoria']) != "")
        {
            $categoria = $request['categoria'];
            $parametros .= ',"filtro_categoria" : "'.$categoria.'"';
        }

        if(isset($request['fecha']) && trim($request['fecha']) != "")
        {
            $parametros .= ',"filtro_fecha" : "'.Carbon::createFromFormat('d/m/Y', trim($request['fecha']))->format('Y-m-d').'"';
        }

        //se guardan variables de orden
        $orden = "";
        $tipo_orden = "";

        if(isset($request['orden']) && trim($request['orden']) != "")
        {
            $orden = $request['orden'];
            $tipo_orden = $request['tipo_orden'];
            $parametros .= ',"orden" : "'.$orden.'"';
            $parametros .= ',"tipo_orden" : "'.$tipo_orden.'"';
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
        //dd($parametros);

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($respuesta['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$respuesta['codigo'],
                    'error' =>$respuesta['codigo_error'] ]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

        }

        $conjuntoResultados = ['id_colaborador' => $id_colaborador,
            'resultado' => $resultadoFinal,
            'buscar'=>$buscar,
            'categoria'=>$categoria,
            'fecha'=>$fecha,
            'orden'=>$orden,
            'tipo_orden'=>$tipo_orden,
            'total'=>$respuesta['total_documentos'],
            'total_paginas'=>$respuesta['total_paginas'],
            'cantidad'=> $cantidad,
            'paginaActual'=> $paginaActual];

        //dd($conjuntoResultados);

        return view('colaboradores.documentosDigitales.colaboradoresDocumentosDigitales_index',$conjuntoResultados);
    }

    public function show($idColaborador)
    {
        $id_colaborador = Crypt::decrypt($idColaborador);
        $id_documento = explode("-", $id_colaborador)[0];
        $id_colaborador = explode("-", $id_colaborador)[1];

        //Obtener acciones de personal
        $url = env("API_DIR") . "getColaboradorDocumento";
        $tipo = "POST";
        $parametros = '{"usuario" : "' . env("API_USUARIO") . '", "clave" : "' . env("API_CLAVE") . '","id_documento": "' . $id_documento . '","id_colaborador": "' . $id_colaborador . '"}';

        $respuesta = $this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        //si da respuesta de error
        if (isset($respuesta['error'])) {

            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);

        } else {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoAccion = collect(json_decode($datosDescargar));
                $resultadoAccion = $resultadoAccion[0];
                //dd($resultadoAccion);
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $id_colaborador,
            'resultadoAccion'=>$resultadoAccion];

        return view('colaboradores.documentosDigitales.colaboradoresDocumentosDigitales_show',$conjuntoResultados);
    }

    public function ui_documento_digitales($idColaborador)
    {
        $data = ['idColaborador'=>$idColaborador];
        $html = View::make('colaboradores.documentosDigitales.adjuntarDocumentos', $data)->render();
        $js = asset('js/suggestInput/jquery.amsify.suggestags.js'); // Ajusta la ruta a tu archivo JavaScript
        $css = asset('css/suggestInput/amsify.suggestags.css'); // Ajusta la ruta a tu archivo CSS
        $js2 = asset('js/herramientasPlanillaProfesional.js');

        return response()->json(['html' => $html, 'js' => $js, 'css' => $css,'js2' => $js2]);
    }

    public function uiEnviarCorreo($idColaborador)
    {
        $id_documento = explode("-", $idColaborador)[0];
        $id_colaborador = explode("-", $idColaborador)[1];

        $data = ['id_documento'=>$id_documento,'id_colaborador'=>$id_colaborador];
        $html = View::make('colaboradores.documentosDigitales.enviarCorreo', $data)->render();
        $js = asset('estilos/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.js');

        return response()->json(['html' => $html,'js' => $js]);
    }

    public function descargar_doc_digitales(Request $request){
        {
            // Obtén la lista de archivos que deseas comprimir desde la solicitud
            $files=$request->input('files');

            // Nombre del archivo zip resultante
            $zipFileName='documentosDigitales.zip';

            // Ruta donde se guardará el archivo zip
            $zipFilePath=public_path($zipFileName);

            // Crea una instancia de ZipArchive
            $zip=new ZipArchive;

            // Abre el archivo zip en modo escritura
            if($zip->open($zipFilePath, ZipArchive::CREATE)===TRUE){
                foreach($files as $file){
                    // Agrega cada archivo al archivo zip
                    $filePath=public_path($file['url']);
                    // Divide la URL en partes usando '/' como delimitador
                    $parts = explode('/', $file['url']);

                    // Encuentra la posición de 'documentosDigitales' en el array
                    $key = array_search('documentosDigitales', $parts);

                    // Obtiene la subcadena después de 'documentosDigitales'
                    $fileName = basename(implode('/', array_slice($parts, $key + 1)));
                    // Verifica si el archivo existe antes de agregarlo al zip
                    if(file_exists($filePath)){
                        $zip->addFile($filePath, $file['index'].'-'.$fileName);
                    }
                    else{
                        // Puedes manejar archivos que no existen si es necesario
                        // por ejemplo, omitiéndolos o lanzando una excepción
                    }
                }

                // Cierra el archivo zip
                $zip->close();

                // Convierte el contenido del archivo zip a Base64
                $base64Content = base64_encode(file_get_contents($zipFilePath));

                // Elimina el archivo zip después de obtener el contenido Base64
                unlink($zipFilePath);

                // Devuelve la respuesta con el contenido Base64
                return response()->json([
                    'success' => true,
                    'info' => [
                        'blob' => $base64Content,
                        'fileName' => $zipFileName,
                    ],
                ]);
            }
            else{
                return response()->json(['error'=>'No se pudo crear el archivo zip'], 500);
            }
        }

    }

}
