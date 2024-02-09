<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    private $general;

    public function __construct(){
        $this->general=new funcionesGenerales();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->now('graficos','1');

        $url=env("API_DIR")."estadisticaPeriodosEmpresa";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

//            return redirect()->back()->withInput(request()->all())->withErrors([
//                'mensaje1'=>$mensaje1,
//                'mensaje2'=>$mensaje2
//            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));
            $arrayDatos = explode(",", $resultadoFinal[0]);

        }

        return view('inicio', ['filtro_data'=>$arrayDatos]);
    }

     public function calculadora()
    {

        return view('calculadora');
    }

     public function chequeo()
    {

        return view('chequeo');
    }

    public function cargar_graficos()
    {
            $jason=[];
            $json['success']=1;
        return response()->json(['success' => 1]);
    }

    public function grafico_planilla_mensual(Request $request)
    {

        if ($request['fecha'] === null) {
            $request['fecha'] = date("Y");
        }

        $url=env("API_DIR")."estadisticaPagosPlanillaEmpresa";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        $parametros.=',"anio" : "'.$request['fecha'].'"';
        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){

            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));

            return response()->json([
                'success' => 1,
                'resultado'=>$resultadoFinal,
            ]);

        }

        return response()->json([
            'success' => 0,
        ]);
    }

    public function grafico_planilla_mensual_colaboradores(Request $request)
    {

        if ($request['fecha'] === null) {
            $request['fecha'] = date("Y");
        }

        $url=env("API_DIR")."estadisticaTotalColaboradoresMensual";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        $parametros.=',"anio" : "'.$request['fecha'].'"';
        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){

            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));

            return response()->json([
                'success' => 1,
                'resultado'=>$resultadoFinal,
            ]);

        }

        return response()->json([
            'success' => 0,
        ]);
    }

    public function grafico_planilla_mensual_aguinaldos(Request $request)
    {

        if ($request['fecha'] === null) {
            $request['fecha'] = date("Y");
        }

        $url=env("API_DIR")."estadisticaAguinaldosEmpresa";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        $parametros.=',"anio" : "'.$request['fecha'].'"';
        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){

            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));

            return response()->json([
                'success' => 1,
                'resultado'=>$resultadoFinal,
            ]);

        }

        return response()->json([
            'success' => 0,
        ]);
    }

    public function grafico_ocupaciones()
    {
        $url=env("API_DIR")."estadisticaOcupacionesCCSS";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));

            return response()->json([
                'success' => 1,
                'resultado'=>$resultadoFinal
            ]);

        }

        return response()->json([
            'success' => 0,
        ]);
    }

    public function grafico_ocupaciones_INS()
    {
        $url=env("API_DIR")."estadisticaOcupacionesINS";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));

            return response()->json([
                'success' => 1,
                'resultado'=>$resultadoFinal
            ]);

        }

        return response()->json([
            'success' => 0,
        ]);
    }

}
