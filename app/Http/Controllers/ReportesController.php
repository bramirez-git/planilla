<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Storage\TempDir;
use App\Funciones\Storage\cls_storage;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ReportesController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index()
    {
        
        return view('reportes.reportes_index');
    }

    public function tablaIns(Request $request){

        
        $paginaActual = 1;
        if(isset($request["pagina"])){
            $paginaActual = $request["pagina"];
        }

        //Cantidad
        $cantidad = 300;
        if(isset($request["cantidad"])){
            $cantidad = $request["cantidad"];
        }

        //Buscador
        $buscar = "";
        if(isset($request['buscar']) && trim($request['buscar']) != "") {
            $buscar = $request['buscar'];
        }

        //Orden
        $orden = "fecha";
        $tipoOrden = "DESC";
        if(isset($request['orden']) && trim($request['orden']) != ""){
            $orden = $request['orden'];
            $tipoOrden = $request['tipo_orden'];
        }

        //Consulta historial de planillas
        $url = env("API_DIR")."consultarHistorialPlanillas";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'pagina' => $paginaActual,
            'cantidad' => $cantidad,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipoOrden
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
        // dd($respuesta);
        //En caso de error
        if(isset($respuesta['error'])){
            return view('historialPlanillas.historialPlanillas')->with(['errorMessage' => $respuesta['error']]);
        }

        //Datos del historial de planillas
        $totalPaginas = 0;
        $totalRegistros = 0;
        $resultadoFinal = array();
        if((isset($respuesta['estado'])) && ($respuesta['estado'] == 'ok')){
            $datosDescargar = json_encode($respuesta['info']);
            $resultadoFinal = collect(json_decode( $datosDescargar));
            $totalPaginas = $respuesta['total_paginas'];
            $totalRegistros = $respuesta['total_registros'];
        }

        //Guarda en session datos para el exportar a Excel
        $request->session()->put('sesionBuscadorBuscar', $buscar);
        $request->session()->put('sesionBuscadorOrden', $orden);
        $request->session()->put('sesionBuscadorTipoOrden', $tipoOrden);

        $conjuntoResultados = [
            'paginaActual'=> $paginaActual,
            'cantidad'=> $cantidad,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipoOrden,
            'total_paginas' => $totalPaginas,
            'total' => $totalRegistros,
            'resultado' => $resultadoFinal
        ];

        return view('reportes.reporte_INS', $conjuntoResultados);
    }


    public function crear_documento_ins(Request $request, $id_planilla){
        session(['mensaje_error' => 0]);
        $id_planilla =Crypt::decrypt($id_planilla);
        $nombre_archivo = 'INS';
        $rules = [
            'encabezado.numero_poliza'             => 'required|max:7'
            ,'encabezado.tipo_planilla'            => 'required|max:1'
            ,'encabezado.periodo_planilla'         => 'required|max:6'
            ,'encabezado.identificacion_tomador'   => 'required|max:20'
            ,'encabezado.numero_telefono'          => 'required|max:8'
            ,'encabezado.numero_fax'               => 'max:8'
            ,'encabezado.tipo_calendario'          => 'required|max:1'
            ,'encabezado.version_planilla'         => 'required|max:4'
            ,'encabezado.correo_padrono'           => 'required|max:50'
            ,'encabezado.direccion_fisica_padrono' => 'required|max:170'
            ,'cuerpo' => 'required'
            ,'cuerpo.*.tipo_identificacion'   => 'required|max:1'
            ,'cuerpo.*.numero_identificacion' => 'required|max:19'
            ,'cuerpo.*.numero_asegurado'      => 'required|max:20'
            ,'cuerpo.*.nombre_completo'       => 'required|max:15'
            ,'cuerpo.*.primer_apellido'       => 'required|max:15'
            ,'cuerpo.*.segundo_apellido'      => 'required|max:15'
            ,'cuerpo.*.fecha_nacimiento'      => 'required|max:10'
            ,'cuerpo.*.numero_telefono'       => 'required|max:8'
            ,'cuerpo.*.correo'                => 'required|max:40'
            ,'cuerpo.*.codigo_genero'         => 'required|max:1'
            ,'cuerpo.*.codigo_estado_civil'   => 'required|max:1'
            ,'cuerpo.*.codigo_nacionalidad'   => 'required|max:2'
            ,'cuerpo.*.salario_devengado'     => 'required|max:13'
            ,'cuerpo.*.dias_laborales'        => 'required|max:3'
            ,'cuerpo.*.horas_laborales'       => 'required|max:4'
            ,'cuerpo.*.codigo_jornada_laboral'=> 'required|max:2'
            ,'cuerpo.*.codigo_observacion'    => 'required|max:2'
            ,'cuerpo.*.codigo_ocupacion'      => 'required|max:5'
        ];
        
        $customMessages = [ 'required' => 'El campo :attribute es requerido.' ];

        $url = env("API_DIR")."generarTxtINSPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_planilla' => $id_planilla,
            'id_empresa' => session()->get('id_cliente'),
            'pagina' => '1',
            'cantidad' => '50',
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        if (isset($respuesta['error'])) {
            return redirect()->back()->withErrors(['error' => $respuesta['error']]);
        }

        if (!is_array($respuesta['info'])) {
            return redirect()->back()->withErrors(['error' => 'La respuesta no cumple con las características para generar el archivo']);
        }

        $validator = Validator::make($respuesta['info'], $rules, $customMessages);

        if ($respuesta['estado'] === 'ok') {

            $dato_txt = [
                'encabezado' =>[ 
                    [
                        [ "dato"  => $respuesta['info']['encabezado']['numero_poliza'],"numero_valores" => "7"]
                        ,["dato"  => $respuesta['info']['encabezado']['tipo_planilla'],"numero_valores" => "1"]
                        ,["dato"  => $respuesta['info']['encabezado']['periodo_planilla'],"numero_valores" => "7"]
                        ,["dato"  => $respuesta['info']['encabezado']['identificacion_tomador'],"numero_valores" => "20"]
                        ,["dato"  => $respuesta['info']['encabezado']['numero_telefono'],"numero_valores" => "8"]
                        ,["dato"  => $respuesta['info']['encabezado']['numero_fax'],"numero_valores" => "8"]
                        ,["dato"  => $respuesta['info']['encabezado']['tipo_calendario'],"numero_valores" => "2"]
                        ,["dato"  => $respuesta['info']['encabezado']['version_planilla'],"numero_valores" => "4"]
                    ],
                    [
                        ["dato"  => "Email ","numero_valores" => "6"]
                        ,["dato" => $respuesta['info']['encabezado']['correo_patrono'],"numero_valores" => "1"]
                    ],
                    [
                        ["dato"  => "Domicilio ","numero_valores" => "10"],
                        ["dato"  => $respuesta['info']['encabezado']['direccion_fisica_patrono'],"numero_valores" => "170"],
                    ],
                ],
                'cuerpo' => $respuesta['info']['cuerpo'],
                'valores_cuerpo' => [
                    'tipo_identificacion' => '1'
                    ,'numero_identificacion' => '19'
                    ,'numero_asegurado' => '20'
                    ,'nombre_completo' => '15'
                    ,'primer_apellido' => '15'
                    ,'segundo_apellido' => '15'
                    ,'fecha_nacimiento' => '10'
                    ,'numero_telefono' => '8'
                    ,'correo' => '40'
                    ,'codigo_estado_civil' => '1'
                    ,'codigo_genero' => '1'
                    ,'codigo_nacionalidad' => '2'
                    ,'salario_devengado' => '13'
                    ,'dias_laborales' => '3'
                    ,'horas_laborales' => '4'
                    ,'codigo_jornada_laboral' => '2'
                    ,'codigo_observacion' => '2'
                    ,'codigo_ocupacion' => '5' 
                ],
            ];

            $datos_j = new Request($dato_txt);
            $res = $this->descargaTxt($datos_j, $nombre_archivo);
            $data_descarga = json_decode($res->getContent());

            if ($validator->fails()) {
                session(['mensaje_error' => 1]);
                return $res;
            }

            return $res;
            
        }
    }


    public function descargaTxt(Request $request, $nombre_archivo){

        $rules = [
            'encabezado'        => 'required'
            ,'cuerpo'           => 'required'
            ,'valores_cuerpo'   => 'required'
        ];
        
        $customMessages = [ 'required' => 'El campo :attribute es requerido.' ];
        $this->validate($request, $rules, $customMessages);
        $datos_json = $request->all();

        try {

            $dir = cls_storage::dir_warehouse_tmp_backup_doc('53');

            // Nombre del archivo Y tipo de archivo
            $nombre_archivo = 'Documento_'.$nombre_archivo.'_'. uniqid() .'.txt';
            $ruta = TempDir::create($dir).'/'.$nombre_archivo;

            $file = fopen($ruta, "w");

            if (!$file) {
                return redirect()->back()->withErrors(['error' => 'No se pudo abrir el archivo para realizar la escritura.']);
            }
            
            //Se crea el archivo 
            if (is_array($datos_json)) {
                foreach ($datos_json['encabezado'] as $data) {
                    if (is_array($data)) {
                        $errores = array_filter($data, function ($value) {
                            return !(is_array($value) && isset($value['dato'], $value['numero_valores']) && $value['dato'] !== '');
                        });
                    
                        $linea_detalle = implode('', array_map(function ($value) {
                            if (is_array($value) && isset($value['dato'], $value['numero_valores'])) {
                                return str_pad(substr($value['dato'], 0, $value['numero_valores']), $value['numero_valores'], " ", STR_PAD_RIGHT);
                            }
                    
                            return '';
                        }, $data));
                    
                        if (!empty($errores)) {
                            $error_linea = "********************************************************************************" . PHP_EOL;
                            $error_linea .= $linea_detalle . PHP_EOL;
                            $error_linea .= "MSG: Datos faltantes o vacíos." . PHP_EOL;
                            $error_linea .= "********************************************************************************" . PHP_EOL;
                    
                            fwrite($file, $error_linea);
                        } else {
                            fwrite($file, $linea_detalle . PHP_EOL);
                        }
                    }
                }

                foreach ($datos_json['cuerpo'] as $registro) {

                    if (is_array($registro)) {
                        $errores = array_filter($registro, function ($value) {
                            return $value === '';
                        });
                    
                        $linea_cuerpo = implode('', array_map(function ($key, $value) use ($datos_json) {
                            $longitud = isset($datos_json['valores_cuerpo'][$key]) ? $datos_json['valores_cuerpo'][$key] : strlen($value);
                            $valor_linea = substr($value, 0, $longitud);
                            return str_pad($valor_linea, $longitud, " ", STR_PAD_RIGHT);
                        }, array_keys($registro), $registro));
                    
                        if (!empty($errores)) {
                            $error_linea = "********************************************************************************" . PHP_EOL;
                            $error_linea .= $linea_cuerpo . PHP_EOL;
                            $error_linea .= "MSG: El campo " . implode(', ', array_keys($errores)) . " no cumple con los valores" . PHP_EOL;
                            $error_linea .= "********************************************************************************" . PHP_EOL;
                    
                            fwrite($file, $error_linea);
                        } else {
                            fwrite($file, $linea_cuerpo . PHP_EOL);
                        }
                    }
                }
            }

            fclose($file);
            if ($linea_cuerpo != '' && $linea_detalle != '') {

                // $response = response()->make(file_get_contents($ruta));

                // // Se establecen los encabezados para indicar que es un archivo para descargar
                // $response->header('Content-Type', 'text/plain');
                // $response->header('Content-Disposition', 'attachment; filename=' . basename($ruta));
    
                // Se elimina el archivo después de enviarlo al navegador
                // return $response;


                return response()->download($ruta, $nombre_archivo);
            }

            return redirect()->back()->withErrors(['error' => 'No se pudo abrir el archivo para realizar la escritura.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Se produjo un error: '.$e]);
        }
    }

    public function mostrar_variable_temp(Request $request){
       $user_id = $request->session()->get('mensaje_error');
       return $user_id;
    }

}
