<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdministracionEmpresaController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    /*public function edit(Request $request,$idEmpresa)
    {
        $idEmpresa= Crypt::decrypt($idEmpresa);

        //Obtiene todos los catalogos
        $tiposIdentificacion = $this->general->obtenerCatalogo("getTiposEmpresa");
        $provincias= $this->general->obtenerUbicacion("getUbicacion","provincias");
        $cantones= $this->general->obtenerUbicacion("getUbicacion","cantones",2);
        $distritos= $this->general->obtenerUbicacion("getUbicacion","distritos",2,1);
        $barrios= $this->general->obtenerUbicacion("getUbicacion","barrios",2,1,1);
        $catalogoPaises= $this->general->obtenerCatalogo("getPaises");
        $catalogoTipoPlanilla= $this->general->obtenerCatalogo("getTiposPlanilla");
        $catalogoMonedas= $this->general->obtenerCatalogo("getMonedas");
        $catalogoTiposPago= $this->general->obtenerCatalogo("getTiposPago");
        $catalogoBancos= $this->general->obtenerCatalogo("getBancos");//Obtiene todos los catalogos
        $accionesPersonal = $this->general->obtenerCatalogo("getCategoriasAccionPersonalEmpresa", $request->session()->get('id_cliente'));

        //Obtener datos generales
        $url = env("API_DIR")."getEmpresa";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';

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
                $resultadoEmpresa= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoEmpresa = collect(json_decode($datosDescargar));
                $resultadoEmpresa = $resultadoEmpresa[0];

                //si tiene los datos de ubicacion se actualizan
                if(isset($resultadoEmpresa->id_provincia))
                {
                    $provincias = $this->general->obtenerUbicacion("getUbicacion", "provincias");
                    $cantones = $this->general->obtenerUbicacion("getUbicacion", "cantones", $resultadoEmpresa->id_provincia);
                    $distritos = $this->general->obtenerUbicacion("getUbicacion", "distritos", $resultadoEmpresa->id_provincia, $resultadoEmpresa->id_canton);
                    $barrios = $this->general->obtenerUbicacion("getUbicacion", "barrios", $resultadoEmpresa->id_provincia, $resultadoEmpresa->id_canton, $resultadoEmpresa->id_distrito);
                }
            }
        }

        //Obtener comunicacion
        $url = env("API_DIR")."getEmpresaComunicacion";
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
                $resultadoComunicacion= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoComunicacion = collect(json_decode($datosDescargar));

                if(isset($resultadoComunicacion[0])){
                    $resultadoComunicacion = $resultadoComunicacion[0];
                }
                else{
                    $resultadoComunicacion=[];
                }
            }
        }

        //Obtener planilla
        $url = env("API_DIR")."getEmpresaPlanilla";
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
                $resultadoPlanilla= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok')
            {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoPlanilla = collect(json_decode($datosDescargar));

                if(!isset($resultadoPlanilla[0]))
                {
                    $resultadoPlanilla=[];
                }
                else
                {
                    $resultadoPlanilla = $resultadoPlanilla[0];
                }
            }
        }

        //Obtener bancos
        $url = env("API_DIR")."getEmpresaBancos";
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
                $resultadoBancos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoBancos = collect(json_decode($datosDescargar));
            }
        }

        //Obtener puestos
        $url = env("API_DIR")."getEmpresaPuestos";
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
                $resultadoPuestos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoPuestos = collect(json_decode($datosDescargar));
            }
        }

        if(isset($request['tipoForm'])){
            session()->flash("tipoForm",$request['tipoForm']);
        }

        $conjuntoParametros = [
            'tiposIdentificaciones' => $tiposIdentificacion,
            'provincias' => $provincias,
            'cantones' => $cantones,
            'distritos'=>$distritos,
            'barrios' => $barrios,
            'catalogoPaises' => $catalogoPaises,
            'catalogoTipoPlanilla'=>$catalogoTipoPlanilla,
            'catalogoMonedas' => $catalogoMonedas,
            'catalogoTiposPago' => $catalogoTiposPago,
            'catalogoBancos' => $catalogoBancos,
            'resultadoEmpresa'=>$resultadoEmpresa,
            'resultadoComunicacion' => $resultadoComunicacion,
            'resultadoPlanilla' => $resultadoPlanilla,
            'resultadoBancos' => $resultadoBancos,
            'resultadoPuestos'=>$resultadoPuestos,
            'accionesPersonal'=>$accionesPersonal
        ];

//        //dd($conjuntoParametros);

        return view('configuracion.administracionEmpresa.administracionEmpresa_index',$conjuntoParametros);
    }*/

    public function administracionEmpresa_index(Request $request){
        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        return view('configuracion.administracionEmpresa.administracionEmpresa_new_index');
    }

    public function link_config_ocupaciones(){
        session()->flash("tipo_form","ocupaciones-tab");
        session()->flash("tipoForm",true);

        return view('configuracion.administracionEmpresa.administracionEmpresa_new_index');
    }

    public function datos_generales(Request $request){

        //Obtiene todos los catalogos
        $tiposIdentificacion = $this->general->obtenerCatalogo("getTiposEmpresa");
        $provincias= $this->general->obtenerUbicacion("getUbicacion","provincias");
        $cantones= $this->general->obtenerUbicacion("getUbicacion","cantones",2);
        $distritos= $this->general->obtenerUbicacion("getUbicacion","distritos",2,1);
        $barrios= $this->general->obtenerUbicacion("getUbicacion","barrios",2,1,1);
        $catalogoTipoPlanilla= $this->general->obtenerCatalogo("getTiposPlanilla");
        $catalogoBancos= $this->general->obtenerCatalogo("getBancos");//Obtiene todos los catalogos
        $medios_comerciales = $this->general->obtener_catalogo_medios_comerciales();
        //Obtener datos generales
        $url = env("API_DIR")."getEmpresa";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';

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
                $resultadoEmpresa= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoEmpresa = collect(json_decode($datosDescargar));
                $resultadoEmpresa = $resultadoEmpresa[0];

                //si tiene los datos de ubicacion se actualizan
                if(isset($resultadoEmpresa->id_provincia))
                {
                    $provincias = $this->general->obtenerUbicacion("getUbicacion", "provincias");
                    $cantones = $this->general->obtenerUbicacion("getUbicacion", "cantones", $resultadoEmpresa->id_provincia);
                    $distritos = $this->general->obtenerUbicacion("getUbicacion", "distritos", $resultadoEmpresa->id_provincia, $resultadoEmpresa->id_canton);
                    $barrios = $this->general->obtenerUbicacion("getUbicacion", "barrios", $resultadoEmpresa->id_provincia, $resultadoEmpresa->id_canton, $resultadoEmpresa->id_distrito);
                }
                try{
                    if (file_exists($resultadoEmpresa->foto) && File::isReadable($resultadoEmpresa->foto)) {
                        $foto=file_get_contents($resultadoEmpresa->foto);
                        $foto=base64_encode($foto);
                        $existe_path=true;
                    } else {
                        $existe_path = false;
                    }
                }catch(\Exception $e){
                    $existe_path=false;
                }
            }
        }

        $conjuntoParametros = [
            'tiposIdentificaciones' => $tiposIdentificacion,
            'provincias' => $provincias,
            'cantones' => $cantones,
            'distritos'=>$distritos,
            'barrios' => $barrios,
            'foto' => $foto??'',
            'existe_path'=>$existe_path,
            'medios_comerciales'=>$medios_comerciales,
            'catalogoTipoPlanilla'=>$catalogoTipoPlanilla,
            'catalogoBancos' => $catalogoBancos,
            'resultadoEmpresa'=>$resultadoEmpresa,
        ];
        $html=View::make('configuracion.administracionEmpresa.datos_generales',$conjuntoParametros)->render();
