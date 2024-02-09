<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GenerarPlanillaController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."consultarTiposPlanillaEmpresa";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'"}';

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($respuesta['error']))
        {
            return view('generarPlanilla.generarPlanilla_index')
                ->with(['errorMessage'=>$respuesta['error']]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

        }

        $conjuntoResultados = ['resultado' => $resultadoFinal];

        //dd($conjuntoResultados);
        return view('generarPlanilla.generarPlanilla_index', $conjuntoResultados);
    }

    public function crearPlanilla(Request $request,$id_tipo_planilla,$id_moneda)
    {
        $id_tipo_planilla=Crypt::decrypt($id_tipo_planilla);
        $id_moneda=Crypt::decrypt($id_moneda);
        //Crear colaborador en api
        $url = env("API_DIR")."crearPlanillaEmpresa";

        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_tipo_planilla' => trim($id_tipo_planilla),
            'id_moneda'=>$id_moneda
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
            ->back()
            //->route('generarPlanilla.edit',[Crypt::encrypt($respuesta['info'])])
            ->withSuccess("La planilla fue registrada con éxito!");
    }

    public function show(Request $request, $idPlanilla)
    {
        //consultar planilla
        $url = env("API_DIR")."consultarPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla' => Crypt::decrypt($idPlanilla)
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok'){
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
            $resultadoPlanilla=$resultadoFinal[0];
        }

        //dd($resultadoFinal);

        //Consulta sus colaboradores
        $url = env("API_DIR")."consultarDetallePlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla' => Crypt::decrypt($idPlanilla),
            'pagina' => $request['paginaActual'],
            'cantidad' => $request['cantidad'],
            'buscar' => $request["buscar"],
            'orden' => $request["orden"],
            'tipo_orden' => $request["tipo_orden"],
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok'){
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }

        $conjuntoResultados = [
            'idPlanilla' => $idPlanilla,
            'resultadoPlanilla' => $resultadoPlanilla,
            'resultado' => $resultadoFinal,
            'total' => $respuesta['total_colaboradores'],
            'total_paginas' => $respuesta['total_paginas'],
            'cantidad' => $request["cantidad"],
            'paginaActual' => $request["paginaActual"],
            'buscar' => $request["buscar"],
            'orden' => $request["orden"],
            'tipo_orden' => $request["tipo_orden"],
            'paginacionEditar' => 'si'
        ];
        //dd($conjuntoResultados);

        return view('generarPlanilla.generarPlanilla_show', $conjuntoResultados);
    }

    public function edit(Request $request,$idPlanilla)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        //Consultar planilla
        $url = env("API_DIR")."consultarPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla' => $idPlanilla
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok'){
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
            $resultadoPlanilla=$resultadoFinal[0];
        }

        $fechaInicial = DateTime::createFromFormat('Y-m-d', $resultadoPlanilla->fecha_inicio);
        $fechaFinal = DateTime::createFromFormat('Y-m-d', $resultadoPlanilla->fecha_final);
        $fechaPlanilla = $resultadoPlanilla->nombre_periodo . " (".$resultadoPlanilla->nombre_tipo_planilla;

        if($resultadoPlanilla->adelanto_salario == "no") {
            $fechaPlanilla .= " sin adelanto)";
        }else{
            $fechaPlanilla .= " con adelanto)";
        }

        $planillaTotalNeto = $resultadoPlanilla->planilla_total_neto;
        $planillaTotalDevengado = $resultadoPlanilla->planilla_total_devengado;

        //dd($resultadoPlanilla);

        //se guardan variables de busqueda
        $buscar = "";
        if(isset($request['buscar']) && trim($request['buscar']) != ""){
            $buscar = $request['buscar'];
        }

        //se guardan variables de orden
        $orden = "";
        $tipo_orden = "";

        if(isset($request['orden']) && trim($request['orden']) != "") {
            $orden = $request['orden'];
            $tipo_orden = $request['tipo_orden'];
        }

        $cantidad = 300;
        if(isset($request["cantidad"])){
            $cantidad = $request["cantidad"];
        }

        $paginaActual = 1;
        if(isset($request["pagina"])){
            $paginaActual = $request["pagina"];
        }

        //Consultar correos de comunicacion de la empresa
        $urlComunicacion = env("API_DIR")."getEmpresaComunicacion";
        $conjuntoParametrosComunicacion = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente')
        ];
        $respuestaComunicacion = $this->general->consultaApiMedianteParametros($urlComunicacion, $conjuntoParametrosComunicacion);

        //si da respuesta de error
        if(isset($respuestaComunicacion['error'])){
            $mensaje1 = 'Error: '.$respuestaComunicacion['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuestaComunicacion['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        //si no dio error
        if($respuestaComunicacion['estado'] == 'ok'){
            $datosDescargarComunicacion = json_encode($respuestaComunicacion['info']);
            $resultadoFinalComunicacion = collect(json_decode($datosDescargarComunicacion));

            if(isset($resultadoFinalComunicacion[0]))
            {
                $resultadoComunicacion = $resultadoFinalComunicacion[0];
            }
            else
            {
                $resultadoComunicacion = [];
            }
        }

        //Obtener bancos
        $url = env("API_DIR")."getBancos";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE")
        ];
        $respuestaBancos = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //Si da respuesta de error
        if(isset($respuestaBancos['error'])){
            $mensaje1 = 'Error: '.$respuestaBancos['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuestaBancos['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        //Datos de los bancos
        if($respuestaBancos['estado'] == 'ok'){
            $datosDescargarBancos = json_encode($respuestaBancos['info']);
            $resultadoFinalBancos = collect(json_decode( $datosDescargarBancos));
        }

        $conjuntoResultados = [
            'idPlanilla' => $idPlanilla,
            'infoPlanilla' => $resultadoPlanilla,
            'moneda' => $resultadoPlanilla->moneda,
            'cantidad' => $cantidad,
            'paginaActual' => $paginaActual,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipo_orden,
            'fechaPlanilla' => $fechaPlanilla,
            'planillaTotalNeto' => $planillaTotalNeto,
            'planillaTotalDevengado' => $planillaTotalDevengado,
            'resultadoComunicacion' => $resultadoComunicacion,
            'bancos' => $resultadoFinalBancos
        ];

        //dd($conjuntoResultados);
        return view('generarPlanilla.generarPlanilla_edit',$conjuntoResultados);
    }

    public function update($idPlanilla)
    {
        return redirect()
            ->back()
            ->withSuccess("Datos agregados con éxito!");
    }

    public function destroy(Request $request,$idPlanilla)
    {
        $idPlanilla=Crypt::decrypt($idPlanilla);
        //Eliminar planilla en api
        $url = env("API_DIR")."eliminarPlanilla";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_planilla' => $idPlanilla
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

        return response()->json([
            'success' => true,
            'message' => 'La planilla fue desechada con éxito!',
            'redirect' => route('generarPlanilla.index')
        ]);
    }

    public function registrarPlanilla(Request $request,$idPlanilla)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."cerrarPlanilla";

        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_planilla' => $idPlanilla
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return [$mensaje1,$mensaje2];
        }

        return redirect()
            ->route('generarPlanilla.index')
            ->withSuccess("Planilla cerrada con éxito!");
    }

    public function registrarPlanillaExtras(Request $request)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."ajustePlanillaColaborador";

        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_planilla' => $request['id_planilla'],
            'id_colaborador'=>$request['id_colaborador'],
            'horas_normal'=>$request['horas_normal']??0,
            'horas_extra'=>$request['horas_extra']??0,
            'horas_doble'=>$request['horas_doble']??0,
            'dias_feriados'=>$request['horas_feriado']??0,
            'dias_feriados_no_obligatorios'=>$request['dias_feriados_no_obligatorios']??0,
            'dias_vacaciones'=>0,
            'dias_incapacidad'=>0,
            'ausencias'=>0,
            'permisos'=>0
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return [$mensaje1,$mensaje2];
        }

        return 1;
    }

    public function obtenerDetalleDeducciones(Request $request,$id_planilla,$id_colaborador,$moneda)
    {
        //Consulta sus colaboradores
        //variables a usar en el api
        $url = env("API_DIR")."consultarResumenCalculoPlanilla";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla'=> trim(Crypt::decrypt($id_planilla)),
            'id_colaborador'=>trim($id_colaborador)
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
            $resultadoFinal= $resultadoFinal[0];
        }

        $conjuntoResultados = ['resultado' => $resultadoFinal,'moneda'=>$moneda];

        return view('generarPlanilla.generarPlanilla_detalles',$conjuntoResultados);
    }

    public function obtenerDetalleOtrasDeducciones(Request $request,$id_planilla,$id_colaborador,$totalOtrasDeducciones)
    {
        //Consulta sus colaboradores
        $urlPlanilla = env("API_DIR")."consultarPlanilla";
        $conjuntoParametrosPlanilla = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla'=> trim(Crypt::decrypt($id_planilla))
        ];
        $respuestaPlanilla = $this->general->consultaApiMedianteParametros($urlPlanilla, $conjuntoParametrosPlanilla);

        //si da respuesta de error
        if(isset($respuestaPlanilla['error']))
        {
            $mensaje1 = 'Error: '.$respuestaPlanilla['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuestaPlanilla['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($respuestaPlanilla['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargarPlanilla = json_encode($respuestaPlanilla['info']);

            //lo convierte en colección
            $resultadoFinalPlanilla = collect(json_decode($datosDescargarPlanilla));
            $resultadoFinalPlanilla = $resultadoFinalPlanilla[0];
        }

        //Consulta sus colaboradores
        $url = env("API_DIR")."obtenerOtrosAjustesPlanillaColaborador";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla'=> trim(Crypt::decrypt($id_planilla)),
            'id_colaborador'=>trim($id_colaborador),
            'pagina' => '-1'
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
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
            'resultadoPlanilla' => $resultadoFinalPlanilla,
            'resultado' => $resultadoFinal,
            'id_colaborador' => $id_colaborador,
            'totalOtrasDeducciones' => $totalOtrasDeducciones
        ];
        return view('generarPlanilla.generarPlanilla_otrosDetalles', $conjuntoResultados);
    }

    public function guardarDetalleOtrasDeducciones(Request $request)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."otrosAjustesPlanillaColaborador";

        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_planilla' => $request['id_planilla'],
            'id_colaborador'=>$request['id_colaborador'],
            'id_moneda'=>$request['id_moneda'],
            'tipo'=>$request['tipo'],
            'concepto'=>$request['concepto'],
            'monto'=>$request['monto']
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return [$mensaje1,$mensaje2];
        }

        return 1;
    }

    public function eliminarDetalleOtrasDeducciones(Request $request)
    {
        //Eliminar otros ajustes en api
        if((isset($request['clasificacion'])) && ($request['clasificacion'] == "ajustes")){
            $url = env("API_DIR") . "eliminarOtrosAjustesPlanillaColaborador";
            $conjuntoParametros = [
                'id_empresa' => $request->session()->get('id_cliente'),
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_planilla' => Crypt::decrypt($request['id_planilla']),
                'id_colaborador' => $request['id_colaborador'],
                'id_ajuste' => $request['id_ajuste']
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
        }

        //Cancelar pago de prestamo en api
        if((isset($request['clasificacion'])) && ($request['clasificacion'] == "prestamo")){
            $url = env("API_DIR") . "cancelarAplicacionPagoPrestamo";
            $conjuntoParametros = [
                'id_empresa' => $request->session()->get('id_cliente'),
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_planilla' => Crypt::decrypt($request['id_planilla']),
                'id_colaborador' => $request['id_colaborador'],
                'id_prestamo' => $request['id_prestamo'],
                'id_pago' => $request['id_ajuste']
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
        }

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
            return [$mensaje1,$mensaje2];
        }

        return response()->json(['success'=>true,'url'=> route('generarPlanilla.edit', [$request['id_planilla']])]);
    }

    public function descargarTxtPlanilla(Request $request,$idPlanilla)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        if($request["opcion"]==1)
        {
            //Genera datos de txt banco para descarga
            $url = env("API_DIR") . "generarTxtBancoDetallePlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla,
                "enviar_correo"=>"si",
                "correos" => $request["correo"]
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

            //dd($respuesta);
            //si da respuesta de error
            if (isset($respuesta['error'])) {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //si no dio error
            if ($respuesta['estado'] == 'ok') {

                return back()->withSuccess("Correo enviado exitosamente!");
            }
        }
        else
        {
            //Genera datos de txt banco para descarga
            $url = env("API_DIR") . "generarTxtBancoDetallePlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

            //dd($respuesta);
            //si da respuesta de error
            if (isset($respuesta['error'])) {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoFinal = collect(json_decode($datosDescargar));
                $resultadoTXT = $resultadoFinal[0];
            }


            Storage::disk('local')->put('planillaTxt.txt', file_get_contents($resultadoTXT));


            $path = Storage::path('planillaTxt.txt');


            return response()->download($path);
        }
    }

    public function descargarExcelPlanilla(Request $request,$idPlanilla)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        if($request["opcionExcel"]==1)
        {
            //Genera datos de txt banco para descarga
            $url = env("API_DIR") . "generarExcelDetallePlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla,
                "enviar_correo"=>"si",
                "correos"=>$request["correoExcel"]
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

            //dd($respuesta);
            //si da respuesta de error
            if (isset($respuesta['error'])) {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //si no dio error
            if ($respuesta['estado'] == 'ok') {

                return back()->withSuccess("Correo enviado exitosamente!");
            }
        }
        else
        {
            //Genera datos de excel para descarga
            $url = env("API_DIR")."generarExcelDetallePlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //dd($conjuntoParametros);
            //si da respuesta de error
            if(isset($respuesta['error'])){
                $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
                $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
            }

            //si no dio error
            if($respuesta['estado'] == 'ok'){
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoFinal= collect(json_decode( $datosDescargar));
                $resultadoExcel=$resultadoFinal[0];
            }

            Storage::disk('local')->put('planillaExcel.xlsx', file_get_contents($resultadoExcel));

            $path = Storage::path('planillaExcel.xlsx');

            return response()->download($path);
        }
    }

    function guardarTotalOtrosRubrosIncrementos(Request $request){
        if($request->post("accion") == "guardarOtrosRubros"){
            $id_empresa = session()->get('id_cliente');
            $id_planilla = $request->post("idPlanilla");
            $id_colaborador = $request->post("idColaborador");
            $monto_otros_rubros = $request->post("monto");

            //Guarda monto de otros rubros de incrementos de planilla
            $url = env("API_DIR")."guardarTotalOtrosRubrosIncrementos";
            $conjuntoParametros = [
                'usuario'        => env("API_USUARIO"),
                'clave'          => env("API_CLAVE"),
                'id_empresa'     => $id_empresa,
                'id_planilla'    => $id_planilla,
                'id_colaborador' => $id_colaborador,
                'monto'          => $monto_otros_rubros
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                echo "ok";
            }else{
                echo "error";
            }
        }
        die;
    }

}
