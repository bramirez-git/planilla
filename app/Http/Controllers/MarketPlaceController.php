<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Seguridad\SecureValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MarketPlaceController extends Controller{

    private $general;

    public function __construct(){
        $this->general=new funcionesGenerales();
    }

    public function index(){
        $url=env("API_DIR")."getServiciosTiendaVirtual";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        //se guardan variables de busqueda
        $buscar="";

        if(isset($request['buscar']) && trim($request['buscar'])!=""){
            $buscar=$request['buscar'];
            $parametros.=',"buscar" : "'.$buscar.'"';
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

        }

        $conjuntoResultados=[
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar,
            'total'=>$respuesta['total_servicios'],
            'total_paginas'=>$respuesta['total_paginas'],
            'fecha1'=>$filtro['fecha_ingreso'] ?? "",
            'fecha2'=>$filtro['fecha_final'] ?? "",
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
        ];

        return view('marketPlace.marketPlace_index', $conjuntoResultados);
    }

    public function ui_contratar_servicios($id_servicio){

        $url=env("API_DIR")."infoServicioTiendaVirtual";

        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_servicio'=>trim($id_servicio)
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //si da respuesta de error
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
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));
            $resultado=$resultadoFinal[0];
        }

        $html=View::make('marketPlace.marketPlace_contratar',['resultado'=>$resultado])->render();

        return response()->json(['html'=>$html]);
    }

    public function ui_servicio_config($id_servicio,Request $request){
        $url=env("API_DIR")."infoServicioTiendaVirtual";

        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_servicio'=>trim($id_servicio)
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //si da respuesta de error
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
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));
            $resultado=$resultadoFinal[0];
        }

        $html=View::make('marketPlace.marketPlace_config',['resultado'=>$resultado])->render();

        return response()->json(['html'=>$html]);
    }

    public function edit($id_servicio,Request $request){
        //Editar colaborador en api
        $url=env("API_DIR")."contratarServicio";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>$request->session()->get('id_cliente'),
            'id_servicio'=>trim($id_servicio)
        ];


        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                    'mensaje1'=>$mensaje1,
                    'mensaje2'=>$mensaje2
                ]);
        }

        return redirect()->back()->withSuccess("Se contrató el servicio adicional con éxito!");

    }

    public function desactivar_servicio($id_servicio,Request $request){
        //Editar colaborador en api
        $url=env("API_DIR")."desactivarServicio";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>$request->session()->get('id_cliente'),
            'id_servicio'=>trim($id_servicio)
        ];


        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        return redirect()->back()->withSuccess("La baja se solicitó con éxito!");


    }
}
