<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CalendarioController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        session()->now('fullCalendar','1');

        //Obtiene todos los catalogos
        $accionesPersonal = $this->general->obtenerCatalogo("getCategoriasAccionPersonalEmpresa", $request->session()->get('id_cliente'));

        //variables a usar en el api
        $url = env("API_DIR")."getColaboradores";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","pagina":"-1"}';

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoColaboradores= collect(json_decode( $datosDescargar));
        }


        $conjuntoResultados = [
            'accionesPersonal' => $accionesPersonal,
            'colaboradores' => $resultadoColaboradores];

        return view('recursosHumanos.calendario.calendario_index',$conjuntoResultados);
    }

    public function fullCalendar(Request $request)
    {
        if ($request->ajax())
        {
            //De la fecha de inicio y la fecha final, tomamos el mes y año actual.
            $fechaComoEntero = strtotime($request['inicio']);
            $dia = date("d", $fechaComoEntero);
            $mes = date("m", $fechaComoEntero);
            $anio = date("Y", $fechaComoEntero);

            if($dia>1)
            {
                if($mes==12)
                {
                    $mes=1;
                    $anio += 1;
                }
                else {
                    $mes += 1;
                    if ($mes < 10) {
                        $mes = "0" . $mes;
                    }
                }
            }

            //Tomamos los datos del ws
            $url = env("API_DIR")."getCalendarioAccionesPersonal";
            $conjuntoParametros = [
                'id_empresa' => $request->session()->get('id_cliente'),
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'mes' => $mes.'',
                'anio' => $anio.''
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //si da respuesta de error
            if (isset($respuesta['error'])) {
                exit;
            }
            else {
                //si no dio error
                if ($respuesta['estado'] == 'ok') {
                    //se guarda en caso que se quiera descargar el excel
                    $datosDescargar = json_encode($respuesta['info']);

                    //lo convierte en colección
                    $resultadoCalendario = collect(json_decode($datosDescargar));
                    $feriados = $resultadoCalendario['feriados'];
                    $acciones_personal = $resultadoCalendario['acciones_personal'];
                    $cumpleanios = $resultadoCalendario['cumpleanios'];
                }
            }

            //se acomodan las fechas por colaborador en acciones de personal
            $accionesPersonalFechas=[];
            foreach($acciones_personal as $accion_personal)
            {
                $fechasAccion=[];
                if ($accion_personal->tipo_fecha == "fechas") {
                    $fechasOrdenar = explode(",", $accion_personal->fechas);
                    $fechasOrdenar = $this->general->ordena_array_fecha($fechasOrdenar);
                    $fechasAccion = $this->general->indica_fechas_seguidas($fechasOrdenar);
                    array_push($accionesPersonalFechas,[
                        "id_accion_personal"=>$accion_personal->id_accion_personal,
                        "id_colaborador"=>$accion_personal->id_colaborador,
                        "primer_nombre"=>$accion_personal->primer_nombre,
                        "segundo_nombre"=>$accion_personal->segundo_nombre,
                        "primer_apellido"=>$accion_personal->primer_apellido,
                        "segundo_apellido"=>$accion_personal->segundo_apellido,
                        "nombre_categoria"=>$accion_personal->nombre_categoria,
                        "abreviatura_categoria"=>$accion_personal->abreviatura_categoria,
                        "tipo_fecha"=>$accion_personal->tipo_fecha,
                        "nombre_subcategoria"=>$accion_personal->nombre_subcategoria,
                        "fechasAccion"=>$fechasAccion]);
                }
                else
                {
                    array_push($accionesPersonalFechas,[
                        "id_accion_personal"=>$accion_personal->id_accion_personal,
                        "id_colaborador"=>$accion_personal->id_colaborador,
                        "primer_nombre"=>$accion_personal->primer_nombre,
                        "segundo_nombre"=>$accion_personal->segundo_nombre,
                        "primer_apellido"=>$accion_personal->primer_apellido,
                        "segundo_apellido"=>$accion_personal->segundo_apellido,
                        "nombre_categoria"=>$accion_personal->nombre_categoria,
                        "abreviatura_categoria"=>$accion_personal->abreviatura_categoria,
                        "tipo_fecha"=>$accion_personal->tipo_fecha,
                        "nombre_subcategoria"=>$accion_personal->nombre_subcategoria,
                        "fechasAccion"=>$accion_personal->fechas]);
                }
            }

            //Se devuelven los push para el calendario
            $data = [];
            if(isset($feriados))
            {
                foreach($feriados as $feriado)
                {
                    array_push($data,[
                        'id'=> '1-'.Crypt::encrypt(date_format(date_create($feriado->fecha_feriado),"Y-m-d")),
                        'title'=>''.$feriado->nombre.'',
                        'start'=>''.date_format(date_create($feriado->fecha_feriado),"Y-m-d").'',
                        'end'=>'',
                        'allDay'=> 'true',
                        'className'=> 'bgc-pink-d2 text-white text-95']);
                }
            }

            if(isset($cumpleanios))
            {
                foreach($cumpleanios as $cumpleanio)
                {
                    $fecha_nacimiento= strtotime($cumpleanio->fecha_nacimiento);
                    $dia_cumple = $anio.'-'.date("m", $fecha_nacimiento).'-'.date("d", $fecha_nacimiento);
                    array_push($data,[
                        'id'=> '3-'.Crypt::encrypt($cumpleanio->id_colaborador),
                        'title'=>'Cumpleaños '.$cumpleanio->primer_nombre.' '.$cumpleanio->primer_apellido.' '.$cumpleanio->segundo_apellido,
                        'start'=> ''.$dia_cumple,
                        'end'=>'',
                        'allDay'=> 'true',
                        'className'=> 'bgc-purple-d2 text-white text-95']);
                }
            }

            if(isset($accionesPersonalFechas)) {
                foreach ($accionesPersonalFechas as $accionPersonalFechas) {
                    if ($accionPersonalFechas['abreviatura_categoria'] == "INCAP") {
                        $color = "orange";
                    } elseif ($accionPersonalFechas['abreviatura_categoria'] == "LICEN") {
                        $color = "yellow";
                    } elseif ($accionPersonalFechas['abreviatura_categoria'] == "PERMI") {
                        $color = "green";
                    } elseif ($accionPersonalFechas['abreviatura_categoria'] == "AUSEN") {
                        $color = "red";
                    }

                    if ($accionPersonalFechas['tipo_fecha'] == "rango") {
                        $rangoFechas = explode("|", $accionPersonalFechas['fechasAccion']);

                        array_push($data,[
                            'id'=> '2-'.Crypt::encrypt($accionPersonalFechas['id_accion_personal'].'-'.$accionPersonalFechas['id_colaborador']),
                            'title'=>''.$accionPersonalFechas['primer_nombre'].' - '.$accionPersonalFechas['nombre_categoria'].'',
                            'start'=>''.date_format(date_create($rangoFechas[0]),"Y-m-d").'',
                            'end'=>''.date("Y-m-d",strtotime(date($rangoFechas[1])."+ 1 day")).'',
                            'allDay'=> 'true',
                            'className'=> 'bgc-'.$color.'-d2 text-white text-95']);
                    }
                    else
                    {
                        foreach ($accionPersonalFechas["fechasAccion"] as $fechas)
                        {
                            $rangoFechas = explode("|", $fechas["fecha"]);

                            if (count($rangoFechas) > 1) {
                                array_push($data, [
                                    'id'=>'2-'.Crypt::encrypt($accionPersonalFechas['id_accion_personal'].'-'.$accionPersonalFechas['id_colaborador']),
                                    'title' => '' . $accionPersonalFechas['primer_nombre'] . ' - ' . $accionPersonalFechas['nombre_categoria'] . '',
                                    'start' => '' . date_format(date_create($rangoFechas[0]), "Y-m-d") . '',
                                    'end' => '' . date("Y-m-d", strtotime(date($rangoFechas[1]) . "+ 1 day")) . '',
                                    'allDay' => 'true',
                                    'className' => 'bgc-'.$color.'-d2 text-white text-95']);
                            }
                            else{
                                array_push($data, [
                                    'id'=> '2-'.Crypt::encrypt($accionPersonalFechas['id_accion_personal'].'-'.$accionPersonalFechas['id_colaborador']),
                                    'title' => '' . $accionPersonalFechas['primer_nombre'] . ' - ' . $accionPersonalFechas['nombre_categoria'] . '',
                                    'start' => '' . date_format(date_create($rangoFechas[0]), "Y-m-d") . '',
                                    'end' => '',
                                    'allDay' => 'true',
                                    'className' => 'bgc-'.$color.'-d2 text-white text-95']);

                            }
                        }
                    }
                }
            }

            return response()->json($data);
        }
    }

}
