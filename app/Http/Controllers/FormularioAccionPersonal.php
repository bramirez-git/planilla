<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Storage\cls_storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FormularioAccionPersonal extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function mostrarformulario(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        $codigos = explode("-", $request->accion);
        session(['documentosAccion' => '']);

        //Obtener datos generales
        $url = env("API_DIR")."getInfoGeneralColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$id_colaborador.'"}';

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
                $resultadoColaborador= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoColaborador = collect(json_decode($datosDescargar));
            }
        }

        if($codigos[1]=="00001")
        {
            //Obtiene el subcatalogo de amonestaciones
            $accionesAmonestaciones = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_amonestaciones',["idAccion"=>$codigos[1],'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador,'accionesAmonestaciones'=>$accionesAmonestaciones]);
        }

        if($codigos[1]=="00002")
        {
            //Obtiene el subcatalogo de constancias
            $accionesConstancias = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_constanciaSalario',["idAccion"=>$codigos[1],'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador,'accionesConstancias'=>$accionesConstancias]);
        }

        if($codigos[1]=="00003")
        {
            //Obtiene el subcatalogo de incapacidades
            $accionesIncapacidad = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_incapacidad',["idAccion"=>$codigos[1],"accionesIncapacidad"=>$accionesIncapacidad,'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador]);
        }

        if($codigos[1]=="00004")
        {
            //Obtiene el subcatalogo de licencias
            $accionesLicencias = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_licencias',["idAccion"=>$codigos[1],"accionesLicencias"=>$accionesLicencias,'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador]);
        }

        if($codigos[1]=="00005")
        {
            //Obtiene el subcatalogo de modificacion Salarial
            $accionesModificacionSalarial = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_modificacionSalarial',["idAccion"=>$codigos[1],'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador,'accionesModificacionSalarial'=>$accionesModificacionSalarial]);
        }

        if($codigos[1]=="00006")
        {
            //Obtiene el subcatalogo de permisos
            $accionesPermisos = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);
            return view('colaboradores.accionPersonal.formularios_create.formulario_permiso',["idAccion"=>$codigos[1],'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador,'accionesPermisos'=>$accionesPermisos]);
        }

        if($codigos[1]=="00007")
        {
            //Obtiene el subcatalogo de terminacion de contrato
            $accionesTerminacionContrato = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_terminacionContrato',["idAccion"=>$codigos[1],'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador,'accionesTerminacionContrato'=>$accionesTerminacionContrato]);
        }

        if($codigos[1]=="00008")
        {
            //Obtiene el subcatalogo de vacaciones
            $accionesVacaciones = $this->general->obtenerSubCatalogo("getSubCategoriasAccionPersonalEmpresa",$request->session()->get('id_cliente'),$codigos[0]);

            return view('colaboradores.accionPersonal.formularios_create.formulario_vacaciones',["idAccion"=>$codigos[1],'idColaborador'=>$id_colaborador,'resultadoColaborador'=>$resultadoColaborador,'accionesVacaciones'=>$accionesVacaciones]);
        }

        return view('colaboradores.accionPersonal.formularios_create.formularios',["idAccion"=>$codigos[1]]);
    }

    public function subirArchivoAccionPersonal(Request $request,$id_colaborador,$id_accion,$categoria)
    {
        $id_colaborador = Crypt::decrypt($id_colaborador);
        $id_accion = Crypt::decrypt($id_accion);
        $categoria = Crypt::decrypt($categoria);

        if($request->hasFile('documento'))
        {
            $documento = $request->file('documento');
            $extension = $documento->getClientOriginalExtension();


            $dir=cls_storage::dir_warehouse_acciones_personal($request->session()->get('id_cliente'));
            $filename=cls_storage::filename_doc($extension);

            //Crear colaborador en api
            $url = env("API_DIR") . "crearColaboradorDocumento";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_colaborador'=> $id_colaborador,
                'tipo_elemento'=> 'accion_personal',
                'nombre' => '-',
                'palabras_clave' => '-',
                'id_elemento'=> $id_accion,
                'categoria'=> $categoria,
                'url_documento'=> $dir.$filename,
                'fecha'=> date("Y-m-d"),
                'comentarios'=> 'Se adjunta devolución de documento.',
            ];

            //return $conjuntoParametros;
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

            //si da respuesta de error
            if (isset($respuesta['error'])) {
                return $respuesta['error'];
            }

            //si el guardado en bd fue exitoso, se guarda en el storage
            $save=cls_storage::save_file($dir, $documento, $filename,$save_alert);

            if($save)
            {
                return "guardado";
            }
        }
        return "error";
    }
}
