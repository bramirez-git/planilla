<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class ColaboradoresAmonestacionesController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        //Obtener datos generales
        $url = env("API_DIR")."getColaboradorAmonestaciones";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$id_colaborador.'"';

        //se guardan variables de busqueda
        $buscar = "";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = $request['buscar'];
            $parametros .= ',"buscar" : "'.$buscar.'"';
        }

        if(is_array($request['filtro'])){

            $filtro=$request['filtro'];

            if(!empty($filtro['tipos_empresa'])){
                $str_tipos_empresa = implode(',', $filtro['tipos_empresa']);
                $parametros.=',"tipos_empresa" : "'.$str_tipos_empresa.'"';
            }

            if(!empty($filtro['estado'])){
                $parametros.=',"estado" : "'.$filtro['estado'].'"';
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

        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            if($respuesta['codigo'] != "error_registro")
            {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }
            else
            {
                $resultadoColaborador= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoColaborador = collect(json_decode($datosDescargar));
            }
        }

        $url = env("API_DIR")."exportarExcelAmonestacionesColaborador";


        $result = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        //dd($conjuntoParametros);
        //si da respuesta de error
        if(isset($result['error']))
        {
            $mensaje1 = 'Error: '.$result['codigo'].' ';
            $mensaje2 = 'Detalles: '.$result['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        if ($result != null && isset($result['estado'])) {
            //si no dio error
            if($result['estado'] == 'ok')
            {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($result['info']);

                //lo convierte en colección
                $resultadoFinal= collect(json_decode( $datosDescargar));
                $resultadoExcel=$resultadoFinal[0];
            }
        }

        foreach($resultadoColaborador as &$data){
            $carbonFecha = Carbon::parse($data->fecha);
            $data->fecha = Carbon::parse($carbonFecha)->isoFormat('dddd DD [de] MMMM [del] YYYY');
        }

        $conjuntoResultados = [
            'id_colaborador' => $id_colaborador,
            'orden'=>$filtro['orden']??"",
            'tipo_orden'=>$filtro['tipo_orden']??"",
            'resultado' => $resultadoColaborador,
            'total'=>$respuesta['total_amonestaciones'],
            'total_paginas'=>$respuesta['total_paginas'],
            'cantidad'=> $cantidad,
            'paginaActual'=> $paginaActual,
            'resultadoExcel'=>$resultadoExcel??""
            ];

        return view('colaboradores.amonestaciones.colaboradoresAmonestaciones_index',$conjuntoResultados);
    }

    public function create(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        $conjuntoResultados = [
            'id_colaborador' => $id_colaborador
        ];
        return view('colaboradores.amonestaciones.colaboradoresAmonestaciones_create',$conjuntoResultados);
    }

    public function show(Request $request)
    {
//        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
//        $conjuntoResultados = [
//            'id_colaborador' => $id_colaborador
//        ];
        return view('colaboradores.amonestaciones.colaboradoresAmonestaciones_show');
    }

    public function store(Request $request){

        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        $url=env("API_DIR")."crearColaboradorAmonestacion";

        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>$request->session()->get('id_cliente'),
            'id_colaborador'=>intval($id_colaborador),
            'nombre'=>$request["nombre"],
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request["fecha"]))->format('Y-m-d'),
            'clasificacion'=>$request["clasificacion"],
            'tipo'=>$request["tipo"],
            'descripcion'=>$request["descripcion"],
            'documentos'=>''
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //dd($conjuntoParametros);
        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error']['id_colaborador'][0].' ';

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
        }

        return redirect()->back()->withSuccess("Se registró la amonestación con éxito!");
    }
}
