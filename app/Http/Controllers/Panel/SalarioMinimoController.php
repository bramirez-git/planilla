<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SalarioMinimoController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function edit(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getSalariosMinimos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        //se guardan variables de busqueda
        $buscar = "";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = $request['buscar'];
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
        if(!isset($request["cantidad"]))$parametros .= ',"cantidad" : "'.$cantidad.'"';
        if(isset($request["cantidad"]))
        {
            $parametros .= ',"cantidad" : "'.$request["cantidad"].'"';
            $cantidad = $request["cantidad"];
        }

        $parametros .= '}';

        //se consume el api
        $salarios_minimos= $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($salarios_minimos['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$salarios_minimos['codigo'],
                 'error' =>$salarios_minimos['codigo_error']]);
        }

        //si no dio error
        if($salarios_minimos['estado'] == 'ok')
        {
            $datosDescargar = json_encode($salarios_minimos['info']);

            $result_salario_minimo= collect(json_decode( $datosDescargar));
        }

        $url = env("API_DIR")."getClasificacionSalariosMinimos";
        $param_clasificacion='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"}';

        //se consume el api
        $clasificacion_salarios_minimos = $this->general->consultaApiMedianteBody($tipo,$url,$param_clasificacion);

        if(isset($clasificacion_salarios_minimos['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$clasificacion_salarios_minimos['codigo'],
                 'error' =>$clasificacion_salarios_minimos['codigo_error']]);
        }

        //si no dio error
        if($clasificacion_salarios_minimos['estado'] == 'ok')
        {
            $datosDescargar = json_encode($clasificacion_salarios_minimos['info']);

            $result_clasificacion_salario= collect(json_decode( $datosDescargar));
        }

        $url = env("API_DIR")."getSalarioMinimoBase";
        //se consume el api
        $salarios_minimos_base = $this->general->consultaApiMedianteBody($tipo,$url,$param_clasificacion);

        if(isset($salarios_minimos_base['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$salarios_minimos_base['codigo'],
                 'error' =>$salarios_minimos_base['codigo_error']]);
        }

        //si no dio error
        if($salarios_minimos_base['estado'] == 'ok')
        {
            $datosDescargar = json_encode($salarios_minimos_base['info']);

            $result_salario_base= collect(json_decode( $datosDescargar));
        }

        $conjuntoResultados = [
            'result_salario_minimo'=>$result_salario_minimo,
            'result_clasificacion_salario'=>$result_clasificacion_salario,
            'result_salario_base'=>$result_salario_base[0],
            'buscar'=>$buscar??"",
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'total'=>$salarios_minimos['total_registros'],
            'total_paginas'=>$salarios_minimos['total_paginas'],
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
        ];

        return view('panel.configuracion.salarioMinimo.salarioMinimo_edit',$conjuntoResultados);
    }

    public function update(Request $request)
    {
        $numero_string=[
            "salario_minimo"=>trim($request["salarioMinimo"])
        ];
        $array_numeros = array_map(function($numeroString) {
            $numeroFloat = (float) str_replace(',', '', $numeroString);
            return (float) number_format($numeroFloat, 2, '.', '');
        }, $numero_string);

        $url=env("API_DIR")."editarSalarioMinimoBase";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'salario_minimo'=> $array_numeros['salario_minimo']
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
            ->back()
            ->withSuccess("El salario mínimo actual fue modificado con éxito.");
    }
}
