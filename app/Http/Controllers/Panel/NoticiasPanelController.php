<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\NoticiasRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NoticiasPanelController extends Controller{
    private $general;

    public function __construct(){
        $this->general=new funcionesGenerales();
    }

    public function index(Request $request){

        //variables a usar en el api
        $url=env("API_DIR")."getNoticias";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        //se guardan variables de busqueda
        $buscar="";

        if(isset($request['buscar']) && trim($request['buscar'])!=""){
            $buscar=$request['buscar'];
            $parametros.=',"buscar" : "'.$buscar.'"';
        }

        if(is_array($request['filtro'])){

            $filtro=$request['filtro'];

            if(!empty($filtro['estado'])){
                $parametros.=',"estado" : "'.$filtro['estado'].'"';
            }

            if(!empty($filtro['orden'])){
                $parametros.=',"orden" : "'.$filtro['orden'].'"';
            }

            if(!empty($filtro['tipo_orden'])){
                $parametros.=',"tipo_orden" : "'.$filtro['tipo_orden'].'"';
            }

            if(!empty($filtro['fecha_ingreso']) && !empty($filtro['fecha_final'])){
                $filtro['fecha_ingreso']=Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_ingreso']))->format('Y-m-d');
                $filtro['fecha_final']=Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_final']))->format('Y-m-d');

                $parametros.=',"fecha1" : "'.$filtro['fecha_ingreso'].'"';
                $parametros.=',"fecha2" : "'.$filtro['fecha_final'].'"';

                $filtro['fecha_ingreso']=Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_ingreso']))->format('d/m/Y');
                $filtro['fecha_final']=Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_final']))->format('d/m/Y');
            }

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

        $conjuntoResultados=[
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar,
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'estado'=>$filtro['estado'] ?? "",
            'total'=>$respuesta['total_noticias'],
            'total_paginas'=>$respuesta['total_paginas'],
            'fecha1'=>$filtro['fecha_ingreso'] ?? "",
            'fecha2'=>$filtro['fecha_final'] ?? "",
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
        ];

        return view('panel.noticias.noticias_index', $conjuntoResultados);
    }

    public function create(){
        return view('panel.noticias.noticias_create');
    }

    public function store(NoticiasRequest $request){
        //Validar
        $request->validated();

        //Crear noticias en api
        $url=env("API_DIR")."crearNoticia";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'titulo'=>trim($request["titulo"]),
            'descripcion'=>trim($request['descripcion']),
            'estado'=>trim($request['estado']),
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaPublicacion']))->format('Y-m-d'),
            'url_web'=>trim($request['url'])
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
        return redirect()->route('noticiasPanel.index')->withSuccess("La noticia fue registrada con éxito!");
    }

    public function edit(Request $request, $idNoticia){
        $idNoticia=Crypt::decrypt($idNoticia);

        //variables a usar en el api
        $url=env("API_DIR")."getNoticia";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_noticia'=>$idNoticia
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
        return view('panel.noticias.noticias_edit', $conjuntoResultados);
    }

    public function update($idNoticia, Request $request){
        $idNoticia=Crypt::decrypt($idNoticia);

        //Modificar noticias en api
        $url=env("API_DIR")."editarNoticia";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_noticia'=>$idNoticia,
            'titulo'=>trim($request["titulo"]),
            'descripcion'=>trim($request['descripcion']),
            'estado'=>trim($request['estado']),
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaPublicacion']))->format('Y-m-d'),
            'url_web'=>trim($request['url'])
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

        return redirect()->route('noticiasPanel.index')->withSuccess("La noticia con el titulo {$respuesta['info']['titulo']} fue modificada con éxito!");
    }

    public function destroy($idNoticia){
        $idNoticia=Crypt::decrypt($idNoticia);

        //Eliminar noticias en api
        $url=env("API_DIR")."eliminarNoticia";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_noticia'=>$idNoticia
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

        return redirect()->route('noticiasPanel.index')->withSuccess("La noticia con el titulo {$respuesta['info'][0]['titulo']} fue eliminada con éxito!");
    }


    public function descargar_excel(Request $request){
        
        //Genera datos de excel
        $url = env("API_DIR")."exportarExcelNoticias";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'buscar' => $request['buscar'],
            'estado' => $request['estado'],
            'fecha1' => $request['fechaIngreso'],
            'fecha2' => $request['fechaFinal'],
            'orden' => $request['orden'],
            'tipo_orden' => $request['tipo_orden'],
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