//        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);
    }

    public function tab_comunicaciones(Request $request){

        //Obtener comunicacion
        $url = env("API_DIR")."getEmpresaComunicacion";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';
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
                $resultadoComunicacion= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoComunicacion = collect(json_decode($datosDescargar));

                if(isset($resultadoComunicacion[0])){
                    $resultadoComunicacion = $resultadoComunicacion[0];
                }
                else{
                    $resultadoComunicacion=[];
                }
            }
        }

        if(isset($request['tipoForm'])){
            session()->flash("tipoForm",$request['tipoForm']);
        }

        $conjuntoParametros = [
            'resultadoComunicacion' => $resultadoComunicacion,
        ];


        $html=View::make('configuracion.administracionEmpresa.comunicaciones',$conjuntoParametros)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html,
            'success'=>$request->session()->get('success')
        ]);
    }

    public function tab_planilla(Request $request){

        $catalogoPaises= $this->general->obtenerCatalogo("getPaises");
        $catalogoTipoPlanilla= $this->general->obtenerCatalogo("getTiposPlanilla");
        $catalogoMonedas= $this->general->obtenerCatalogo("getMonedas");
        $catalogoTiposPago= $this->general->obtenerCatalogo("getTiposPago");

        //Obtener datos generales
        $url = env("API_DIR")."getEmpresa";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';

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
                $resultadoEmpresa= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoEmpresa = collect(json_decode($datosDescargar));
                $resultadoEmpresa = $resultadoEmpresa[0];
            }
        }


        //Obtener planilla
        $url = env("API_DIR")."getEmpresaPlanilla";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';
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
                $resultadoPlanilla= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok')
            {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoPlanilla = collect(json_decode($datosDescargar));

                if(!isset($resultadoPlanilla[0]))
                {
                    $resultadoPlanilla=[];
                }
                else
                {
                    $resultadoPlanilla = $resultadoPlanilla[0];
                }
            }
        }


        if(isset($request['tipoForm'])){
            session()->flash("tipoForm",$request['tipoForm']);
        }



        $url_creditos=env("API_DIR")."getCreditosFamiliares";
        $parametros_creditos='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url_creditos, $parametros_creditos);

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

        $conjuntoParametros = [
            'catalogoPaises' => $catalogoPaises,
            'catalogoTipoPlanilla'=>$catalogoTipoPlanilla,
            'catalogoMonedas' => $catalogoMonedas,
            'catalogoTiposPago' => $catalogoTiposPago,
            'resultadoPlanilla' => $resultadoPlanilla,
            'resultadoEmpresa' =>$resultadoEmpresa,
            'resultado'=>$resultadoFinal[0],
        ];


        $html=View::make('configuracion.administracionEmpresa.planilla',$conjuntoParametros)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);
    }

    public function tab_bancos(Request $request){

        $catalogoTipoPlanilla= $this->general->obtenerCatalogo("getTiposPlanilla");
        $catalogoMonedas= $this->general->obtenerCatalogo("getMonedas");
        $catalogoBancos= $this->general->obtenerCatalogo("getBancos");//Obtiene todos los catalogos

        //Obtener bancos
        $url = env("API_DIR")."getEmpresaBancos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';
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
                $resultadoBancos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoBancos = collect(json_decode($datosDescargar));
            }
        }

        if(isset($request['tipoForm'])){
            session()->flash("tipoForm",$request['tipoForm']);
        }

        $conjuntoParametros = [
            'catalogoTipoPlanilla'=>$catalogoTipoPlanilla,
            'catalogoMonedas' => $catalogoMonedas,
            'catalogoBancos' => $catalogoBancos,
            'resultadoBancos' => $resultadoBancos,
        ];


        $html=View::make('configuracion.administracionEmpresa.bancos',$conjuntoParametros)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);
    }

    public function tab_control_horario(Request $request){


        $html=view('configuracion.administracionEmpresa.control_horario')->renderSections()['page-content'];
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);
    }

    public function tab_ocupaciones(Request $request){

        //Obtener puestos
        $url = env("API_DIR")."getEmpresaPuestos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';
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
                $resultadoPuestos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoPuestos = collect(json_decode($datosDescargar));
            }
        }

        if(isset($request['tipoForm'])){
            session()->flash("tipoForm",$request['tipoForm']);
        }

        $conjuntoParametros = [
            'resultadoPuestos'=>$resultadoPuestos,
        ];


        $html=View::make('configuracion.administracionEmpresa.ocupaciones',$conjuntoParametros)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);
    }

    public function tab_accion_personal(Request $request){

        $accionesPersonal = $this->general->obtenerCatalogo("getCategoriasAccionPersonalEmpresa", $request->session()->get('id_cliente'));
        $conjuntoParametros = [
            'accionesPersonal'=>$accionesPersonal
        ];

        $html=View::make('configuracion.administracionEmpresa.accion_personal',$conjuntoParametros)->render();
        return response()->json([
            'html'=>$html
        ]);
    }

    public function edit(Request $request, $id_categoria)
    {
        $id_categoria=Crypt::decrypt($id_categoria);

        //variables a usar en el api
        $url = env("API_DIR")."getSubCategoriasAccionPersonalEmpresa";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';
        $id_empresa = $request->session()->get('id_cliente');

        //se guardan variables de busqueda
        $buscar = "";

        if($id_categoria)
        {
            $parametros .= ',"id_categoria" : "'.$id_categoria.'"';
            $parametros .= ',"id_empresa" : "'.$id_empresa.'"';
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
                    break;
                }
            }
            // Convertir el array de nuevo en un objeto
            $resultadoFinal = (object) $arrayRevertido;
        }

        $conjuntoResultados = [
            'resultado'=>$resultadoFinal,
            'existe_porcentaje'=>$existe_porcentaje,
            'id_empresa'=>$id_empresa,
        ];

        return view('configuracion.administracionEmpresa.accion_personal_edit',$conjuntoResultados);
    }

    public function update($idEmpresa,Request $request)
    {
        $idEmpresa=Crypt::decrypt($idEmpresa);
        if($request['tipoForm'] == "Datos generales")
        {
            $respuesta = $this->guardarDatosGenerales($idEmpresa,$request);
        }

        if($request['tipoForm'] == "Comunicaciones")
        {
            $respuesta = $this->guardarComunicaciones($idEmpresa,$request);
        }

        if($request['tipoForm'] == "Planilla")
        {
            if(is_null($request['id_tipos_planilla']))
            {
                $respuesta = array("estado" => "error", "codigo" => "Datos faltantes", "error" => "Debe ingresar al menos un tipo de planilla.", "tipo_error" => "300");
            }
            else if(is_null($request['id_monedas']))
            {
                $respuesta = array("estado" => "error", "codigo" => "Datos faltantes", "error" => "Debe ingresar al menos una moneda.", "tipo_error" => "300");
            }
            else
            {
                $respuesta = $this->guardarPlanilla($idEmpresa,$request);
            }
        }

        if($request['tipoForm'] == "Bancos")
        {
            if(is_null($request['id_tipos_planilla_banco']))
            {
                $respuesta = array("estado" => "error", "codigo" => "Datos faltantes", "error" => "Debe ingresar al menos un tipo de planilla.", "tipo_error" => "300");
            }
            else
            {
                $respuesta = $this->guardarBanco($idEmpresa,$request);
            }
        }

        if($request['tipoForm'] == "Ocupaciones")
        {
            $respuesta = $this->guardarOcupaciones($idEmpresa,$request);
        }

        if($request['tipoForm'] === "Configuración del sistema")
        {
            $respuesta = $this->guardarSistema($idEmpresa,$request);

            if($respuesta['estado'] == 'ok')
            {
                Session::put('tiempo_sesion', $respuesta['info']);

            }

        }

        //si da respuesta de error
        if(isset($respuesta['error']))
        {

            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' .($respuesta['error']['codigo'][0]??$respuesta['error']) . ' ';

            return redirect()
                ->back()
                ->withTipoForm($request['tab'])
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        $mensaje_exito=$request['tipoForm']=='Ocupaciones'?"El registrado de la ocupación fue guardado con éxito.":"{$request['tipoForm']} fueron modificados para la empresa con éxito!";

        return redirect()
            ->back()
            ->withSuccess($mensaje_exito)
            ->withTipoForm($request['tab']);
    }

    public function guardarDatosGenerales($idEmpresa,Request $request)
    {
        if(isset($request['fotoActual'])){
            $request['fotoActual']= Crypt::decrypt( $request['fotoActual']);
        }

        $path_file_name = "";

        if(isset($request['frm_fotos']))
        {
            if($request['frm_fotos']!="")
            {
                TempDir::destroy_file($request['fotoActual']);
                $content = base64_decode($request['frm_fotos']);
                $dir=cls_storage::dir_warehouse_filesystems_img_group(session()->get('id_cliente'), 2);
                $filename=cls_storage::filename_doc('png');
                $path_file_name=$dir.$filename;
                $file = fopen($path_file_name, "wb");
                fwrite($file, $content);
                fclose($file);

            }
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

        //Crear o editar empresa en api
        $url = env("API_DIR")."editarEmpresa";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'id_tipo_empresa'=> trim($request['id_tipo_identificacion']),
            'identificacion'=> trim($request['identificacion']),
            'nombre'=> trim($request['nombre']),
            'nombre_fantasia'=>trim($request['nombre_fantasia']),
            'id_provincia'=> trim($request['provincia']),
            'id_canton'=> trim($request['canton']),
            'id_distrito'=> trim($request['distrito']),
            'id_barrio'=> trim($request['barrio']),
            'direccion'=>trim($request['direccion']),
            'correo'=>trim($request['correo']),
            'telefono_fijo'=>$this->general->formatPhoneNumber($request['frm_codigo_pais'], $request['telefonoFijo']),
            'telefono_celular'=> $this->general->formatPhoneNumber($request['frm_codigo_pais2'], $request['telefonoCelular']),
            'foto' => trim($path_file_name),
            'medio_comunicacion'=>$request['medio_comunicacion']
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        if(isset($respuesta['error']))
        {
            if(!empty($path_file_name))
            {
                TempDir::destroy_file($path_file_name);
            }

        }


        return $respuesta;
    }

    public function tab_sistema(Request $request){

        //Obtener comunicacion
        $url = env("API_DIR")."getEmpresaComunicacion";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';
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
                $resultadoComunicacion= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoComunicacion = collect(json_decode($datosDescargar));

                if(isset($resultadoComunicacion[0])){
                    $resultadoComunicacion = $resultadoComunicacion[0];
                }
                else{
                    $resultadoComunicacion=[];
                }
            }
        }

        if(isset($request['tipoForm'])){
            session()->flash("tipoForm",$request['tipoForm']);
        }

        $conjuntoParametros = [
            'resultadoComunicacion' => '',
        ];


        $html=View::make('configuracion.administracionEmpresa.sistema',$conjuntoParametros)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html,
            'success'=>$request->session()->get('success')
        ]);
    }

    public function guardarComunicaciones($idEmpresa,Request $request)
    {
        //Crear o editar comunicaciones empresa en api
        $url = env("API_DIR")."editarEmpresaComunicacion";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'correo_reportes'=> trim($request['correo_reportes']),
            'correo_pagos'=> trim($request['correo_pagos']),
            'correo_curriculums'=> trim($request['correo_curriculums']),
              'correo_planilla'=> trim($request['correo_planilla'])
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarPlanilla($idEmpresa,Request $request)
    {
        //Crear o editar comunicaciones empresa en api
        $url = env("API_DIR")."editarEmpresaPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'id_pais'=> trim($request['id_pais']),
            'id_tipos_planilla'=> implode(",", $request['id_tipos_planilla']),
            'id_monedas'=> implode(",", $request['id_monedas']),
            'anios_cesantia'=> trim($request['anios_cesantia']),
            'numero_patrono_ccss'=> trim($request['numero_patrono_ccss']),
            'numero_poliza_ins'=> trim($request['numero_poliza_ins']),
            'id_tipo_pago'=> trim($request['id_tipo_pago']),
            'porcentaje_salario_adelanto'=> trim($request['porcentaje_salario_adelanto'])==''?"0.00":trim($request['porcentaje_salario_adelanto']),
            'porcentaje_cargas_adelanto'=> trim($request['porcentaje_cargas_adelanto']),
            'porcentaje_deducciones_adelanto'=> trim($request['porcentaje_deducciones_adelanto']),
            'aplicar_cargas_renta_adelanto'=>strtolower($request['form-field-select-cargas'])??'',
            'porcentaje_poliza_ins'=> trim($request['porcentaje_poliza_ins'])
        ];

        //session(['prestamos' => trim($request['prestamos'])=="on"?"1":"0"]);

        //dd($conjuntoParametros);
        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarBanco($idEmpresa,Request $request)
    {
        //Crear o editar comunicaciones empresa en api
        $url = env("API_DIR")."crearEmpresaBanco";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'id_tipos_planilla'=>  implode(",", $request['id_tipos_planilla_banco']),
            'id_moneda'=> trim($request['id_moneda_Banco']),
            'id_banco'=> trim($request['id_banco']),
            'cuenta_iban'=> trim($request['cuentaIban']),
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarOcupaciones($idEmpresa,Request $request)
    {
        //Crear o editar comunicaciones empresa en api
        $url = env("API_DIR")."crearEmpresaPuesto";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'codigo' => trim($request['codigoPuesto']),
            'nombre' => trim($request['nombrePuesto'])
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarSistema($idEmpresa,Request $request)
    {
        //Crear o editar comunicaciones empresa en api
        $url = env("API_DIR")."editarTiempoSesionEmpresa";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'tiempo_sesion' => trim($request['tiempo_sesion']),

        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function deletePuesto(Request $request,$idPuesto)
    {
        //eliminar puesto en api
        $url = env("API_DIR")."eliminarEmpresaPuesto";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_puesto' => trim($idPuesto),
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);


        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        session()->flash("tipo_form","ocupaciones-tab");
        return redirect()
            ->back()
            ->withSuccess("La ocupación fue eliminada con éxito!");
    }

    public function updatePuesto($idPuesto,Request $request)
    {
        //editar puesto en api
        $url = env("API_DIR")."editarEmpresaPuesto";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_puesto' => trim($idPuesto),
            'codigo' => trim($request['codigoPuestoEditar']),
            'nombre' => trim($request['nombrePuestoEditar'])
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        session()->flash("tipo_form","ocupaciones-tab");
        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        return redirect()
            ->back()
            ->withSuccess("El puesto fue modificado para la empresa con éxito!");
    }


    public function deleteAccionPersonal($idAccionPersonal)
    {
        session()->flash("tipo_form","accionPersonal-tab");

        return redirect()
            ->back()
            ->withSuccess("La acción de personal fue eliminada para la empresa con éxito!");
    }

    public function updateAccionPersonal($idAccionPersonal,Request $request)
    {
        session()->flash("tipo_form","accionPersonal-tab");

        return redirect()
            ->back()
            ->withSuccess("La acción de personal fue modificada para la empresa con éxito!");
    }

    public function eliminarBanco($idEmpresa,$idBanco)
    {
        $idEmpresa=Crypt::decrypt($idEmpresa);
        //eliminar banco en api
        $url = env("API_DIR")."eliminarEmpresaBanco";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($idEmpresa),
            'id' => trim($idBanco)
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        session()->flash("tipo_form","bancos-tab");

        return redirect()
            ->back()
            ->withSuccess("El banco de la empresa, fue eliminado con éxito!");
    }

    public function updateAction($idEmpresa,Request $request){
        
        try {
            if(is_array($request['frm_subcategoria'])){

                $subcategorias=$request['frm_subcategoria'];
                $url = env("API_DIR")."editarSubCategoriaAccionPersonalEmpresa";

                foreach ($subcategorias as &$subcategoria){

                    $validator = Validator::make($subcategoria, [
                        'porcentaje1' => 'nullable|numeric|min:0|max:100',
                        'porcentaje2' => 'nullable|numeric|min:0|max:100',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $conjuntoParametros = [
                        'usuario' => env("API_USUARIO"),
                        'clave' => env("API_CLAVE"),
                        'id_empresa' => $idEmpresa,
                        'id_subcategoria' => $subcategoria['id_subcategoria'],
                        'nombre' => $subcategoria['nombre'],
                        'editar_porcentaje1' => $subcategoria['editar_porcentaje1'],
                    ];

                    if(isset($subcategoria['porcentaje1'])){
                        $conjuntoParametros['porcentaje1'] = $subcategoria['porcentaje1'];
                    }

                    if(isset($subcategoria['porcentaje2'])){
                        $conjuntoParametros['porcentaje2'] = $subcategoria['porcentaje2'];
                    }

                    $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

                    if(isset($respuesta['error'])){

                        return redirect()->back()->withErrors([
                            'error' => $respuesta['error']
                        ]);
                    }
                }

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
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                'error' => 'Lo sentimos, ha ocurrido un error inesperado. Por favor, inténtalo de nuevo más tarde o ponte en contacto con el soporte técnico para obtener ayuda.'
            ]);
        }
    }
}
