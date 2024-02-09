<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ColaboradoresConfiguracionController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function edit($idColaborador,Request $request)
    {
        $idColaborador=Crypt::decrypt($idColaborador);
        $catalogoTipoSeguroCCSS= $this->general->obtenerCatalogo("getTiposSeguroCCSS");
        $catalogoOcupacionesCCSS= $this->general->obtenerCatalogo("getOcupacionesCCSS");
        $catalogoNacionalidades= $this->general->obtenerCatalogo("getNacionalidadesINS");
        $catalogoTipoSeguroINS= $this->general->obtenerCatalogo("getTiposSeguroINS");
        $catalogoOcupacionesINS= $this->general->obtenerCatalogo("getOcupacionINS");
        $catalogoParentesco= $this->general->obtenerCatalogo("getParentescos");
        $catalogoTiposVehiculos= $this->general->obtenerCatalogo("getTiposVehiculos");
        $catalogoTipoLicencia= $this->general->obtenerCatalogo("getTiposLicenciaConducir");
        $catalogoPuestos = $this->general->obtenerCatalogo("getEmpresaPuestos",$request->session()->get('id_cliente'));
        $catalogoDepartamentos = $this->general->obtenerCatalogo("getDepartamentos",$request->session()->get('id_cliente'));
        $catalogoTipoPlanilla= $this->general->obtenerCatalogo("getTiposPlanilla");
        $catalogoMonedas= $this->general->obtenerCatalogo("getMonedas");
        $catalogoTipoTrabajo= $this->general->obtenerCatalogo("getTiposTrabajo");
        $catalogoJornada= $this->general->obtenerCatalogo("getJornadasTrabajo");
        $catalogoBancos= $this->general->obtenerCatalogo("getBancos");

        //Obtener datos generales
        $url = env("API_DIR")."getColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

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
                $resultadoColaborador = $resultadoColaborador[0];
            }
        }

        //Obtener los resultados de ins CCSS
        $url = env("API_DIR")."getColaboradorCCSSINS";
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
                $resultadoINSCCSS= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoINSCCSS = collect(json_decode($datosDescargar));
                $resultadoINSCCSS = $resultadoINSCCSS[0];
            }
        }

        //Obtener contactos de emergencia
        $url = env("API_DIR")."getColaboradorContactos";
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
                $resultadoContactos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoContactos = collect(json_decode($datosDescargar));
            }
        }

        //Obtener familiares
        //1.Dato de contugue
        $url = env("API_DIR")."getTrabajaConyugeColaborador";
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
                $resultadoConyugue= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoConyugue = collect(json_decode($datosDescargar));
                $resultadoConyugue = $resultadoConyugue[0];
            }
        }

        //2.Dato de hijos
        $url = env("API_DIR")."getColaboradorFamiliares";
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
                $resultadoFamiliares= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoFamiliares = collect(json_decode($datosDescargar));
            }
        }

        //Obtener vehiculos
        $url = env("API_DIR")."getColaboradorVehiculos";
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
                $resultadoVehiculos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoVehiculos = collect(json_decode($datosDescargar));
            }
        }

        //Permisos conducir
        $url = env("API_DIR")."getColaboradorLicenciasConducir";
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
                $resultadoLicencias= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoLicencias = collect(json_decode($datosDescargar));
            }
        }

        //Planilla
        $url = env("API_DIR")."getColaboradorPlanilla";
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
                $resultadoPlanillas= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoPlanillas = collect(json_decode($datosDescargar));
                $resultadoPlanillas = $resultadoPlanillas[0];
            }
        }

        //Bancos
        $url = env("API_DIR")."getColaboradorBancos";
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
                $datosDescargar = json_encode($respuesta['info']);
                $resultadoBancos = collect(json_decode($datosDescargar));
            }
        }

        //Vacaciones
        $url = env("API_DIR")."getColaboradorVacaciones";
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
                $resultadoVacaciones= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoVacaciones = collect(json_decode($datosDescargar));
            }
        }

        $añoActual = Carbon::now()->year;

        // Crear la cadena de parámetros con el año actual
        $parametros = '{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'", "anio": "'.$añoActual.'"}';

        //Historico
        $url = env("API_DIR")."getColaboradorAuxiliarAguinaldoRenta";
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
                $resultadoHistorico= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoHistorico = collect(json_decode($datosDescargar));
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoTipoSeguroCCSS'=>$catalogoTipoSeguroCCSS,
            'catalogoOcupacionesCCSS'=>$catalogoOcupacionesCCSS,
            'catalogoNacionalidades'=>$catalogoNacionalidades,
            'catalogoTipoSeguroINS'=>$catalogoTipoSeguroINS,
            'catalogoOcupacionesINS'=>$catalogoOcupacionesINS,
            'catalogoParentesco'=>$catalogoParentesco,
            'catalogoTiposVehiculos' => $catalogoTiposVehiculos,
            'catalogoTipoLicencia' => $catalogoTipoLicencia,
            'catalogoPuestos' => $catalogoPuestos,
            'catalogoDepartamentos' => $catalogoDepartamentos,
            'catalogoTipoPlanilla' => $catalogoTipoPlanilla,
            'catalogoMonedas' => $catalogoMonedas,
            'catalogoTipoTrabajo' => $catalogoTipoTrabajo,
            'catalogoJornada' => $catalogoJornada,
            'catalogoBancos' => $catalogoBancos,
            'resultadoColaborador' => $resultadoColaborador,
            'resultadoINSCCSS' => $resultadoINSCCSS,
            'resultadoContactos' => $resultadoContactos,
            'resultadoConyugue' => $resultadoConyugue,
            'resultadoFamiliares' => $resultadoFamiliares,
            'resultadoVehiculos' => $resultadoVehiculos,
            'resultadoLicencias' => $resultadoLicencias,
            'resultadoPlanillas' => $resultadoPlanillas,
            'resultadoBancos' => $resultadoBancos,
            'resultadoVacaciones' => $resultadoVacaciones,
            'resultadoHistorico'=>$resultadoHistorico];

        //dd($conjuntoResultados);
        return view('colaboradores.perfil.colaboradores_configuracion_edit',
            $conjuntoResultados);
    }

    public function update($idColaborador,Request $request)
    {

        // dd($request);
        if($request['tipoForm'] == "CCSS-INS")
        {
            $respuesta = $this->guardarINSCCSS($idColaborador,$request);
        }

        if($request['tipoForm'] == "Contactos de Emergencia")
        {
            $respuesta = $this->guardarContactoEmergencia($idColaborador,$request);
        }

        if($request['tipoForm'] == "Familiares")
        {
            $respuesta = $this->guardarFamiliar($idColaborador,$request);
        }

        if($request['tipoForm'] == "Vehículos")
        {
            $respuesta = $this->guardarVehiculo($idColaborador,$request);
        }

        if($request['tipoForm'] == "Permisos de conducir")
        {
            $respuesta = $this->guardarPermisoConducir($idColaborador,$request);
        }

        if($request['tipoForm'] == "Planilla")
        {
            $respuesta = $this->guardarPlanilla($idColaborador,$request);
        }

        if($request['tipoForm'] == "Bancos")
        {
            $respuesta = $this->guardarBanco($idColaborador,$request);
        }

        // dd($respuesta);

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
            ->withSuccess("Los datos de {$request['tipoForm']} fueron agregados al colaborador con éxito!")
            ->withTipoForm($request['tab']);

    }

    public function guardarINSCCSS($idColaborador,Request $request)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."editarColaboradorCCSSINS";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'fecha_ingreso' => Carbon::createFromFormat('d/m/Y', trim($request['fechaIngreso']))->format('Y-m-d'),
            'fecha_salida' => trim($request['fecha_salida'])!= "" ? Carbon::createFromFormat('d/m/Y', trim($request['fecha_salida']))->format('Y-m-d') : "",
            'numero_seguro_ccss' => trim($request['numeroAsegurado']),
            'id_tipo_seguro_ccss' => trim($request['tipoSeguroCCSS']),
            'id_ocupacion_ccss' => trim($request['tipoOcupacionCCSS']),
            'id_nacionalidad_ins' => trim($request['nacionalidadINS']),
            'id_tipo_seguro_ins' => trim($request['tipoAsegurado']),
            'numero_seguro_ins' => trim($request['riesgoTrabajo']),
            'id_ocupacion_ins' => trim($request['tipoOcupacionINS']),
            'tributacion_directa' => trim($request['tributacionDirectaExtranjero']),
            'id_jornada_trabajo' => trim($request['jornadaTrabajo']),
        ];
        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarContactoEmergencia($idColaborador,Request $request)
    {
        //Crear contacto colaborador en api
        $url = env("API_DIR")."crearColaboradorContacto";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'nombre' => trim($request['contactoEmergencia']),
            'id_parentesco' => trim($request['parentescoEmergencia']),
            'telefono' => $this->general->formatPhoneNumber($request['frm_codigo_pais'], str_replace('_', '', $request['telefonoEmergencia']))
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarFamiliar($idColaborador,Request $request)
    {
        //Crear contacto colaborador en api
        $url = env("API_DIR")."crearColaboradorFamiliar";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'estudiante' => trim($request['hijoEstudiante']),
            'fecha_nacimiento' => Carbon::createFromFormat('d/m/Y', trim($request['fechaNacimientoHijo']))->format('Y-m-d')
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarVehiculo($idColaborador,Request $request)
    {
        //Crear contacto colaborador en api
        $url = env("API_DIR")."crearColaboradorVehiculo";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_tipo_vehiculo' => trim($request['tipoVehiculo']),
            'marca' => trim($request['marca']),
            'modelo' => trim($request['modelo']),
            'color' => trim($request['color']),
            'placa' => trim($request['placa'])
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarPermisoConducir($idColaborador,Request $request)
    {
        //Crear contacto colaborador en api
        $url = env("API_DIR")."crearColaboradorLicenciaConducir";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_tipo_licencia_conducir' => trim($request['tipoLicencia']),
            'numero_licencia' => trim($request['numeroLicencia']),
            'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y', trim($request['fechaVencimiento']))->format('Y-m-d')
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarPlanilla($idColaborador,Request $request)
    {
        $jefatura = 0;
        if($request['jefatura']!=null)
        {
            $jefatura = 1;
        }

        //Crear contacto colaborador en api
        $url = env("API_DIR")."editarColaboradorPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_puesto' => trim($request['puestoEmpresa']),
            'perfil_ocupacional' => trim($request['perfilOcupacional']),
            'id_departamento' => trim($request['idDepartamento']),
            'jefe' => $jefatura,
            'id_tipo_planilla' => trim($request["tipoPlanilla"]),
            'id_moneda' => trim($request['moneda']),
            'salario_base' => trim($request['salarioBase']),
            'id_tipo_trabajo' => trim($request['tipoTrabajo']),
            'id_jornada_trabajo' => trim($request['jornadaTrabajo'])
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function guardarBanco($idColaborador,Request $request)
    {
        //Crear medio de pago colaborador en api
        $url = env("API_DIR")."crearColaboradorBanco";

        $tipoPago = trim($request['modoPago']);
        if($tipoPago == "deposito"){
            $request['telefonoSinpe'] = "";
        }
        if($tipoPago == "sinpe_movil"){
            $request['banco']      = 0;
            $request['moneda']     = 1;  //Colones
            $request['cuentaIban'] = "";
        }
        if($tipoPago == "cheque"){
            $request['banco']         = 0;
            $request['moneda']        = 0;
            $request['cuentaIban']    = "";
            $request['telefonoSinpe'] = "";
        }

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'tipo_pago' => trim($request['modoPago']),
            'id_banco' => trim($request['banco']),
            'id_moneda' => trim($request['moneda']),
            'cuenta' => trim($request['cuentaIban']),
            'telefono_sinpe' => trim($request['telefonoSinpe']),
        ];

        return $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
    }

    public function eliminarContactoEmergencia($idColaborador,$idContacto)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."eliminarColaboradorContacto";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_contacto' => trim($idContacto)
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

        session()->flash("tipo_form","contactoEmergencia-tab");

        return redirect()
            ->back()
            ->withSuccess("El contacto del colaborador, fue eliminado con éxito!");
    }

    public function eliminarFamiliar($idColaborador,$id_familiar)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."eliminarColaboradorFamiliar";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_familiar' => trim($id_familiar)
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

        session()->flash("tipo_form","familiares-tab");

        return redirect()
            ->back()
            ->withSuccess("El familiar del colaborador, fue eliminado con éxito!");
    }

    public function eliminarVehiculo($idColaborador,$id_vehiculo)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."eliminarColaboradorVehiculo";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_vehiculo' => trim($id_vehiculo)
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

        session()->flash("tipo_form","vehiculos-tab");

        return redirect()
            ->back()
            ->withSuccess("El vehiculo del colaborador, fue eliminado con éxito!");
    }

    public function eliminarPermisoConducir($idColaborador,$idPermisoConducir)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."eliminarColaboradorLicenciaConducir";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_licencia_conducir' => trim($idPermisoConducir)
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

        session()->flash("tipo_form","permisoConducir-tab");

        return redirect()
            ->back()
            ->withSuccess("El permiso de conducir del colaborador, fue eliminado con éxito!");
    }

    public function eliminarBanco($idColaborador,$idBanco)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."eliminarColaboradorBanco";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_colaborador_banco' => trim($idBanco)
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
            ->withSuccess("El banco del colaborador, fue eliminado con éxito!");
    }

    public function editarConyugue(Request $request)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."editarTrabajaConyugeColaborador";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($request['idColaborador']),
            'trabaja_conyuge' => trim($request['conyugeDependiente'])
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            return $respuesta['error'];
        }

        return "Dato de conyugue guardado correctamente";
    }

    function revisarConfiguracionColaborador($idColaborador, $idPlanilla){
        $idColaborador = Crypt::decrypt($idColaborador);
        $idPlanilla = Crypt::decrypt($idPlanilla);

        if(($idColaborador > 0) && ($idPlanilla > 0)){
            //Consultar planilla
            $urlColaborador = env("API_DIR")."revisarConfiguracionColaborador";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_colaborador' => $idColaborador,
                'id_planilla' => $idPlanilla
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($urlColaborador, $conjuntoParametros);

            //Si da respuesta de error
            if(isset($respuesta['error'])){
                $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
                $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //Datos de la planilla
            if($respuesta['estado'] == 'ok'){
                $datosDescargar = json_encode($respuesta['info']);
                $resultadoFinal = collect(json_decode( $datosDescargar));
            }

            $conjuntoResultados = [
                'info' => $resultadoFinal
            ];

            return view('colaboradores.colaboradores_revisar_configuracion', $conjuntoResultados);
        }
    }

    public function editarHistorico(Request $request)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."editarColaboradorAuxiliarAguinaldoRenta";
        $array_info = [];
        if(isset($request['historico_aguinaldo']) && is_array($request['historico_aguinaldo'])) {
            foreach ($request['historico_aguinaldo'] as $indice => $valor) {

                $info = [
                    "id_empresa" => session()->get('id_cliente'),
                    "id_colaborador" => trim($request['id_colaborador']),
                    "tipo" => trim($request['tipo']),
                    "anio" => ($indice === 'diciembre' && $request['tipo']=='aguinaldo') ? now()->subYear()->year : now()->year,
                    "mes" => $this->obtenerNumeroMes($indice),
                    "monto" => $valor ?? ""
                ];

                // Agregar el subarray a $array_info
                $array_info[] = $info;
            }
        } else {
            echo "No hay datos históricos de aguinaldo.";
        }
        $array_info = json_encode($array_info);
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'info' => $array_info
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

        session()->flash("tipo_form","historico-tab");

        if($request['tipo']=='renta'){
            session()->flash("tipo_tab_hitorico","renta-tab-btn");
        }
        if($request['tipo']=='aguinaldo'){
            session()->flash("tipo_tab_hitorico","aguinaldo-tab-btn");
        }
        $mensaje_exito=$request['tipo']=="renta"?"Los montos de los meses de renta, fueron agregados con éxito!":"Los montos de los meses del aguinaldo, fueron agregados con éxito!";
        return redirect()
            ->back()
            ->withSuccess($mensaje_exito);
    }
    public function editarHistoricoVacaciones(Request $request)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."editarColaboradorAuxiliarVacaciones";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => session()->get('id_cliente'),
            'id_colaborador' => trim($request['id_colaborador']),
            'vacaciones' => trim($request['vacaciones'])
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

        session()->flash("tipo_form","historico-tab");
        session()->flash("tipo_tab_hitorico","vacaciones-tab-btn");

        return redirect()
            ->back()
            ->withSuccess("Los dias de vacaciones del colaborador, fueron agregados con éxito!");
    }

    public function editarVacaciones(Request $request)
    {
        //eliminar contacto en api
        $url = env("API_DIR")."editarColaboradorVacaciones";
        $array_vacaciones = [];
        if(isset($request['vacaciones']) && is_array($request['vacaciones'])) {
            foreach ($request['vacaciones'] as $indice => $valor) {

                $info = [
                    "rango_anios" => trim( $valor['rango-from'] . '-' . $valor['rango-to'] ) ,
                    "factor" => trim($valor['factor']),
                ];

                // Agregar el subarray a $array_info
                $array_vacaciones[] = $info;
            }
        } else {
            echo "No hay datos vacaciones.";
        }
        $array_info = json_encode($array_vacaciones);
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' =>$request->session()->get('id_cliente'),
            "id_colaborador" => trim($request['id_colaborador']),
            'vacaciones' => $array_info ?? ""
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

        session()->flash("tipo_form","vacaciones-tab");

        return redirect()
            ->back()
            ->withSuccess("Los rangos y factores de las vacaciones , fueron agregados con éxito!");
    }

    public function colaboradores_configuracion(Request $request,$id_colaborador)
    {

        $data=[
            'id_colaborador'=>$id_colaborador
            ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));
        session()->flash("tipo_tab_hitorico",$request->session()->get('tipo_tab_hitorico'));

        return view('colaboradores.configuracion.colaboradores_configuracion',$data);
    }

    public function tab_CCSSINS(Request $request,$id_colaborador)
    {

        $idColaborador=Crypt::decrypt($id_colaborador);

        $catalogoTipoSeguroCCSS= $this->general->obtenerCatalogo("getTiposSeguroCCSS");
        $catalogoOcupacionesCCSS= $this->general->obtenerCatalogo("getOcupacionesCCSS");
        $catalogoNacionalidades= $this->general->obtenerCatalogo("getNacionalidadesINS");
        $catalogoTipoSeguroINS= $this->general->obtenerCatalogo("getTiposSeguroINS");
        $catalogoOcupacionesINS= $this->general->obtenerCatalogo("getOcupacionINS");
        $catalogoJornada= $this->general->obtenerCatalogo("getJornadasTrabajo");

        // dd($catalogoJornada);

        //Obtener datos generales
        $url = env("API_DIR")."getColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

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
                $resultadoColaborador = $resultadoColaborador[0];
            }
        }

        //Obtener los resultados de ins CCSS
        $url = env("API_DIR")."getColaboradorCCSSINS";
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
                $resultadoINSCCSS= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoINSCCSS = collect(json_decode($datosDescargar));
                $resultadoINSCCSS = $resultadoINSCCSS[0];
            }
        }


        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoTipoSeguroCCSS'=>$catalogoTipoSeguroCCSS,
            'catalogoOcupacionesCCSS'=>$catalogoOcupacionesCCSS,
            'catalogoNacionalidades'=>$catalogoNacionalidades,
            'catalogoTipoSeguroINS'=>$catalogoTipoSeguroINS,
            'catalogoOcupacionesINS'=>$catalogoOcupacionesINS,
            'resultadoColaborador' => $resultadoColaborador,
            'resultadoINSCCSS' => $resultadoINSCCSS,
            'catalogoJornada' => $catalogoJornada,
        ];


        session()->flash("tipoForm",$request->session()->get('tipo_form'));
        session()->flash("tipo_tab_hitorico",$request->session()->get('tipo_tab_hitorico'));

        $html=View::make('colaboradores.configuracion.ccss_ins',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);

    }
    public function tab_contactoEmergencia(Request $request,$id_colaborador)
    {
        $idColaborador=Crypt::decrypt($id_colaborador);

        $catalogoParentesco= $this->general->obtenerCatalogo("getParentescos");



        //Obtener contactos de emergencia
        $url = env("API_DIR")."getColaboradorContactos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';
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
                $resultadoContactos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoContactos = collect(json_decode($datosDescargar));
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoParentesco'=>$catalogoParentesco,
            'resultadoContactos' => $resultadoContactos,
           ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.contacto_emergencia',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }
    public function tab_familiares(Request $request,$id_colaborador)
    {
        $idColaborador=Crypt::decrypt($id_colaborador);

        //Obtener familiares
        //1.Dato de contugue
        $url = env("API_DIR")."getTrabajaConyugeColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';
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
                $resultadoConyugue= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoConyugue = collect(json_decode($datosDescargar));
                $resultadoConyugue = $resultadoConyugue[0];
            }
        }

        //2.Dato de hijos
        $url = env("API_DIR")."getColaboradorFamiliares";
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
                $resultadoFamiliares= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoFamiliares = collect(json_decode($datosDescargar));
            }
        }



        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'resultadoConyugue' => $resultadoConyugue,
            'resultadoFamiliares' => $resultadoFamiliares,

        ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.familiares',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }
    public function tab_vehiculos(Request $request,$id_colaborador)
    {
        $idColaborador=Crypt::decrypt($id_colaborador);


        $catalogoTiposVehiculos= $this->general->obtenerCatalogo("getTiposVehiculos");

        //Obtener vehiculos
        $url = env("API_DIR")."getColaboradorVehiculos";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';
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
                $resultadoVehiculos= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoVehiculos = collect(json_decode($datosDescargar));
            }
        }


        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoTiposVehiculos' => $catalogoTiposVehiculos,
            'resultadoVehiculos' => $resultadoVehiculos,
            ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.vehiculos',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);

    }
    public function tab_permisoConducir(Request $request, $id_colaborador)
    {
        $idColaborador=Crypt::decrypt($id_colaborador);

        $catalogoTipoLicencia= $this->general->obtenerCatalogo("getTiposLicenciaConducir");

        //Permisos conducir
        $url = env("API_DIR")."getColaboradorLicenciasConducir";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

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
                $resultadoLicencias= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoLicencias = collect(json_decode($datosDescargar));
            }
        }


        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoTipoLicencia' => $catalogoTipoLicencia,
            'resultadoLicencias' => $resultadoLicencias,
           ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.permisos_conducir',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);

    }
    public function tab_planilla(Request $request ,$id_colaborador)
    {

        $idColaborador=Crypt::decrypt($id_colaborador);

        $catalogoPuestos = $this->general->obtenerCatalogo("getEmpresaPuestos",$request->session()->get('id_cliente'));
        $catalogoDepartamentos = $this->general->obtenerCatalogo("getDepartamentos",$request->session()->get('id_cliente'));
        $catalogoTipoPlanilla= $this->general->obtenerCatalogo("getTiposPlanilla");
        $catalogoMonedas= $this->general->obtenerCatalogo("getMonedas");
        $catalogoTipoTrabajo= $this->general->obtenerCatalogo("getTiposTrabajo");
        $catalogoJornada= $this->general->obtenerCatalogo("getJornadasTrabajo");

        //Planilla
        $url = env("API_DIR")."getColaboradorPlanilla";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

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
                $resultadoPlanillas= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoPlanillas = collect(json_decode($datosDescargar));
                $resultadoPlanillas = $resultadoPlanillas[0];
            }
        }

        $url_impuesto=env("API_DIR")."getImpuestosRenta";
        $parametros_impuestos='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"}';

        //Consulta a la API, servicio getImpuestosRenta
        $respuesta_impuesto=$this->general->consultaApiMedianteBody($tipo, $url_impuesto, $parametros_impuestos);

        if(isset($respuesta_impuesto['error'])){
            return view('errores.error_api', [
                    'detalles'=>$respuesta_impuesto['codigo'],
                    'error'=>$respuesta_impuesto['codigo_error']
                ]);
        }

        if($respuesta_impuesto['estado']=='ok'){
            $datosDescargar=json_encode($respuesta_impuesto['info']);

            $resultadoFinal=collect(json_decode($datosDescargar));
        }

        $conjuntoResultados=[
            'resultado'=>$resultadoFinal[0]
        ];



        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoPuestos' => $catalogoPuestos,
            'catalogoDepartamentos' => $catalogoDepartamentos,
            'catalogoTipoPlanilla' => $catalogoTipoPlanilla,
            'catalogoMonedas' => $catalogoMonedas,
            'catalogoTipoTrabajo' => $catalogoTipoTrabajo,
            'catalogoJornada' => $catalogoJornada,
            'resultadoPlanillas' => $resultadoPlanillas,
            'resultado'=>$resultadoFinal[0],
           ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.planilla',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }
    public function tab_bancos(Request $request, $id_colaborador)
    {

        $idColaborador=Crypt::decrypt($id_colaborador);
        $catalogoMonedas= $this->general->obtenerCatalogo("getMonedas");
        $catalogoBancos= $this->general->obtenerCatalogo("getBancos");
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

        //Obtener datos generales
        $url = env("API_DIR")."getColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

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
                $resultadoColaborador = $resultadoColaborador[0];
            }
        }

        //Bancos
        $url = env("API_DIR")."getColaboradorBancos";
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
                $datosDescargar = json_encode($respuesta['info']);
                $resultadoBancos = collect(json_decode($datosDescargar));
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'catalogoMonedas' => $catalogoMonedas,
            'catalogoBancos' => $catalogoBancos,
            'resultadoBancos' => $resultadoBancos,
            'resultadoColaborador' => $resultadoColaborador,
           ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.bancos',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }
    public function tab_vacaciones(Request $request, $id_colaborador)
    {

        $idColaborador=Crypt::decrypt($id_colaborador);

        //Vacaciones
        $url = env("API_DIR")."getColaboradorVacaciones";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';


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
                $resultadoVacaciones= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoVacaciones = collect(json_decode($datosDescargar));
                $arrayVacaciones = json_decode($resultadoVacaciones[0]->vacaciones);

                if (isset($resultadoVacaciones[0]->vacaciones)) {
                    foreach ($arrayVacaciones ?? [] as $conjuntoDatos) {
                        $numeros = explode("-", $conjuntoDatos->rango_anios);
                        $conjuntoDatos->rango_from =$numeros[0];
                        $conjuntoDatos->rango_to = $numeros[1];
                    }
                }

            }

        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'resultadoVacaciones' => $arrayVacaciones ??"",
            ];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));

        $html=View::make('colaboradores.configuracion.vacaciones',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }

    public function tab_historico(Request $request, $id_colaborador)
    {

        $idColaborador=Crypt::decrypt($id_colaborador);
        $existe_fecha_ingreso=false;
        $aguinaldo_diciembre=false;
        $meses = [];

        //Obtener los resultados de ins CCSS
        $url = env("API_DIR")."getColaboradorCCSSINS";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

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
                $resultadoINSCCSS= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoINSCCSS = collect(json_decode($datosDescargar));
                $resultadoINSCCSS = $resultadoINSCCSS[0];
            }
        }

        $añoActual = Carbon::now()->year;

        // Crear la cadena de parámetros con el año actual
        $parametros = '{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'", "anio": "'.$añoActual.'"}';

        //Historico
        $url = env("API_DIR")."getColaboradorAuxiliarAguinaldoRenta";
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
                $resultadoHistorico= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoHistorico = collect(json_decode($datosDescargar));
            }
        }

        if (!empty($resultadoINSCCSS->fecha_ingreso)) {
            $existe_fecha_ingreso=true;
            $meses = $this->calcularDiferenciaMeses($resultadoINSCCSS->fecha_ingreso);
            // Aquí puedes continuar con el procesamiento de $meses o realizar otras operaciones.
            // Obtener la fecha dada desde la solicitud

            // Crear una instancia de Carbon para la fecha dada
            $anoFechaDada = Carbon::parse($resultadoINSCCSS->fecha_ingreso)->year;

            // Verificar si la diferencia es mayor o igual a 12 meses
            if ($anoFechaDada <= now()->subYear()->year) {
                $aguinaldo_diciembre=true;
            }
        }

        $aguinaldos = [];
        $rentas = [];

        // Separar los elementos según su tipo
        foreach ($resultadoHistorico['auxiliares'] as $elemento) {
            $elemento->mes = $this->obtenerNombreMes( $elemento->mes);
            if ($elemento->tipo == 'aguinaldo') {
                $aguinaldos[] = $elemento;
            } elseif ($elemento->tipo == 'renta') {
                $rentas[] = $elemento;
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'existe_fecha_ingreso'=>$existe_fecha_ingreso,
            'aguinaldo_diciembre'=>$aguinaldo_diciembre,
            'meses'=>$meses,
            'aguinaldos'=>$aguinaldos,
            'vacaciones'=>$resultadoHistorico['vacaciones']??"",
            'rentas'=>$rentas,
            'anioActual'=> now()->year,
            'resultadoHistorico'=>$resultadoHistorico];

        session()->flash("tipoForm",$request->session()->get('tipo_form'));
        $html=View::make('colaboradores.configuracion.historico',$conjuntoResultados)->render();
        //        $js=asset('js/scripts/admin/uiMantenimientoNoticia.js'); // Ajusta la ruta a tu archivo JavaScript

        return response()->json([
            'html'=>$html
        ]);


    }

    public function obtenerNumeroMes($nombreMes)
    {
        // Mapear los nombres de los meses a sus respectivos números
        $meses = [
            'enero' => 1,
            'febrero' => 2,
            'marzo' => 3,
            'abril' => 4,
            'mayo' => 5,
            'junio' => 6,
            'julio' => 7,
            'agosto' => 8,
            'septiembre' => 9,
            'octubre' => 10,
            'noviembre' => 11,
            'diciembre' => 12
        ];

        // Convertir el nombre del mes a minúsculas para hacer la búsqueda insensible a mayúsculas
        $nombreMes = strtolower($nombreMes);

        // Verificar si el nombre del mes existe en el array
        if (array_key_exists($nombreMes, $meses)) {
            // Devolver el número del mes
            return $meses[$nombreMes];
        } else {
            // Si el nombre del mes no existe, puedes devolver un mensaje de error o cualquier valor que desees
            return "Mes no válido";
        }
    }


    public function obtenerNombreMes($numeroMes)
    {
        // Mapear los números de los meses a sus respectivos nombres
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre'
        ];

        // Verificar si el número del mes existe en el array
        if (array_key_exists($numeroMes, $meses)) {
            // Devolver el nombre del mes
            return $meses[$numeroMes];
        } else {
            // Si el número del mes no existe, puedes devolver un mensaje de error o cualquier valor que desees
            return "Número de mes no válido";
        }
    }


    public function calcularDiferenciaMeses($dataFechaIngreso)
    {
        // Crear una instancia de Carbon para la fecha de ingreso
        $fechaDada = Carbon::parse($dataFechaIngreso);

        // Obtener el año actual
        $anioActual = now()->year;

        // Obtener la fecha actual
        $fechaActual = now();

        // Determinar si la fecha de ingreso es del año actual
        $esAnoActual = $fechaDada->year == $anioActual;

        // Establecer la fecha de inicio según la lógica especificada
        $fechaInicio = $esAnoActual ? $fechaDada : Carbon::create($anioActual, 1, 1);

        // Crear un array para almacenar los nombres de los meses
        $meses = [];

        // Iterar desde la fecha de inicio hasta el final del año actual y agregar los nombres de los meses al array
        for ($d = $fechaInicio; $d <= Carbon::create($anioActual, 12, 31); $d->addMonth()) {
            $mes = $d->locale('es-ES')->monthName;
            $meses[] = $mes;
        }

        return $meses;
    }

}
