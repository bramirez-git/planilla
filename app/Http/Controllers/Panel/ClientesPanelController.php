<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Seguridad\SecureValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Funciones\Generales\funcionesGenerales;
use App\Http\Requests\ColaboradoresRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
class ClientesPanelController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getEmpresas";
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

            if(!empty($filtro['tipos_empresa'])){
                $str_tipos_empresa = implode(',', $filtro['tipos_empresa']);
                $parametros.=',"tipos_empresa" : "'.$str_tipos_empresa.'"';
            }

            if(!empty($filtro['estado'])){
                $parametros.=',"estado" : "'.$filtro['estado'].'"';
            }

            if(!empty($filtro['telefono'])){
                $parametros.=',"telefono" : "'.$filtro['telefono'].'"';
            }

            if(!empty($filtro['correo_empresa'])){
                $parametros.=',"correo_empresa" : "'.$filtro['correo_empresa'].'"';
            }

            if(!empty($filtro['correo_contacto'])){
                $parametros.=',"correo_contacto" : "'.$filtro['correo_contacto'].'"';
            }

            if(!empty($filtro['fecha_ingreso']) && !empty($filtro['fecha_final'])){
                $filtro['fecha_ingreso'] = Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_ingreso']))->format('Y-m-d');
                $filtro['fecha_final'] = Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_final']))->format('Y-m-d');

                $parametros.=',"fecha1" : "'.$filtro['fecha_ingreso'].'"';
                $parametros.=',"fecha2" : "'.$filtro['fecha_final'].'"';

                $filtro['fecha_ingreso'] = Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_ingreso']))->format('d/m/Y');
                $filtro['fecha_final'] = Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_final']))->format('d/m/Y');
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

        $tipos_empresa= $this->general->obtenerTiposEmpresa();

        $conjuntoResultados = ['resultado' => $resultadoFinal,
                               'result_tipo_empresa' => $tipos_empresa,
                               'buscar'=>$buscar,
                               'tipos_empresa'=>$filtro['tipos_empresa']??[],
                               'telefono'=>$filtro['telefono']??"",
                               'correo_empresa'=>$filtro['correo_empresa']??"",
                               'correo_contacto'=>$filtro['correo_contacto']??"",
                               'fecha1'=>$filtro['fecha_ingreso']??"",
                               'fecha2'=>$filtro['fecha_final']??"",
                               'estado'=>$filtro['estado']??"",
                               'total'=>$respuesta['total_empresas'],
                               'total_paginas'=>$respuesta['total_paginas'],
                               'cantidad'=> $cantidad,
                               'paginaActual'=> $paginaActual,
                            ];


        return view('panel.clientes.clientes_index',$conjuntoResultados);
    }

    public function show(Request $request,$id_empresa)
    {
        $id_empresa=Crypt::decrypt($id_empresa);
        //Obtiene todos los catalogos

        $tiposIdentificacion = $this->general->obtenerCatalogo("getTiposIdentificacion");

        //variables a usar en el api
        $url = env("API_DIR")."getEmpresa";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $id_empresa
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

        $provincias= $this->general->obtenerUbicacion("getUbicacion","provincias");
        $cantones= $this->general->obtenerUbicacion("getUbicacion","cantones",$resultadoFinal[0]->id_provincia);
        $distritos= $this->general->obtenerUbicacion("getUbicacion","distritos",$resultadoFinal[0]->id_provincia,$resultadoFinal[0]->id_canton);
        $barrios= $this->general->obtenerUbicacion("getUbicacion","barrios",$resultadoFinal[0]->id_provincia,$resultadoFinal[0]->id_canton,$resultadoFinal[0]->id_distrito);

        $conjuntoResultados = [
            'tiposIdentificaciones' => $tiposIdentificacion,
            'provincias' => $provincias,
            'cantones' => $cantones,
            'distritos' => $distritos,
            'barrios' => $barrios,
            'resultado' => $resultadoFinal[0]
        ];

        return view('panel.clientes.clientes_show',$conjuntoResultados);
    }

    public function update(Request $request,$id_empresa)
    {
        $id_empresa=Crypt::decrypt($id_empresa);
        //Obtiene todos los catalogos

        //variables a usar en el api
        $url = env("API_DIR")."cambiarEstadoEmpresa";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $id_empresa,
            'estado' => $request["estado"]
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        $url = env("API_DIR")."getEmpresa";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $id_empresa
        ];

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
            $text_msj=$respuesta['info'][0]['estado']=='activo'?"activado":"desactivado";
            return redirect()
                ->route('clientes.index')
                ->withSuccess("El cliente con el nombre {$respuesta['info'][0]['nombre']} fue {$text_msj} con éxito!");
        }
    }

    public function destroy($idColaborador)
    {
        return redirect()
            ->route('clientes.index')
            ->withSuccess("El cliente con el id {$idColaborador} fue eliminado con éxito!");
    }

    public function activarCuenta(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."reenviarCorreoAccesosUsuario";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        if(is_array($request['data'])){

            $data=$request['data'];

            if(!empty($data['correo'])){
                $parametros.=',"correo" : "'.SecureValue::encode(trim($data['correo']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true).'"';
            }

        }

        $parametros .= '}';

        //se consume el api
        $result = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($result['error']))
        {
            $mensaje1 = 'Error: '.$result['codigo'].' ';
            $mensaje2 = 'Detalles: '.$result['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($result['estado'] == 'ok')
        {
            $datosDescargar = json_encode($result['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));



        }

        return redirect()
            ->route('clientes.index')
            ->withSuccess("La notificación de activación fue envida con éxito!");

    }

    public function descargar_excel(Request $request){
        //Genera datos de excel
        // dd($request);
        $url = env("API_DIR")."exportarExcelEmpresas";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'buscar' => isset($request['buscar']) ? $request['buscar'] : '',
            'tipos_empresa' => isset($request['tipos_empresa']) ? $request['tipos_empresa'] : '',
            'estado' => isset($request['estado']) ? $request['estado'] : '',
            'telefono' => isset($request['telefono']) ? $request['telefono'] : '',
            'correo_empresa' => isset($request['correo_empresa']) ? $request['correo_empresa'] : '',
            'correo_contacto' => isset($request['correo_contacto']) ? $request['correo_contacto'] : '',
            'fecha1' => isset($request['fecha_ingreso']) ? $request['fecha_ingreso'] : '',
            'fecha2' => isset($request['fecha_final']) ? $request['fecha_final'] : '',
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
