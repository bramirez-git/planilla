<?php

namespace App\Http\Controllers;

use App\Funciones\AccionesPersonal\funcionesAccionesPersonal;
use App\Funciones\Generales\funcionesGenerales;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;



class ColaboradoresAccionPersonalController extends Controller
{
    private $general;
    private $funcionesAcciones;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
        $this->funcionesAcciones = new funcionesAccionesPersonal();
    }

    public function index(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);

        //Obtener datos generales
        $url = env("API_DIR") . "getColaborador";
        $tipo = "POST";
        $parametros = '{"usuario" : "' . env("API_USUARIO") . '", "clave" : "' . env("API_CLAVE") . '","id_empresa": "' . $request->session()->get('id_cliente') . '","id_colaborador": "' . $id_colaborador . '"}';

        $respuesta = $this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        //si da respuesta de error
        if (isset($respuesta['error'])) {
            if ($respuesta['codigo'] != "error_registro") {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            } else {
                $resultadoColaborador = [];
            }
        } else {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoColaborador = collect(json_decode($datosDescargar));
                $resultadoColaborador = $resultadoColaborador[0];
            }
        }

        //Obtener acciones de personal
        $url = env("API_DIR") . "getColaboradorAccionesPersonal";
        $tipo = "POST";
        $parametros = '{"usuario" : "' . env("API_USUARIO") . '", "clave" : "' . env("API_CLAVE") . '","id_empresa": "' . $request->session()->get('id_cliente') . '","id_colaborador": "' . $id_colaborador . '"';

        //se guardan variables de busqueda
        $buscar = "";

        if (isset($request['buscar']) && trim($request['buscar']) != "") {
            $buscar = $request['buscar'];
            $parametros .= ',"buscar" : "' . $buscar . '"';
        }

        //se guardan variables de orden
        $orden = "";
        $tipo_orden = "";

        if (isset($request['orden']) && trim($request['orden']) != "") {
            $orden = $request['orden'];
            $tipo_orden = $request['tipo_orden'];
            $parametros .= ',"orden" : "' . $orden . '"';
            $parametros .= ',"tipo_orden" : "' . $tipo_orden . '"';
        }

        $paginaActual = 1;
        if (isset($request["pagina"])) {
            $parametros .= ',"pagina" : "' . $request["pagina"] . '"';
            $paginaActual = $request["pagina"];
        }

        $cantidad = 300;
        if (isset($request["cantidad"])) {
            $parametros .= ',"cantidad" : "' . $request["cantidad"] . '"';
            $cantidad = $request["cantidad"];
        }

        $parametros .= '}';

        $respuesta = $this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        //si da respuesta de error
        if (isset($respuesta['error'])) {
            if ($respuesta['codigo'] != "error_registro") {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            } else {
                $resultadoAcciones = [];
            }
        } else {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                if ($datosDescargar != "[]") {
                    //lo convierte en colección
                    $resultadoAcciones = collect(json_decode($datosDescargar));
                    //dd($resultadoAcciones);
                } else {
                    //lo convierte en colección
                    $resultadoAcciones = collect(json_decode($datosDescargar));
                }
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $id_colaborador,
            'resultadoColaborador' => $resultadoColaborador,
            'resultadoAcciones' => $resultadoAcciones,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipo_orden,
            'total' => $respuesta['total_acciones_personal'],
            'total_paginas' => $respuesta['total_paginas'],
            'cantidad' => $cantidad,
            'paginaActual' => $paginaActual];

        return view('colaboradores.accionPersonal.colaboradoresAccionPersonal_index', $conjuntoResultados);
    }

    public function create(Request $request)
    {
        //Obtiene todos los catalogos
        $accionesPersonal = $this->general->obtenerCatalogo("getCategoriasAccionPersonalEmpresa", $request->session()->get('id_cliente'));

        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        //Obtener datos generales
        $url = env("API_DIR") . "getColaborador";
        $tipo = "POST";
        $parametros = '{"usuario" : "' . env("API_USUARIO") . '", "clave" : "' . env("API_CLAVE") . '","id_empresa": "' . $request->session()->get('id_cliente') . '","id_colaborador": "' . $id_colaborador . '"}';

        $respuesta = $this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        //si da respuesta de error
        if (isset($respuesta['error'])) {
            if ($respuesta['codigo'] != "error_registro") {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            } else {
                $resultadoColaborador = [];
            }
        } else {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoColaborador = collect(json_decode($datosDescargar));
                $resultadoColaborador = $resultadoColaborador[0];
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $id_colaborador,
            'resultadoColaborador' => $resultadoColaborador,
            'accionesPersonal' => $accionesPersonal];

        //se inicializa contenedor de directorios de documentos
        session(['documentos'=>""]);

        //dd($conjuntoResultados);

        return view('colaboradores.accionPersonal.colaboradoresAccionPersonal_create', $conjuntoResultados);
    }

    public function store(Request $request)
    {
        $id_colaborador = Crypt::decrypt(trim($request["id_colaborador"]));
        $codigos = explode("-", $request["tipoAccion"]);
        $subcodigos = explode("-", $request["subTipoAccion"]);

        //Crear colaborador en api
        $url = env("API_DIR") . "crearColaboradorAccionPersonal";
        $conjuntoParametros = $this->funcionesAcciones->obtenerParametrosGenerales($request,$id_colaborador,$codigos,$subcodigos);

        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
        //dd($respuesta);

        //si da respuesta de error
        if (isset($respuesta['error'])) {
            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        //si no da error redirige con mensaje de éxito
        return redirect()
            //->back()
            ->action('ColaboradoresAccionPersonalController@index',['id_colaborador'=>trim($request["id_colaborador"])])
            ->withSuccess("La acción de personal fue registrada con éxito!");
    }

    public function show(Request $request, $idColaborador)
    {
        $idColaborador = Crypt::decrypt($idColaborador);
        $idAccion = explode("-", $idColaborador)[0];
        $idColaborador = explode("-", $idColaborador)[1];

        //Obtener acciones de personal
        $url = env("API_DIR") . "getColaboradorAccionPersonal";
        $tipo = "POST";
        $parametros = '{"usuario" : "' . env("API_USUARIO") . '", "clave" : "' . env("API_CLAVE") . '","id_empresa": "' . $request->session()->get('id_cliente') . '","id_colaborador": "' . $idColaborador . '","id_accion_personal": "' . $idAccion . '"}';

        $respuesta = $this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        //si da respuesta de error
        if (isset($respuesta['error'])) {
            if ($respuesta['codigo'] != "error_registro") {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            } else {
                $resultadoAccion = [];
            }
        } else {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                if ($datosDescargar != "[]") {
                    //lo convierte en colección
                    $resultadoAccion = collect(json_decode($datosDescargar));
                    $resultadoAccion = $resultadoAccion[0];
                    //dd($resultadoAccion);
                } else {
                    //lo convierte en colección
                    $resultadoAccion = collect(json_decode($datosDescargar));
                }
            }
        }

        session()->now('fullCalendar', '1');

        $fechasAccion=[];
        if($resultadoAccion->fechas1 != "") {
            if ($resultadoAccion->tipo_fechas == "fechas") {
                $fechasOrdenar = explode(",", $resultadoAccion->fechas1);
                $fechasOrdenar = $this->general->ordena_array_fecha($fechasOrdenar);
                $fechasAccion = $this->general->indica_fechas_seguidas($fechasOrdenar);
            }
            else{
                $fechasOrdenar = explode("|", $resultadoAccion->fechas1);
                $fecha1 = $fechasOrdenar[0];
                $fecha2 = $fechasOrdenar[1];

                $fechasAccion[] = [
                    "fecha" => $fecha1.'|'.$fecha2
                ];

                //dd($fechasAccion);
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'resultadoAccion' => $resultadoAccion,
            'fechasAccion'=>$fechasAccion];

        //dd($conjuntoResultados);

        return view('colaboradores.accionPersonal.colaboradoresAccionPersonal_show', $conjuntoResultados);
    }



    public function descargar_excel(Request $request){

        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);

        //Genera datos de excel
        $url = env("API_DIR")."exportarExcelColaboradorAccionesPersonal";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => $id_colaborador,
            "id_empresa" => $request->session()->get('id_cliente'),
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

    public function consulta_dias(Request $request){

        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        $id_accion_personal = Crypt::decrypt($request["id_accion_personal"]);
        $url = env("API_DIR")."getColaboradorAccionPersonal";
        
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            "id_empresa" => $request->session()->get('id_cliente'),
            'id_colaborador' => $id_colaborador,
            'id_accion_personal' => $id_accion_personal,
        ];
        
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    
        if(!is_null($respuesta)) {
            if (isset($respuesta['error'])) {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';
    
                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }
    
            if ($respuesta['estado'] == 'ok') {
    
                $abreviatura_subcategoria = $respuesta['info'][0]['abreviatura_subcategoria'];
                $abreviatura_categoria = $respuesta['info'][0]['abreviatura_categoria'];
                $fechas_array = explode(',', $respuesta['info'][0]['fechas1']);
                $nombre_subcategoria = mb_strtoupper($respuesta['info'][0]['nombre_subcategoria']);
                $nueva_fecha = [];
    
                foreach ($fechas_array as $fecha) {
                    $fecha_temp = strtotime($fecha);
                    $nueva_fecha [] = date("d/m/y", $fecha_temp);
                }
    
                $nuevo_formato = [
                    'fechas' => [],
                    'datos' => [],
                    'descripcion' => [],
                ];
    
                
                // Switch de desisiones según la abreviatura de las categorias, se aplican los distintos comportamientos de la respuesta
                switch ($abreviatura_categoria) {
                    case 'AMONE':
                    case 'AMONES':
                        if ($abreviatura_subcategoria === 'AMOMG') {
    
                            $fecha_temp = strtotime($respuesta['info'][0]['fechas2']);
                            $nuevo_formato = [
                                'datos' => $nombre_subcategoria ,
                                'fechas' => [
                                    'fecha_inicio'=>$nueva_fecha[0],
                                    'fecha_fin'   => date("d/m/y", $fecha_temp),
                                ] ,
                                'descripcion' => [
                                    'fecha_inicio' => 'Fecha de amonestación',
                                    'fecha_fin' => 'Fecha de suspensión',
                                ] ,
                            ];
    
                            break;
                        }
    
                        $nuevo_formato = [
                            'datos' => $nombre_subcategoria ,
                            'fechas' => [
                                'fecha_inicio'=>$nueva_fecha[0],
                            ] ,
                            'descripcion' => [
                                'fecha_inicio' => 'Fecha de amonestación',
                            ] ,
                        ];
                        
                        break;
                    case 'CONST':
                    case 'CONSTA':
                    case 'MODSAL':
                    case 'TERCON':
                        $nuevo_formato = [
                            'datos' => $nombre_subcategoria ,
                            'fechas' => [
                                'fecha_inicio'=> '',
                            ] ,
                            'descripcion' => [
                                'fecha_inicio' => 'No aplica fecha',
                            ] ,
                        ];
    
                        break;
                    case 'VACAC':
                        if ($abreviatura_subcategoria === 'VACAP') {
                            $nuevo_formato = [
                                'datos' => $nombre_subcategoria ,
                                'fechas' => [
                                    'fecha_inicio'=> $respuesta['info'][0]['cantidad_dias'],
                                ] ,
                                'descripcion' => [
                                    'fecha_inicio' => 'Cantidad de días',
                                ] ,
                            ];
                            break;
                        }
    
                        $nuevo_formato = [
                            'datos' => '',
                            'fechas' => $nueva_fecha,
                            'descripcion' => [] ,
                        ];
                        break;
                    case 'LICEN':
                    case 'LICENC':
    
                        if ($abreviatura_subcategoria === 'MACCSS') {
                            
                            $fechas_array = explode('|', $respuesta['info'][0]['fechas1']);
                            
                            $fechas_array = array_map(function($fecha) {
                                return date("d/m/y", strtotime($fecha));
                            }, $fechas_array);
    
                            if(count($fechas_array) == 2){
    
                                $rango_fechas = $fechas_array[0].' al '.$fechas_array[1];
                                $nuevo_formato = [
                                    'datos' => $nombre_subcategoria ,
                                    'fechas' => [
                                        'cantidad_dias'=> $respuesta['info'][0]['cantidad_dias'],
                                        'rango_fechas'=> $rango_fechas,
                                    ] ,
                                    'descripcion' => [
                                        'cantidad_dias' => 'Cantidad de días',
                                        'rango_fechas' => 'Fechas',
                                    ] ,
                                ];
                                break;
                            }
    
                            $nuevo_formato = [
                                'datos' => $nombre_subcategoria ,
                                'fechas' => [
                                    'cantidad_dias'=> $respuesta['info'][0]['cantidad_dias'],
                                ] ,
                                'descripcion' => [
                                    'cantidad_dias' => 'Cantidad de días',
                                ] ,
                            ];
                            
                            break;
                        }
    
                        $nuevo_formato = [
                            'datos' => '',
                            'fechas' => $nueva_fecha,
                            'descripcion' => [] ,
                        ];
                        break;
                    
                    default:
                    $nuevo_formato = [
                        'datos' => '',
                        'fechas' => $nueva_fecha ,
                        'descripcion' => [] ,
                    ];
                    
                    break;
                }
    
                $html = View::make('colaboradores.accionPersonal.modals.modal_consulta_dias', ['resultado' => $nuevo_formato])->render();
                return response()->json(['html' => $html]);
            }
        }else{
            $mensaje1 = 'Error: No se encontraron resultados ';
            $mensaje2 = 'Detalles: al realizar la busqueda no se encontraron resultados';
    
            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }
    }
    

}

