<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Requests\DepartamentoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DepartamentosController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getDepartamentos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"';

        //se guardan variables de busqueda
        $buscar = "";

        if(isset($request['buscar']) && trim($request['buscar']) != "")
        {
            $buscar = $request['buscar'];
            $parametros .= ',"buscar" : "'.$buscar.'"';
        }

        //se guardan variables de orden
        $orden = "";
        $tipo_orden = "";

        if(isset($request['orden']) && trim($request['orden']) != "")
        {
            $orden = $request['orden'];
            $tipo_orden = $request['tipo_orden'];
            $parametros .= ',"orden" : "'.$orden.'"';
            $parametros .= ',"tipo_orden" : "'.$tipo_orden.'"';
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

        if(isset($respuesta['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$respuesta['codigo'],
                    'error' =>$respuesta['codigo_error'] ]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

        }

        $conjuntoResultados = ['resultado' => $resultadoFinal,
            'buscar'=>$buscar,
            'orden'=>$orden,
            'tipo_orden'=>$tipo_orden,
            'total'=>$respuesta['total_departamentos'],
            'total_paginas'=>$respuesta['total_paginas'],
            'cantidad'=> $cantidad,
            'paginaActual'=> $paginaActual,
        ];


        return view('recursosHumanos.departamentos.departamentos_index',$conjuntoResultados);
    }

    public function create()
    {
        return view('recursosHumanos.departamentos.departamentos_create');
    }

    public function store(DepartamentoRequest $request)
    {
        //Validar
        $request->validated();

        //Crear colaborador en api
        $url = env("API_DIR")."crearDepartamento";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'codigo' => trim($request["codigoDepartamento"]),
            'nombre' => trim($request['nombreDepartamento']),
            'descripcion' => trim($request['descripcionDepartamento']),
            'estado' => trim($request['estadoDepartamento'])
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        return redirect()
            ->route('departamentos.index')
            ->withSuccess("El departamento fue registrado.");
    }

    public function edit(Request $request,$idDepartamento)
    {
        $idDepartamento=Crypt::decrypt($idDepartamento);
        //variables a usar en el api
        $url = env("API_DIR")."getDepartamento";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_departamento' => $idDepartamento
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

        }

        $conjuntoResultados = [
            'id_departamento' => $idDepartamento,
            'resultado' => $resultadoFinal[0]
        ];

        //dd($conjuntoResultados);
        return view('recursosHumanos.departamentos.departamentos_edit',$conjuntoResultados);
    }

    public function update($idDepartamento,Request $request)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."editarDepartamento";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_departamento' => $idDepartamento,
            'codigo' => trim($request["codigoDepartamento"]),
            'nombre' => trim($request['nombreDepartamento']),
            'descripcion' => trim($request['descripcionDepartamento']),
            'estado' => trim($request['estadoDepartamento'])
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        return redirect()
            ->route('departamentos.index')
            ->withSuccess("El departamento fue modificado.");

    }

    public function destroy($idDepartamento ,Request $request)
    {
        //Editar colaborador en api
        $url = env("API_DIR")."eliminarDepartamento";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_departamento' => trim($idDepartamento)
        ];


        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        return redirect()
            ->route('departamentos.index')
            ->withSuccess("El departamento con el id {$idDepartamento} fue eliminado.");
    }

    public function descargar_excel(Request $request){
        //Genera datos de excel
        $url = env("API_DIR")."exportarExcelDepartamentos";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'buscar' => $request['buscar'],
            'orden' => $request['orden'],
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
}
