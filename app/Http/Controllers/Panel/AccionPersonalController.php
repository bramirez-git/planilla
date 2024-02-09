<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

class AccionPersonalController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getCategoriasAccionPersonalMaestro";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        //se guardan variables de busqueda
        $buscar = "";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = trim($request['buscar']);
            $parametros .= ',"buscar" : "'.$buscar.'"';
        }

//        if(is_array($request['filtro'])){
//
//            $filtro=$request['filtro'];
//
//            if(!empty($filtro['orden'])){
//                $parametros.=',"orden" : "'.$filtro['orden'].'"';
//            }
//
//            if(!empty($filtro['tipo_orden'])){
//                $parametros.=',"tipo_orden" : "'.$filtro['tipo_orden'].'"';
//            }
//
//        }

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
        $result_personal = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($result_personal['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$result_personal['codigo'],
                 'error' =>$result_personal['codigo_error']]);
        }

        //si no dio error
        if($result_personal['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($result_personal['info']);
            //$request->session()->put('excelDescargar', $datosDescargar);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }

        $conjuntoResultados = [
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar??"",
            'to_look_for'=>$filtro['buscar']??"",
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'total'=>$result_personal['total_registros']??"",
            'total_paginas'=>$result_personal['total_paginas']??"",
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
            'resultadoExcel'=>$resultadoExcel??""
        ];
        return view('panel.configuracion.accionPersonal.accionPersonal_index',$conjuntoResultados);
    }

    public function store()
    {
        return redirect()
            ->back()
            ->withSuccess("La acción de personal fue agregada con éxito.");
    }

    public function update(Request $request)
    {
//        //Validar
//        $request->validated();


        //si recibe el archivo

        if(is_array($request['frm_subcategoria'])){

            $subcategorias=$request['frm_subcategoria'];

            foreach ($subcategorias as &$subcategoria)
            {
                if(!isset($subcategoria['porcentaje1'])){
                    $subcategoria['porcentaje1']=0;
                }

                if(!isset($subcategoria['porcentaje2'])){
                    $subcategoria['porcentaje2']=0;
                }

            }
            // Convertir los datos transformados a JSON
            $subcategorias = json_encode($subcategorias);
            //variables a usar en el api
            $url = env("API_DIR")."editarSubCategoriasAccionPersonalMaestro";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'info' => $subcategorias
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            if(isset($respuesta['error']))
            {
                return view('errores.error_api',
                    ['detalles' =>$respuesta['codigo'],
                     'error' =>$respuesta['codigo_error']]);
            }

            //si no dio error
            if(isset($respuesta['estado']))
            {
                if($respuesta['estado'] == 'ok')
                {
                    return redirect()->back()->withSuccess("Los porcentajes han sido modificados éxito.");
                }
            }

        }

        return redirect()->back()->with([
            'alert_info' => [
                "No se requiere modificar porcentajes en este momento.",
            ]
        ]);

    }

    public function edit(Request $request,$id_categoria)
    {

        $id_categoria=Crypt::decrypt($id_categoria);

        //variables a usar en el api
        $url = env("API_DIR")."getSubCategoriasAccionPersonalMaestro";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        //se guardan variables de busqueda
        $buscar = "";

        if($id_categoria)
        {
            $parametros .= ',"id_categoria" : "'.$id_categoria.'"';
        }

        $parametros .= '}';

        //se consume el api
        $result = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($result['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$result['codigo'],
                 'error' =>$result['codigo_error']]);
        }

        //si no dio error
        if($result['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($result['info']);
            //$request->session()->put('excelDescargar', $datosDescargar);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
            // Función de comparación para sortBy
            function compararPorcentajes($a, $b) {
                // Calcula los totales de porcentajes para cada elemento
                $totalA = $a->porcentaje1 + $a->porcentaje2;
                $totalB = $b->porcentaje1 + $b->porcentaje2;

                // Compara los totales de porcentajes
                return $totalB <=> $totalA;
            }

            // Ordena la colección utilizando el método sortBy con la función de comparación
            $resultadoFinal = $resultadoFinal->sortBy('pedir_porcentaje2')->sortBy('pedir_porcentaje1')->sortBy('porcentaje2')->sortBy('porcentaje1')->sortBy('tipo_fecha')->sortBy('id_categoria')->sortByDesc('id_subcategoria')->toArray();

            // Convertir el objeto en un array asociativo
            $arrayAsociativo = (array) $resultadoFinal;

            // Darle vuelta a los datos utilizando array_reverse
            $arrayRevertido = array_reverse($arrayAsociativo, true);

            $existe_porcentaje = false;

            foreach ($arrayRevertido as $elemento) {
                if ($elemento->pedir_porcentaje1 === "si" || $elemento->pedir_porcentaje2 === "si") {
                    $existe_porcentaje = true;
                    break; // Terminar el bucle una vez que se encuentra el elemento
                }
            }
            // Convertir el array de nuevo en un objeto
            $resultadoFinal = (object) $arrayRevertido;
            // I
        }

        $conjuntoResultados = [
            'resultado'=>$resultadoFinal,
            'existe_porcentaje'=>$existe_porcentaje,
        ];

        return view('panel.configuracion.accionPersonal.accionPersonal_edit',$conjuntoResultados);
    }


    public function destroy($id)
    {
        return redirect()
            ->back()
            ->withSuccess("La acción de personal fue eliminada con éxito!");
    }

    public function updateCategoria(Request $request){

        $categoria = $request['frm_categoria'];

        $id_categoria=Crypt::decrypt($categoria['id_categoria']);

        if(empty($id_categoria)){
            return redirect()->back()->with('ui_alert',[
                'tipo'=>'warning',
                'mensaje'=>'El campo nombre es requerido.',
            ]);
        }

        if(empty($categoria['nombre'])){
            return redirect()->back()->with('ui_alert',[
                'tipo'=>'warning',
                'mensaje'=>'El campo nombre es requerido.',
            ]);
        }

        //variables a usar en el api
        $url=env("API_DIR")."editarCategoriaAccionPersonalMaestro";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_categoria'=>$id_categoria,
            'nombre'=>trim($categoria['nombre']),
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        if(isset($respuesta['error'])){
            return view('errores.error_api', [
                    'detalles'=>$respuesta['codigo'],
                    'error'=>$respuesta['codigo_error']
                ]);
        }

        //si no dio error
        if(isset($respuesta['estado'])){
            if($respuesta['estado']=='ok'){
                return redirect()->back()->withSuccess("La categoría {$respuesta['info']['nombre']} han sido modificada éxito.");
            }
        }

    }

}
