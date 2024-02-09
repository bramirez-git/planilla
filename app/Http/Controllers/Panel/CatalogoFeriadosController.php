<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\configuracion\CatalogoFeriadoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CatalogoFeriadosController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getFeriados";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        //se guardan variables de busqueda
        $buscar = "";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = trim($request['buscar']);
            $parametros .= ',"buscar" : "'.$buscar.'"';
        }

        if(is_array($request['filtro'])){

            $filtro=$request['filtro'];

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
        $result_feriados = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($result_feriados['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$result_feriados['codigo'],
                 'error' =>$result_feriados['codigo_error']]);
        }

        //si no dio error
        if($result_feriados['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($result_feriados['info']);
            //$request->session()->put('excelDescargar', $datosDescargar);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

            foreach ($resultadoFinal as &$data) {
                Carbon::setLocale('es');
                if($data->fecha!=$data->fecha_traslado){
                    $data->fecha_traslado = Carbon::parse($data->fecha_traslado)->isoFormat('dddd DD [de] MMMM [del] YYYY');
                }else{
                    $data->fecha_traslado="-";
                }
                $data->fecha = Carbon::parse($data->fecha)->isoFormat('dddd DD [de] MMMM [del] YYYY');
            }
        }

        $conjuntoResultados = [
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar??"",
            'to_look_for'=>$filtro['buscar']??"",
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'total'=>$result_feriados['total_registros'],
            'total_paginas'=>$result_feriados['total_paginas'],
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
            'resultadoExcel'=>$resultadoExcel??""
        ];

        return view('panel.configuracion.catalogoFeriados.catalogoFeriados_index',$conjuntoResultados);
    }

    public function create()
    {
        return view('panel.configuracion.catalogoFeriados.catalogoFeriados_create');
    }

    public function store(CatalogoFeriadoRequest $request)
    {
        //Validar
        $request->validated();

        //Crear feriado en api
        $url=env("API_DIR")."crearFeriado";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'nombre'=>trim($request["celebracion"]),
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaFeriado']))->format('Y-m-d'),
            'fecha_traslado'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaTraslado']))->format('Y-m-d'),
            'pago_obligatorio'=>trim($request["pagoObligatorio"])
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

        if($respuesta['estado']==="ok"){
            return redirect()->route('configuracionCatalogoFeriados.index')->withSuccess("La celebración de {$respuesta['info']['nombre']} fue registrado con éxito!");
        }
    }

    public function edit(Request $request,$id_feriado)
    {
        $id_feriado=Crypt::decrypt($id_feriado);

        //variables a usar en el api
        $url=env("API_DIR")."getFeriado";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_feriado'=>$id_feriado
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

        }

        $conjuntoResultados=[
            'resultado'=>$resultadoFinal[0]
        ];
        return view('panel.configuracion.catalogoFeriados.catalogoFeriados_edit',$conjuntoResultados);
    }

    public function update(Request $request,$id_feriado)
    {
        $id_feriado=Crypt::decrypt($id_feriado);

        //Modificar feriado en api
        $url=env("API_DIR")."editarFeriado";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_feriado'=>$id_feriado,
            'nombre'=>trim($request["celebracion"]),
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaFeriado']))->format('Y-m-d'),
            'fecha_traslado'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaTraslado']))->format('Y-m-d'),
            'pago_obligatorio'=>trim($request["pagoObligatorio"])
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
        return redirect()
            ->route('configuracionCatalogoFeriados.index')
            ->withSuccess("La celebración de {$respuesta['info']['nombre']} fue modificada con éxito!");
    }

    public function destroy($id_feriado)
    {
        $id_feriado=Crypt::decrypt($id_feriado);

        //Eliminar feriado en api
        $url=env("API_DIR")."eliminarFeriado";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_feriado'=>$id_feriado
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
        return redirect()
            ->route('configuracionCatalogoFeriados.index')
            ->withSuccess("La celebración de {$respuesta['info'][0]['nombre']} fue eliminado con éxito!");
    }
}
