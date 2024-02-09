<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\configuracion\EntidadesFinancierasRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EntidadesFinancierasController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function edit(Request $request)
    {
        //variables a usar en el api
        $url=env("API_DIR")."getBancos";
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
        if(isset($request["cantidad"]))
        {
            $parametros .= ',"cantidad" : "'.$request["cantidad"].'"';
            $cantidad = $request["cantidad"];
        }

        $parametros .= '}';

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($catalogoOcupaciones['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$catalogoOcupaciones['codigo'],
                 'error' =>$catalogoOcupaciones['codigo_error']]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($respuesta['info']);
            //$request->session()->put('excelDescargar', $datosDescargar);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }

        $conjuntoResultados = [
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar,
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'total'=>$respuesta['total_bancos'],
            'total_paginas'=>$respuesta['total_paginas'],
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual
        ];

        return view('panel.configuracion.catalogoEntidadesFinancieras.catalogoEntidadesFinancieras_edit',$conjuntoResultados);
    }

    public function store(EntidadesFinancierasRequest $request){
        //Validar
        $request->validated();

        //Crear noticias en api
        $url=env("API_DIR")."crearBanco";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'nombre'=>$request["nombre_banco"],
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
        //si no da error redirige a la lista de noticias con mensaje de éxito

        return redirect()->back()->withSuccess("El banco con el nombre {$respuesta['info']['nombre']} fue agregado con éxito.");

    }

    public function update(EntidadesFinancierasRequest $request,$id_banco)
    {
        $id_banco=Crypt::decrypt($id_banco);

        //Validar
        $request->validated();

        //Crear noticias en api
        $url=env("API_DIR")."editarBanco";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_banco'=>$id_banco,
            'nombre'=>$request["nombre_banco"],
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


        //si no da error redirige a la lista de noticias con mensaje de éxito
        return redirect()->back()->withSuccess("El banco con el nombre {$respuesta['info']['nombre']} fue modificado con éxito.");


    }

    public function destroy($id_banco){

        $id_banco=Crypt::decrypt($id_banco);


        //Crear banco en api
        $url=env("API_DIR")."eliminarBanco";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_banco'=>$id_banco,
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

            return redirect()->back()->withSuccess("El banco con el nombre {$respuesta['info'][0]['nombre']} fue eliminado con éxito!");
        }
}
