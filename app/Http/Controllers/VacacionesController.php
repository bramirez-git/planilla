<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Seguridad\SecureValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

class VacacionesController extends Controller{
    private $general;

    public function __construct(){
        $this->general=new funcionesGenerales();
    }

    public function index(Request $request){
        $buscar="";

        if(isset($request['buscar']) && trim($request['buscar'])!=""){
            $buscar=$request['buscar'];
        }

        $paginaActual=1;
        if(isset($request["pagina"])){
            $paginaActual=$request["pagina"];
        }

        $cantidad=50;
        if(isset($request["cantidad"])){
            $cantidad=$request["cantidad"];
        }

        $conjuntoResultados=[
            'buscar'=>$buscar,
            'orden'=>$filtro['orden'] ?? "",
            'total'=>1,
            'total_paginas'=>1,
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
            //            'resultadoExcel'=>$resultadoExcel
        ];
        return view('recursosHumanos.vacaciones.vacaciones_index', $conjuntoResultados);
    }

    public function ui_calendario_vacaciones(){


        $html = View::make('recursosHumanos.vacaciones.vacaciones_calendario')->render();

        return response()->json(['html' => $html]);

    }


    public function ui_motivo_vacaciones(){

        $html = View::make('recursosHumanos.vacaciones.vacaciones_motivo')->render();

        return response()->json(['html' => $html]);
    }

    public function tab_reporte_vacaciones(Request $request)
    {
        session()->now('fullCalendar','1');
        //variables a usar en el api
        $url=env("API_DIR")."getNoticiasEmpresa";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        //se guardan variables de busqueda
        $buscar="";

        if(isset($request['buscar']) && trim($request['buscar'])!=""){
            $buscar=$request['buscar'];
            $parametros.=',"buscar" : "'.$buscar.'"';
        }

        if(is_array($request['filtro'])){

            $filtro=$request['filtro'];

            if(!empty($filtro['estado'])){

                if ($filtro['estado'][0] !== "0") {
                    $parametros.=',"filtro_estado": "'.implode(',', $filtro['estado']).'"';
                }
                if ($filtro['estado'][0] === "0") {
                    $array=[
                        'publicado',
                        'borrador'
                    ];
                    $parametros.=',"filtro_estado": "'.implode(',', $array).'"';
                }
            }

            if(!empty($filtro['fecha_ingreso']) && !empty($filtro['fecha_final'])){
                $filtro['fecha_ingreso'] = Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_ingreso']))->format('Y-m-d');
                $filtro['fecha_final'] = Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_final']))->format('Y-m-d');

                $parametros.=',"filtro_fecha1" : "'.$filtro['fecha_ingreso'].'"';
                $parametros.=',"filtro_fecha2" : "'.$filtro['fecha_final'].'"';

                $filtro['fecha_ingreso'] = Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_ingreso']))->format('d/m/Y');
                $filtro['fecha_final'] = Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_final']))->format('d/m/Y');
            }

        }else{
            $parametros.=',"filtro_estado": "'.'publicado'.'"';
        }

        $paginaActual=1;
        if(isset($request["pagina"])){
            $parametros.=',"pagina" : "'.$request["pagina"].'"';
            $paginaActual=$request["pagina"];
        }

        $cantidad=50;
        if(isset($request["cantidad"])){
            $parametros.=',"cantidad" : "'.$request["cantidad"].'"';
            $cantidad=$request["cantidad"];
        }

        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            return view('errores.error_api', [
                'detalles'=>$respuesta['codigo'],
                'error'=>$respuesta['codigo_error']
            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));

        }

        foreach($resultadoFinal as $data){
            $data->descripcion = SecureValue::decode(trim($data->descripcion), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        }
        $conjuntoResultados=[
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar,
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'estado'=>$filtro['estado'][0] ?? "",
            'total'=>$respuesta['total_noticias'],
            'total_paginas'=>$respuesta['total_paginas'],
            'fecha1'=>$filtro['fecha_ingreso'] ?? "",
            'fecha2'=>$filtro['fecha_final'] ?? "",
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
            //            'resultadoExcel'=>$resultadoExcel
        ];
        if(isset($_REQUEST['success']) && isset($_REQUEST['message'])){
            return redirect()->route('noticias.index')->withSuccess($_REQUEST['message']);
        }

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('recursosHumanos.vacaciones.vacaciones_list_index',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }







}
