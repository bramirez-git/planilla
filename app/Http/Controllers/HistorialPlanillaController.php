<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HistorialPlanillaController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function historialPlanillas(Request $request)
    {
        //Pagina
        $paginaActual = 1;
        if(isset($request["pagina"])){
            $paginaActual = $request["pagina"];
        }

        //Cantidad
        $cantidad = 300;
        if(isset($request["cantidad"])){
            $cantidad = $request["cantidad"];
        }

        //Buscador
        $buscar = "";
        if(isset($request['buscar']) && trim($request['buscar']) != "") {
            $buscar = $request['buscar'];
        }

        //Orden
        $orden = "fecha";
        $tipoOrden = "DESC";
        if(isset($request['orden']) && trim($request['orden']) != ""){
            $orden = $request['orden'];
            $tipoOrden = $request['tipo_orden'];
        }

        //Consulta historial de planillas
        $url = env("API_DIR")."consultarHistorialPlanillas";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'pagina' => $paginaActual,
            'cantidad' => $cantidad,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipoOrden
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //En caso de error
        if(isset($respuesta['error'])){
            return view('historialPlanillas.historialPlanillas')->with(['errorMessage' => $respuesta['error']]);
        }

        //Datos del historial de planillas
        $totalPaginas = 0;
        $totalRegistros = 0;
        $resultadoFinal = array();
        if((isset($respuesta['estado'])) && ($respuesta['estado'] == 'ok')){
            $datosDescargar = json_encode($respuesta['info']);
            $resultadoFinal = collect(json_decode( $datosDescargar));
            $totalPaginas = $respuesta['total_paginas'];
            $totalRegistros = $respuesta['total_registros'];
        }

        //Guarda en session datos para el exportar a Excel
        $request->session()->put('sesionBuscadorBuscar', $buscar);
        $request->session()->put('sesionBuscadorOrden', $orden);
        $request->session()->put('sesionBuscadorTipoOrden', $tipoOrden);

        $conjuntoResultados = [
            'paginaActual'=> $paginaActual,
            'cantidad'=> $cantidad,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipoOrden,
            'total_paginas' => $totalPaginas,
            'total' => $totalRegistros,
            'resultado' => $resultadoFinal
        ];

        return view('historialPlanillas.historialPlanillas', $conjuntoResultados);
    }

    public function detalleHistorialPlanilla(Request $request, $idPlanilla = "")
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        if($idPlanilla > 0) {
            //Consulta informacion de planilla
            $urlPlanilla = env("API_DIR") . "consultarPlanilla";
            $conjuntoParametrosPlanilla = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla
            ];
            $respuestaPlanilla = $this->general->consultaApiMedianteParametros($urlPlanilla, $conjuntoParametrosPlanilla);

            //En caso de error
            if(isset($respuestaPlanilla['error'])) {
                return view('historialPlanillas.detalleHistorialPlanilla')->with(['errorMessage' => $respuestaPlanilla['error']]);
            }

            $resultadoPlanilla = array();
            if ((isset($respuestaPlanilla['estado'])) && ($respuestaPlanilla['estado'] == 'ok')) {
                $datosDescargarPlanilla = json_encode($respuestaPlanilla['info']);
                $resultadoFinalPlanilla = collect(json_decode($datosDescargarPlanilla));
                $resultadoPlanilla = $resultadoFinalPlanilla[0];
            }

            //Pagina
            $paginaActual = 1;
            if (isset($request["pagina"])) {
                $paginaActual = $request["pagina"];
            }

            //Cantidad
            $cantidad = 300;
            if (isset($request["cantidad"])) {
                $cantidad = $request["cantidad"];
            }

            //Buscador
            $buscar = "";
            if (isset($request['buscar']) && trim($request['buscar']) != "") {
                $buscar = $request['buscar'];
            }

            //Orden
            $orden = "";
            $tipoOrden = "";
            if (isset($request['orden']) && trim($request['orden']) != "") {
                $orden = $request['orden'];
                $tipoOrden = $request['tipo_orden'];
            }

            //Guarda en session datos para el exportar a Excel
            $request->session()->put('sesionBuscadorBuscar', $buscar);
            $request->session()->put('sesionBuscadorOrden', $orden);
            $request->session()->put('sesionBuscadorTipoOrden', $tipoOrden);

            //Nombre de la planilla
            $fechaPlanilla = $resultadoPlanilla->nombre_periodo . " (".$resultadoPlanilla->nombre_tipo_planilla;
            if($resultadoPlanilla->adelanto_salario == "no") {
                $fechaPlanilla .= " sin adelanto)";
            }else{
                $fechaPlanilla .= " con adelanto)";
            }

            $conjuntoResultados = [
                'idPlanilla' => $idPlanilla,
                'paginaActual' => $paginaActual,
                'cantidad' => $cantidad,
                'buscar' => $buscar,
                'orden' => $orden,
                'tipo_orden' => $tipoOrden,
                'resultadoPlanilla' => $resultadoPlanilla,
                'paginacionEditar' => 'si',
                'fechaPlanilla' => $fechaPlanilla
            ];
        }

        return view('historialPlanillas.detalleHistorialPlanilla', $conjuntoResultados);
    }

    public function historialPlanilla_show(Request $request,$id_planilla)
    {
        //$idPlanilla = Crypt::decrypt($_POST["id_planilla"]);
        $idPlanilla = Crypt::decrypt($id_planilla);

        //Consultar planilla
        $url = env("API_DIR")."consultarPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla' => $idPlanilla
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

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
            $resultadoPlanilla = $resultadoFinal[0];
        }

        //Consulta colaboradores de la planilla
        $url = env("API_DIR")."consultarDetallePlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla' => $idPlanilla,
            'pagina' => $request['paginaActual'],
            'cantidad' => $request['cantidad'],
            'buscar' => $request["buscar"],
            'orden' => $request["orden"],
            'tipo_orden' => $request["tipo_orden"],
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //Si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        //Datos de los colaboradores de la planilla
        if($respuesta['estado'] == 'ok'){
            $datosDescargar = json_encode($respuesta['info']);
            $resultadoFinal = collect(json_decode( $datosDescargar));
        }

        $conjuntoResultados = [
            'idPlanilla' => $idPlanilla,
            'resultado' => $resultadoFinal,
            'resultadoPlanilla' => $resultadoPlanilla,
            'total' => $respuesta['total_colaboradores'],
            'total_paginas' => $respuesta['total_paginas'],
            'cantidad' => $request["cantidad"],
            'paginaActual' => $request["paginaActual"],
            'buscar' => $request["buscar"],
            'orden' => $request["orden"],
            'tipo_orden' => $request["tipo_orden"],
            'paginacionEditar' => 'si'
        ];

        return view('historialPlanillas.historialPlanillas_show', $conjuntoResultados);
    }

    public function historialPlanillas_resumen(Request $request, $idPlanilla, $idColaborador)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);
        $idColaborador = Crypt::decrypt($idColaborador);
        $conjuntoResultados = array();

        if(($idPlanilla > 0) && ($idColaborador > 0)){
            //Consultar planilla
            $urlPlanilla = env("API_DIR")."consultarPlanilla";
            $conjuntoParametrosPlanilla = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla
            ];
            $respuestaPlanilla = $this->general->consultaApiMedianteParametros($urlPlanilla, $conjuntoParametrosPlanilla);

            //Si da respuesta de error
            if(isset($respuestaPlanilla['error'])){
                $mensaje1 = 'Error: '.$respuestaPlanilla['codigo'].' ';
                $mensaje2 = 'Detalles: '.$respuestaPlanilla['error'].' ';
                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //Datos de la planilla
            if($respuestaPlanilla['estado'] == 'ok'){
                $datosDescargarPlanilla = json_encode($respuestaPlanilla['info']);
                $resultadoFinalPlanilla = collect(json_decode( $datosDescargarPlanilla));
                $resultadoPlanilla = $resultadoFinalPlanilla[0];
            }

            //Consultar detalle planilla
            $urlDetallePlanilla = env("API_DIR")."consultarResumenCalculoPlanilla";
            $conjuntoParametrosDetallePlanilla = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla,
                'id_colaborador' => $idColaborador
            ];
            $respuestaDetallePlanilla = $this->general->consultaApiMedianteParametros($urlDetallePlanilla, $conjuntoParametrosDetallePlanilla);

            //Si da respuesta de error
            if(isset($respuestaDetallePlanilla['error'])){
                $mensaje1 = 'Error: '.$respuestaDetallePlanilla['codigo'].' ';
                $mensaje2 = 'Detalles: '.$respuestaDetallePlanilla['error'].' ';
                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //Datos detalle de la planilla
            if($respuestaDetallePlanilla['estado'] == 'ok'){
                $datosDescargarDetalle = json_encode($respuestaDetallePlanilla['info']);
                $resultadoFinalDetalle = collect(json_decode( $datosDescargarDetalle));
                $resultadoDetalle = $resultadoFinalDetalle[0];
            }

            //Consultar otros incrementos y deducciones de planilla
            $urlDetalleOtros = env("API_DIR")."obtenerOtrosAjustesPlanillaColaborador";
            $conjuntoParametrosDetalleOtros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla,
                'id_colaborador' => $idColaborador
            ];
            $respuestaDetalleOtros = $this->general->consultaApiMedianteParametros($urlDetalleOtros, $conjuntoParametrosDetalleOtros);

            //Si da respuesta de error
            if(isset($respuestaDetalleOtros['error'])){
                $mensaje1 = 'Error: '.$respuestaDetalleOtros['codigo'].' ';
                $mensaje2 = 'Detalles: '.$respuestaDetalleOtros['error'].' ';
                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }

            //Datos detalle de la planilla
            if($respuestaDetalleOtros['estado'] == 'ok'){
                $datosDescargarDetalleOtros = json_encode($respuestaDetalleOtros['info']);
                $resultadoFinalDetalleOtros = collect(json_decode( $datosDescargarDetalleOtros));
            }

            $conjuntoResultados = [
                'idPlanilla' => $idPlanilla,
                'resultadoPlanilla' => $resultadoPlanilla,
                'resultadoDetalle' => $resultadoDetalle,
                'resultadoOtros' => $resultadoFinalDetalleOtros
            ];
        }

        return view('historialPlanillas.historialPlanillas_resumen', $conjuntoResultados);
    }

    public function descargaArchivoBancario(Request $request, $idPlanilla)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        //Informacion planilla
        $url = env("API_DIR")."consultarPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_planilla' => $idPlanilla
        ];
        $respuestaPlanilla = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //Si da respuesta de error
        if(isset($respuestaPlanilla['error'])){
            $mensaje1 = 'Error: '.$respuestaPlanilla['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuestaPlanilla['error'].' ';
            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        //Datos de la planilla
        if($respuestaPlanilla['estado'] == 'ok'){
            $datosDescargarPlanilla = json_encode($respuestaPlanilla['info']);
            $infoPlanilla = collect(json_decode($datosDescargarPlanilla));
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

        //Datos de la planilla
        if($respuestaBancos['estado'] == 'ok'){
            $datosDescargarBancos = json_encode($respuestaBancos['info']);
            $resultadoFinalBancos = collect(json_decode( $datosDescargarBancos));
        }

        $conjuntoResultados = array(
            "idPlanilla" => $idPlanilla,
            "infoPlanilla" => $infoPlanilla[0],
            "bancos" => $resultadoFinalBancos
        );
        return view('historialPlanillas.descarga_archivo_bancario', $conjuntoResultados);
    }

    public function exportarArchivoTxtBancoHistorialPlanilla(Request $request)
    {
        if((isset($_POST["id_planilla"])) && ($_POST["id_planilla"] != "")){
            $id_empresa = $request->session()->get("id_cliente");
            $id_planilla = Crypt::decrypt($_POST["id_planilla"]);

            //Banco
            $id_banco = 0;
            if((isset($_POST["id_banco"])) && ($_POST["id_banco"] > 0)){
                $id_banco = $_POST["id_banco"];
            }

            //Descargar archivo txt del banco de la planilla
            $url = env("API_DIR")."generarTxtBancoDetallePlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_planilla' => $id_planilla,
                'id_banco' => $id_banco
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Archivo txt del banco historial de planillas
            $url_txt_banco_planilla = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_txt_banco_planilla = $respuesta["info"];
                }
            }

            return $url_txt_banco_planilla;
        }
    }

    public function exportarExcelHistorialPlanillas(Request $request)
    {
        if((isset($_POST["accion"])) && ($_POST["accion"] == "descargar_excel_historial_planilla")){
            $id_empresa = $request->session()->get("id_cliente");

            //Datos del buscador y orden
            $buscar = $request->session()->get('sesionBuscadorBuscar');
            $orden  = $request->session()->get('sesionBuscadorOrden');
            $tipoOrden = $request->session()->get('sesionBuscadorTipoOrden');

            //Descargar pdf del prestamo
            $url = env("API_DIR")."exportarExcelHistorialPlanillas";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'buscar' => $buscar,
                'orden' => $orden,
                'tipo_orden' => $tipoOrden
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Url del excel del historial de planillas
            $url_excel_planilla = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_excel_planilla = $respuesta["info"];
                }
            }

            return $url_excel_planilla;
        }
    }

    public function exportarExcelDetalleHistorialPlanilla(Request $request)
    {
        if((isset($_POST["id_planilla"])) && ($_POST["id_planilla"] != "")){
            $id_empresa = $request->session()->get("id_cliente");
            $id_planilla = Crypt::decrypt($_POST["id_planilla"]);

            //Datos del buscador y orden
            $buscar = $request->session()->get('sesionBuscadorBuscar');
            $orden  = $request->session()->get('sesionBuscadorOrden');
            $tipoOrden = $request->session()->get('sesionBuscadorTipoOrden');

            //Descargar pdf del detalle de la planilla
            $url = env("API_DIR")."generarExcelDetallePlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_planilla' => $id_planilla,
                'buscar' => $buscar,
                'orden' => $orden,
                'tipo_orden' => $tipoOrden
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Url del excel del historial de planillas
            $url_excel_detalle_planilla = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_excel_detalle_planilla = $respuesta["info"];
                }
            }

            return $url_excel_detalle_planilla;
        }
    }

}
