<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use App\Http\Requests\ColaboradoresRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class ColaboradoresController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getColaboradores";
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
            'total'=>$respuesta['total_colaboradores'],
            'total_paginas'=>$respuesta['total_paginas'],
            'cantidad'=> $cantidad,
            'paginaActual'=> $paginaActual,
        ];

        return view('colaboradores.colaboradores_index', $conjuntoResultados);
    }

    public function create()
    {
        //Obtiene todos los catalogos
        $tiposIdentificacion = $this->general->obtenerCatalogo("getTiposIdentificacion");
        $generos = $this->general->obtenerCatalogo("getGeneros");
        $estadosCiviles= $this->general->obtenerCatalogo("getEstadosCiviles");
        $provincias= $this->general->obtenerUbicacion("getUbicacion","provincias");
        $cantones= $this->general->obtenerUbicacion("getUbicacion","cantones",2);
        $distritos= $this->general->obtenerUbicacion("getUbicacion","distritos",2,1);
        $barrios= $this->general->obtenerUbicacion("getUbicacion","barrios",2,1,1);

        $conjuntoParametros = [
            'tiposIdentificaciones' => $tiposIdentificacion,
            'generos' => $generos,
            'estadosCiviles' => $estadosCiviles,
            'provincias' => $provincias,
            'cantones' => $cantones,
            'distritos' => $distritos,
            'barrios' => $barrios
        ];

        return view('colaboradores.colaboradores_create',$conjuntoParametros);
    }

    public function store(ColaboradoresRequest $request)
    {
        //Validar
        $request->validated();

        //Guardar foto
        $path_file_name = "";

        if(isset($request['frm_fotos']))
        {
            if(trim($request['frm_fotos'])!="")
            {
                $content = base64_decode($request['frm_fotos']);
                $dir=cls_storage::dir_warehouse_filesystems_img_group(session()->get('id_cliente'), 1);
                $filename=cls_storage::filename_doc('png');
                $path_file_name=$dir.$filename;
                $file = fopen($path_file_name, "wb");
                fwrite($file, $content);
                fclose($file);
            }
        }

        //Crear colaborador en api
        $url = env("API_DIR")."crearColaborador";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'numero_colaborador' => trim($request["numeroColaborador"]),
            'id_tipo_identificacion' => trim($request['tipoIdentificacion']),
            'identificacion' => str_replace(['-', '_'], '', trim($request->input('identificacion'))),
            'primer_nombre' => trim($request['nombre1']),
            'segundo_nombre' => trim($request['nombre2']),
            'primer_apellido' => trim($request['apellido1']),
            'segundo_apellido' => trim($request['apellido2']),
            'id_genero' => trim($request['genero']),
            'fecha_nacimiento' => Carbon::createFromFormat('d/m/Y', trim($request['fechaNacimiento']))->format('Y-m-d'),
            'id_estado_civil' => trim($request['estadoCivil']),
            'telefono_celular' => $this->general->formatPhoneNumber($request['frm_codigo_pais'], str_replace('_', '', $request['telefonoCelular'])),
            'telefono_casa' => $this->general->formatPhoneNumber($request['frm_codigo_pais2'], str_replace('_', '', $request['telefonoCasa'])),
            'correo_personal' => trim($request['correoPersonal']),
            'id_provincia' => trim($request['provincia']),
            'id_canton' => trim($request['canton']),
            'id_distrito' => trim($request['distrito']),
            'id_barrio' => trim($request['barrio']),
            'direccion' => trim($request['direccion']),
            'foto' => trim($path_file_name),
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

        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->route('colaboradores.index')
            ->withSuccess("El colaborador fue registrado con éxito!");
    }

    public function edit(Request $request,$idColaborador)
    {
        $idColaborador=Crypt::decrypt($idColaborador);
        //Obtiene todos los catalogos
        $tiposIdentificacion = $this->general->obtenerCatalogo("getTiposIdentificacion");
        $generos = $this->general->obtenerCatalogo("getGeneros");
        $estadosCiviles= $this->general->obtenerCatalogo("getEstadosCiviles");

        //variables a usar en el api
        $url = env("API_DIR")."getColaborador";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_colaborador' => $idColaborador
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            if(isset($path_file_name))
            {
                TempDir::destroy_file($path_file_name);
            }
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


            if(isset($resultadoFinal[0]->telefono_celular)){

                $entrada = preg_replace('/[\s-]+/', '', $resultadoFinal[0]->telefono_celular);

                // Utilizar una expresión regular para extraer el ISO2 y el número
                if (preg_match('/^\((\d+)\)(\d+)$/', $entrada, $matches)) {

                    $codigoPaisCelular = $matches[1]; // Número del código de país
                    $numeroCelular = $matches[2]; // Número de teléfono

                    $resultadoFinal[0]->frm_telefonoCeluar = $numeroCelular;
                    $resultadoFinal[0]->frm_cod_paisCelular = $codigoPaisCelular;

                }


            }

            if(isset($resultadoFinal[0]->telefono_casa)){

                $entrada = preg_replace('/[\s-]+/', '', $resultadoFinal[0]->telefono_casa);

                // Utilizar una expresión regular para extraer el ISO2 y el número
                if (preg_match('/^\((\d+)\)(\d+)$/', $entrada, $matches)) {
                    $codigoPaisCasa = $matches[1]; // Número del código de país
                    $numeroCasa = $matches[2]; // Número de teléfono

                    $resultadoFinal[0]->frm_telefonoCasa = $numeroCasa;
                    $resultadoFinal[0]->frm_cod_paisCasa = $codigoPaisCasa;
                }

            }

        }

        $provincias= $this->general->obtenerUbicacion("getUbicacion","provincias");
        $cantones= $this->general->obtenerUbicacion("getUbicacion","cantones",$resultadoFinal[0]->id_provincia);
        $distritos= $this->general->obtenerUbicacion("getUbicacion","distritos",$resultadoFinal[0]->id_provincia,$resultadoFinal[0]->id_canton);
        $barrios= $this->general->obtenerUbicacion("getUbicacion","barrios",$resultadoFinal[0]->id_provincia,$resultadoFinal[0]->id_canton,$resultadoFinal[0]->id_distrito);
        try{
            if (file_exists($resultadoFinal[0]->foto) && File::isReadable($resultadoFinal[0]->foto)) {
                $foto=file_get_contents($resultadoFinal[0]->foto);
                $foto = base64_encode($foto);
                $existe_path=true;
            } else {
                $existe_path = false;
            }
        }catch(\Exception $e){
            $existe_path=false;
        }

        $conjuntoResultados = [
            'tiposIdentificaciones' => $tiposIdentificacion,
            'generos' => $generos,
            'estadosCiviles' => $estadosCiviles,
            'provincias' => $provincias,
            'cantones' => $cantones,
            'distritos' => $distritos,
            'barrios' => $barrios,
            'foto'=>$foto??"",
            'existe_path'=>$existe_path,
            'resultado' => $resultadoFinal[0]
        ];

        //dd($conjuntoResultados);

        return view('colaboradores.colaboradores_edit',$conjuntoResultados);
    }

    public function update($idColaborador,Request $request)
    {

        if(isset($request['fotoActual'])){
            $request['fotoActual']= Crypt::decrypt( $request['fotoActual']);
        }
        //Guardar foto
        $path_file_name = "";

        if(isset($request['frm_fotos']))
        {
            TempDir::destroy_file($request['fotoActual']);
            $content = base64_decode($request['frm_fotos']);
            $dir=cls_storage::dir_warehouse_filesystems_img_group(session()->get('id_cliente'), 1);
            $filename=cls_storage::filename_doc('png');
            $path_file_name=$dir.$filename;
            $file = fopen($path_file_name, "wb");
            fwrite($file, $content);
            fclose($file);
        }
        else
        {
            if(isset($request['fotoActual']))
            {
                if(trim($request['fotoActual'])!="")
                {
                    $path_file_name = trim($request['fotoActual']);
                }
            }
        }

        //Editar colaborador en api
        $url = env("API_DIR")."editarColaborador";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'numero_colaborador' => trim($request["numeroColaborador"]),
            'id_tipo_identificacion' => trim($request['tipoIdentificacion']),
            'identificacion' =>str_replace(['-', '_'], '', trim($request['identificacion'])),
            'primer_nombre' => trim(strtoupper($request['nombre1'])),
            'segundo_nombre' => trim(strtoupper($request['nombre2'])),
            'primer_apellido' => trim(strtoupper($request['apellido1'])),
            'segundo_apellido' => trim(strtoupper($request['apellido2'])),
            'id_genero' => trim($request['genero']),
            'fecha_nacimiento' => Carbon::createFromFormat('d/m/Y', trim($request['fechaNacimiento']))->format('Y-m-d'),
            'id_estado_civil' => trim($request['estadoCivil']),
            'telefono_celular' => $this->general->formatPhoneNumber($request['frm_codigo_pais'], str_replace('_', '', $request['telefonoCelular'])),
            'telefono_casa' => $this->general->formatPhoneNumber($request['frm_codigo_pais2'], str_replace('_', '', $request['telefonoCasa'])),
            'correo_personal' => trim($request['correoPersonal']),
            'id_provincia' => trim($request['provincia']),
            'id_canton' => trim($request['canton']),
            'id_distrito' => trim($request['distrito']),
            'id_barrio' => trim($request['barrio']),
            'direccion' => trim($request['direccion']),
            'foto' => $path_file_name,
        ];


        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            if(!empty($path_file_name))
            {
                TempDir::destroy_file($path_file_name);
            }
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->route('colaboradores.index')
            ->withSuccess("El colaborador fue modificado con éxito!");
    }

    public function destroy($idColaborador)
    {
        return redirect()
            ->route('colaboradores.index')
            ->withSuccess("El colaborador con el id {$idColaborador} fue eliminado con éxito!");
    }

    public function leerArchivo(Request $request){

        $archivo = $request->file('documento');

        if (!$request->hasFile('documento')) {
            return redirect()->back()->withErrors(['error' => 'Error al leer el archivo. Detalles: No se ha cargado ningún archivo']);
        }

        if ($archivo->getClientOriginalExtension() != 'txt') {
            return redirect()->back()->withErrors(['error' => 'Error al leer el archivo. Detalles: El archivo no es un txt']);
        }

        $lineas = file($archivo->getRealPath(), FILE_IGNORE_NEW_LINES);
        $lineas = array_map('utf8_encode', $lineas);

        try {
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'info' => []
            ];

            for ($i = 3; $i < count($lineas); $i++) {

                $segundo_nombre = '';
                $telefono_celular = '';
                $telefono_casa = '';
                $nombre = explode(' ', trim(substr($lineas[$i], 40, 15)));

                if(count($nombre) == 1){
                    $primer_nombre = $nombre[0];
                }else{
                    $primer_nombre = $nombre[0];
                    $segundo_nombre = $nombre[1];
                }
                $telefono = trim(substr($lineas[$i], 95, 8));
                if ($telefono[0] === "2"){
                    $telefono_casa = $telefono;
                }else{
                    $telefono_celular = $telefono;
                }

                $id_tipo_identificacion = trim(substr($lineas[$i], 0, 1));
                $identificacion = trim(substr($lineas[$i], 1, 19));
                $numero_asegurado = trim(substr($lineas[$i], 20, 20));
                $primer_apellido = trim(substr($lineas[$i], 55, 15));
                $segundo_apellido = trim(substr($lineas[$i], 70, 15));
                $fecha_nacimiento = trim(substr($lineas[$i], 85, 10));
                $correo_personal = trim(substr($lineas[$i], 103, 40));
                $id_genero = trim(substr($lineas[$i], 143, 1));
                $id_estado_civil = trim(substr($lineas[$i], 144, 1));
                $codigo_nacionalidad = trim(substr($lineas[$i], 145, 2));
                $salario_devengado = trim(substr($lineas[$i], 147, 13));
                $dias_laborales = trim(substr($lineas[$i], 160, 3));
                $horas_laborales = trim(substr($lineas[$i], 163, 4));
                $codigo_jornada = trim(substr($lineas[$i], 167, 2));
                $codigo_observacion = trim(substr($lineas[$i], 169, 2));
                $codigo_ocupacion = trim(substr($lineas[$i], 171, 5));

                $datos_colaborador = [
                    'id_tipo_identificacion' => $id_tipo_identificacion,
                    'identificacion' => $identificacion,
                    'numero_asegurado' => $numero_asegurado,
                    'primer_nombre' => $primer_nombre,
                    'segundo_nombre' => $segundo_nombre,
                    'primer_apellido' => $primer_apellido,
                    'segundo_apellido' => $segundo_apellido,
                    'fecha_nacimiento' => $fecha_nacimiento,
                    'telefono_celular' => $telefono_celular,
                    'telefono_casa' => $telefono_casa,
                    'correo_personal' => $correo_personal,
                    'id_genero' => $id_genero,
                    'id_estado_civil' => $id_estado_civil,
                    'codigo_nacionalidad' => $codigo_nacionalidad,
                    'salario_devengado' => $salario_devengado,
                    'dias_laborales' => $dias_laborales,
                    'horas_laborales' => $horas_laborales,
                    'codigo_jornada' => $codigo_jornada,
                    'codigo_observacion' => $codigo_observacion,
                    'codigo_ocupacion' => $codigo_ocupacion,

                    'id_provincia' => '',
                    'id_canton' => '',
                    'id_distrito' => '',
                    'id_barrio' => '',
                    'direccion' => '',
                ];
                
                $conjuntoParametros ['info'][] = $datos_colaborador;
            }
            // Implementación WS
            $url = env("API_DIR")."cargarColaboradoresTxtInsPlanilla";
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

            $mensaje = "Se realizó con éxito el registro de colaboradores, en total se registraron "
                .$respuesta['info']['nuevos_registros']. " nuevos";

            if($respuesta['info']['nuevos_registros'] == 1){
                $mensaje = "Se realizó con éxito el registro de colaboradores, en total se registró "
                .$respuesta['info']['nuevos_registros']. " nuevo";
            }

            if($respuesta['info']['nuevos_registros'] == 0){
                $mensaje = "Todos los colaboradores ingresados ya se encuentran en el sistema";
            }

            return redirect()->back()->withSuccess($mensaje);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al leer el archivo. Detalles: ' . $e->getMessage()]);
        }
    }

    public function ui_documento_colaboradores(){
        $html = View::make('colaboradores.adjuntar_documento_colaboradores')->render();
        return response()->json(['html' => $html]);
    }

    public function descargar_excel(Request $request){

        //Genera datos de excel
        $url = env("API_DIR")."exportarExcelColaboradores";

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
