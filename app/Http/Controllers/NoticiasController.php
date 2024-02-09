<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Seguridad\SecureValue;
use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class NoticiasController extends Controller{
    private $general;

    public function __construct(){
        $this->general=new funcionesGenerales();
    }

    public function index(Request $request){

        session()->now('wysiwyg','1');
        //variables a usar en el api
        $url=env("API_DIR")."getNoticiasEmpresa";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $parametros.=',"id_empresa" : "'.session()->get('id_cliente').'"';
        //se guardan variables de busqueda
        $buscar="";

        if(isset($request['buscar']) && trim($request['buscar'])!=""){
            $buscar=$request['buscar'];
            $parametros.=',"buscar" : "'.$buscar.'"';
        }

        if(is_array($request['filtro'])){

            $filtro=$request['filtro'];

            if(!empty($filtro['estado'])){

                if ($filtro['estado'][0] !== "0") {
                    $parametros.=',"filtro_estado": "'.implode(',', $filtro['estado']).'"';
                }
                if ($filtro['estado'][0] === "0") {
                    $array=[
                        'publicado',
                        'borrador'
                    ];
                    $parametros.=',"filtro_estado": "'.implode(',', $array).'"';
                }
            }

            if(!empty($filtro['fecha_ingreso']) && !empty($filtro['fecha_final'])){
                $filtro['fecha_ingreso'] = Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_ingreso']))->format('Y-m-d');
                $filtro['fecha_final'] = Carbon::createFromFormat('d/m/Y', trim($filtro['fecha_final']))->format('Y-m-d');

                $parametros.=',"filtro_fecha1" : "'.$filtro['fecha_ingreso'].'"';
                $parametros.=',"filtro_fecha2" : "'.$filtro['fecha_final'].'"';

                $filtro['fecha_ingreso'] = Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_ingreso']))->format('d/m/Y');
                $filtro['fecha_final'] = Carbon::createFromFormat('Y-m-d', trim($filtro['fecha_final']))->format('d/m/Y');
            }

        }else{
            $parametros.=',"filtro_estado": "'.'publicado'.'"';
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

        foreach($resultadoFinal as $data){
            $data->descripcion = SecureValue::decode(trim($data->descripcion), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        }
        $conjuntoResultados=[
            'resultado'=>$resultadoFinal,
            'buscar'=>$buscar,
            'orden'=>$filtro['orden'] ?? "",
            'tipo_orden'=>$filtro['tipo_orden'] ?? "",
            'estado'=>$filtro['estado'][0] ?? "",
            'total'=>$respuesta['total_noticias'],
            'total_paginas'=>$respuesta['total_paginas'],
            'fecha1'=>$filtro['fecha_ingreso'] ?? "",
            'fecha2'=>$filtro['fecha_final'] ?? "",
            'cantidad'=>$cantidad,
            'paginaActual'=>$paginaActual,
            //            'resultadoExcel'=>$resultadoExcel
        ];
        if(isset($_REQUEST['success']) && isset($_REQUEST['message'])){
            return redirect()->route('noticias.index')->withSuccess($_REQUEST['message']);
        }
        return view('recursosHumanos.noticias.noticias_index', $conjuntoResultados);
    }

    public function create(){
                session()->now('wysiwyg','1');
        return view('recursosHumanos.noticias.noticias_create');
    }

    public function ui_mantenimiento_noticia(){
        session()->now('wysiwyg','1');
        $html=view('recursosHumanos.noticias.noticias_create')->renderSections()['page-content'];
        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html,
            'js'=>$js
        ]);
    }

    public function store(Request $request){
        session()->now('wysiwyg','1');
        //Crear noticias en api
        $url=env("API_DIR")."crearNoticiaEmpresa";
        $request['contenido']=SecureValue::encode(trim($request['contenido']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>session()->get('id_cliente'),
            'titulo'=>trim($request["tituloNoticia"]),
            'descripcion'=>trim($request['contenido']),
            'estado'=>trim($request['estadoNoticia']),
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaPublicacion']))->format('Y-m-d'),
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
        return redirect()->route('noticias.index')->withSuccess("La noticia fue registrada con éxito!");

    }

    public function edit(Request $request, $idNoticia){
        session()->now('wysiwyg','1');
        $idNoticia=Crypt::decrypt($idNoticia);

        //variables a usar en el api
        $url=env("API_DIR")."getNoticiaEmpresa";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>session()->get('id_cliente'),
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
        $resultadoFinal[0]->descripcion = SecureValue::decode(trim($resultadoFinal[0]->descripcion), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        $conjuntoResultados=[
            'resultado'=>$resultadoFinal[0]
        ];
        return view('recursosHumanos.noticias.noticias_edit', $conjuntoResultados);
    }

    public function update($idNoticia, Request $request){
        session()->now('wysiwyg','1');
        $idNoticia=Crypt::decrypt($idNoticia);
        // Obtén los nombres de las imágenes eliminadas desde el campo imagenesEliminadas
        $imagenesEliminadas = $request->input('imagenesEliminadas');

        if (!empty($imagenesEliminadas)) {
            // Separa los nombres de las imágenes
            $nombresImagenes = explode(',', $imagenesEliminadas);

            // Itera sobre los nombres de las imágenes y elimínalas
            foreach ($nombresImagenes as $nombreImagen) {
                // Asegúrate de que el nombre de la imagen no esté vacío antes de intentar eliminarla
                if (!empty($nombreImagen)) {
                    $this->eliminarImagenEnServidor($nombreImagen);
                }
            }
        }

        //Modificar noticias en api
        $url=env("API_DIR")."editarNoticiaEmpresa";
        $request['contenido']=SecureValue::encode(trim($request['contenido']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>session()->get('id_cliente'),
            'id_noticia'=>$idNoticia,
            'titulo'=>trim($request["tituloNoticia"]),
            'descripcion'=>trim($request['contenido']),
            'estado'=>trim($request['estadoNoticia']),
            'fecha'=>Carbon::createFromFormat('d/m/Y', trim($request['fechaPublicacion']))->format('Y-m-d'),
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

        return redirect()->route('noticias.index')->withSuccess("La noticia con el titulo {$respuesta['info']['titulo']} fue modificada con éxito!");
    }

    public function destroy($idNoticia){
        session()->now('wysiwyg','1');
        $idNoticia=Crypt::decrypt($idNoticia);

        //Eliminar noticias en api
        $url=env("API_DIR")."eliminarNoticiaEmpresa";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>session()->get('id_cliente'),
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

        return response()->json([
            'success' => true,
            'message' => "La noticia con el titulo {$respuesta['info'][0]['titulo']} fue eliminada con éxito!",
            'redirect' => route('noticias.index')
        ]);
    }

    private function eliminarImagenEnServidor($url_name)
    {
        $path=cls_storage::dir_warehouse_wysiwyg(session()->get('id_cliente'));

        $filename = basename($url_name);
        $path_filename=$path.$filename;
        try{
            if (file_exists($path_filename) && File::isReadable($path_filename)) {
                TempDir::destroy_file($path_filename);
            }
        }catch(\Exception $e){

        }
    }

    public function __destruct()
    {
        return redirect()->back()->withSuccess("Los porcentajes han sido modificados éxito.");
    }

}
