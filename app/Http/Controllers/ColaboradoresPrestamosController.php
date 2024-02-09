<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class ColaboradoresPrestamosController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);

        //Obtener datos generales
        $url = env("API_DIR")."getColaborador";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_colaborador' => $id_colaborador
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            if($respuesta['codigo'] != "error_registro"){
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }else{
                $resultadoColaborador= [];
            }
        }else{
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                $datosDescargar = json_encode($respuesta['info']);
                $resultadoColaborador = collect(json_decode($datosDescargar));
                $resultadoColaborador = $resultadoColaborador[0];
            }
        }

        //---------------------------------------------- Prestamos ------------------------------------------------

        //variables a usar en el api
        $url = env("API_DIR")."getColaboradorPrestamos";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_colaborador' => $id_colaborador
        ];

        //se guardan variables de busqueda
        $buscar = "";
        if(isset($request['buscar']) && trim($request['buscar']) != ""){
            $buscar = $request['buscar'];
            $conjuntoParametros["buscar"] = $buscar;
        }

        //se guardan variables de orden
        $orden = "";
        $tipo_orden = "";
        if(isset($request['orden']) && trim($request['orden']) != ""){
            $orden = $request['orden'];
            $tipo_orden = $request['tipo_orden'];
            $conjuntoParametros["orden"] = $orden;
            $conjuntoParametros["tipo_orden"] = $tipo_orden;
        }

        $paginaActual = 1;
        if(isset($request["pagina"])){
            $conjuntoParametros["pagina"] = $request["pagina"];
            $paginaActual = $request["pagina"];
        }

        $cantidad = 300;
        if(isset($request["cantidad"])){
            $conjuntoParametros["cantidad"] = $request["cantidad"];
            $cantidad = $request["cantidad"];
        }

        //Se consume el api
        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
        if(isset($respuesta['error'])){
            return view('errores.error_api', ['detalles' =>$respuesta['codigo'], 'error' => $respuesta['codigo_error']]);
        }

        //Si no dio error
        if($respuesta['estado'] == 'ok'){
            $datosDescargar = json_encode($respuesta['info']);
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }

        //Guarda en session datos para el exportar a Excel
        $request->session()->put('sesionBuscadorBuscar', $buscar);
        $request->session()->put('sesionBuscadorOrden', $orden);
        $request->session()->put('sesionBuscadorTipoOrden', $tipo_orden);

        $conjuntoResultados = [
            'idColaborador' => $request["id_colaborador"],
            'resultadoColaborador' => $resultadoColaborador,
            'resultado' => $resultadoFinal,
            'buscar'=> $buscar,
            'orden'=> $orden,
            'tipo_orden' => $tipo_orden,
            'total' => $respuesta['total_prestamos'],
            'total_paginas' => $respuesta['total_paginas'],
            'cantidad'=> $cantidad,
            'paginaActual' => $paginaActual
        ];

        return view('colaboradores.prestamos.colaboradoresPrestamos_index', $conjuntoResultados);
    }

    public function create(Request $request)
    {
        //Id colaborador
        $idColaborador = trim($_GET["id_colaborador"]);

        //Consulta configuracion colaborador planilla
        $url = env("API_DIR")."getColaboradorPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => Crypt::decrypt($idColaborador)
        ];
        $idMoneda = 0;
        $nombreMoneda = "";
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
        if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")) {
            if((isset($respuesta["info"][0]["id_moneda"])) && ($respuesta["info"][0]["id_moneda"] > 0) &&
               (isset($respuesta["info"][0]["nombre_moneda"])) && ($respuesta["info"][0]["nombre_moneda"] != "")){
                $idMoneda = $respuesta["info"][0]["id_moneda"];
                $nombreMoneda = $respuesta["info"][0]["nombre_moneda"];
            }
        }

        //Consulta configuracion empresa planilla
        $url = env("API_DIR")."getEmpresaPlanilla";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente')
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //Verifica si permite pago en tractos (planilla mensual con adelanto)
        $permite_pago_tractos = "no";
        if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
            if((isset($respuesta["info"][0]["tipos_planilla"])) && ($respuesta["info"][0]["tipos_planilla"] != "")){
                if(in_array("NME", explode(",", $respuesta["info"][0]["tipos_planilla"]))){  //Planilla mensual
                    if((isset($respuesta["info"][0]["tipo_pago"])) && ($respuesta["info"][0]["tipo_pago"] != "")){
                        if($respuesta["info"][0]["tipo_pago"] == "CAD"){  //Planilla con adelanto de salario
                            $permite_pago_tractos = "si";
                        }
                    }
                }
            }
        }

        //Obtiene configuracion prestamos (tasa interes y cantidad cuotas)
        $tasa_interes_minima = 0;
        $cantidad_maxima_cuotas = 0;
        if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")) {
            if ((isset($respuesta["info"][0]["prestamos"])) && ($respuesta["info"][0]["prestamos"] == 1)) {
                $tasa_interes_minima = $respuesta["info"][0]["prestamos_tasa"];
                $cantidad_maxima_cuotas = $respuesta["info"][0]["prestamos_cuotas"];
            }
        }

        $conjuntoParametros = [
            'idColaborador' => $_GET["id_colaborador"],
            'idMoneda' => $idMoneda,
            'nombreMoneda' => $nombreMoneda,
            'permite_pago_tractos' => $permite_pago_tractos,
            'min_tasa_prestamos' => $tasa_interes_minima,
            'max_cuotas_prestamos' => $cantidad_maxima_cuotas
        ];

        return view('colaboradores.prestamos.colaboradoresPrestamos_create', $conjuntoParametros);
    }

    public function store(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);

        //Crear prestamo en api
        $url = env("API_DIR")."crearColaboradorPrestamo";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_colaborador' => $id_colaborador,
            'concepto' => trim($request['conceptoPrestamo']),
            'id_moneda' => trim($request["monedaPrestamo"]),
            'monto' => trim($request['montoPrestamo']),
            'tasa_interes' => trim($request['tasaInteres']),
            'cantidad_cuotas' => trim($request['cantidadCuotas']),
            'fecha_inicio' => Carbon::createFromFormat('d/m/Y', trim($request['fechaInicio']))->format('Y-m-d'),
            'monto_cuota' => trim($request['cuotaMensual']),
            'descripcion' => trim($request['descripcionPrestamo'])
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->route('colaboradoresPrestamos.index', ['id_colaborador' => $request['id_colaborador']])
            ->withSuccess("Se registró el préstamo con éxito!");
    }

    public function show(Request $request, $idColaborador, $idPrestamo)
    {
        $id_colaborador = Crypt::decrypt($idColaborador);
        $id_prestamo = Crypt::decrypt($idPrestamo);

        //Obtener datos del prestamo en api
        $urlPrestamo = env("API_DIR")."getColaboradorPrestamo";
        $conjuntoParametrosPrestamo = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente'),
            'id_colaborador' => $id_colaborador,
            'id_prestamo' => $id_prestamo
        ];
        $respuestaPrestamo = $this->general->consultaApiMedianteParametros($urlPrestamo, $conjuntoParametrosPrestamo);

        //Respuesta prestamo
        if(isset($respuestaPrestamo['error'])){
            return view('errores.error_api', ['detalles' => $respuestaPrestamo['codigo'], 'error' => $respuestaPrestamo['codigo_error'] ]);
        }
        if($respuestaPrestamo['estado'] == 'ok'){
            $datosDescargarPrestamo = json_encode($respuestaPrestamo['info']);
            $resultadoFinalPrestamo = collect(json_decode( $datosDescargarPrestamo));
        }

        //Obtener datos de amortizacion del prestamo en api
        $urlPagos = env("API_DIR")."getTablaAmortizacionPrestamo";
        $conjuntoParametrosPagos = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => $id_colaborador,
            'id_prestamo' => $id_prestamo
        ];
        $respuestaPagos = $this->general->consultaApiMedianteParametros($urlPagos, $conjuntoParametrosPagos);

        //Respuesta pagos
        if(isset($respuestaPagos['error'])){
            return view('errores.error_api', ['detalles' => $respuestaPagos['codigo'], 'error' => $respuestaPagos['codigo_error'] ]);
        }
        if($respuestaPagos['estado'] == 'ok'){
            $datosDescargarPagos = json_encode($respuestaPagos['info']);
            $resultadoFinalPagos = collect(json_decode($datosDescargarPagos));
        }

        //Obtener datos de amortizacion proyectada del prestamo en api
        $urlPagosProyectados = env("API_DIR")."getProyeccionTablaAmortizacion";
        $conjuntoParametrosPagosProyectados = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'monto' => $resultadoFinalPrestamo[0]->monto,
            'interes_anual' => $resultadoFinalPrestamo[0]->tasa_interes,
            'total_cuotas' => $resultadoFinalPrestamo[0]->cantidad_cuotas,
        ];
        $respuestaPagosProyectados = $this->general->consultaApiMedianteParametros($urlPagosProyectados, $conjuntoParametrosPagosProyectados);

        //Respuesta tabla amortizacion proyectada
        if(isset($respuestaPagosProyectados['error'])){
            return view('errores.error_api', ['detalles' => $respuestaPagosProyectados['codigo'], 'error' => $respuestaPagosProyectados['codigo_error'] ]);
        }
        if($respuestaPagosProyectados['estado'] == 'ok'){
            $datosDescargarPagosProyectados = json_encode($respuestaPagosProyectados['info']);
            $resultadoFinalPagosProyectados = collect(json_decode($datosDescargarPagosProyectados));
        }

        //Resumen pagos realizados
        $total_pagos_realizados  = 0;
        $total_intereses_pagados = 0;
        $saldo_pendiente = 0;
        if((isset($resultadoFinalPagos)) && ($resultadoFinalPagos != null)){
            foreach($resultadoFinalPagos as $info_pago){
                $total_pagos_realizados++;
                $total_intereses_pagados+= $info_pago->monto_interes;
                $saldo_pendiente = $info_pago->saldo_actual;
            }
        }

        //Saldo pendiente
        if($total_pagos_realizados == 0){
            if((isset($resultadoFinalPrestamo[0]->monto)) && ($resultadoFinalPrestamo[0]->monto > 0)){
                $saldo_pendiente = $resultadoFinalPrestamo[0]->monto;
            }
        }

        $conjuntoResultados = [
            'idColaborador' => $idColaborador,
            'idPrestamo' => $idPrestamo,
            'prestamo' => $resultadoFinalPrestamo[0],
            'pagos' => $resultadoFinalPagos,
            'pagos_proyeccion' => $resultadoFinalPagosProyectados,
            'saldo_pendiente' => $saldo_pendiente,
            'total_pagos_realizados' => $total_pagos_realizados,
            'total_intereses_pagados' => $total_intereses_pagados
        ];
        return view('colaboradores.prestamos.colaboradoresPrestamos_show', $conjuntoResultados);
    }

    public function aplicarAbonoExtraPrestamo(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        $id_prestamo = Crypt::decrypt($request["id_prestamo"]);

        //Registrar abono extra en api
        $url = env("API_DIR")."registrarAbonoExtraPrestamo";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => $id_colaborador,
            'id_prestamo' => $id_prestamo,
            'monto_abono' => trim($request['montoAbono']),
            'fecha_abono' => date("Y-m-d", strtotime(trim($request['fechaAbono']))),
            'comprobante' => trim($request['numComprobante'])
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return redirect()
            ->route('verDetallePrestamo', [$request["id_colaborador"], $request["id_prestamo"]])
            ->withSuccess("Se registró el abono extra con éxito!");
    }

    public function calcularCuotaMensualPrestamo()
    {
        if((isset($_POST["monto"])) && (isset($_POST["cuotas"])) && (isset($_POST["tasa_interes"]))){
            $monto = $_POST["monto"];
            $cuotas = $_POST["cuotas"];
            $tasa = $_POST["tasa_interes"];

            //Calculo de la cuota mensual
            $url = env("API_DIR")."calcularCuotaMensualPrestamo";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'monto' => $monto,
                'interes_anual' => $tasa,
                'total_cuotas' => $cuotas
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Determina cuota mensual
            $cuota_mensual = 0;
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] > 0)){
                    $cuota_mensual = $respuesta["info"];
                }
            }

            return $cuota_mensual;
        }
    }

    public function descargarExcelPrestamos(Request $request)
    {
        if(isset($_POST["id_colaborador"])){
            $id_empresa = $request->session()->get("id_cliente");
            $id_colaborador = Crypt::decrypt($_POST["id_colaborador"]);

            //Datos del buscador y orden
            $buscar = $request->session()->get('sesionBuscadorBuscar');
            $orden  = $request->session()->get('sesionBuscadorOrden');
            $tipo_orden = $request->session()->get('sesionBuscadorTipoOrden');

            //Descargar pdf del prestamo
            $url = env("API_DIR")."exportarExcelPrestamosColaborador";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_colaborador' => $id_colaborador,
                'buscar' => $buscar,
                'orden' => $orden,
                'tipo_orden' => $tipo_orden
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Url del excel de los prestamos
            $url_excel_prestamos = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_excel_prestamos = $respuesta["info"];
                }
            }

            return $url_excel_prestamos;
        }
    }

    public function descargarExcelTablaAmortizacionProyectada(Request $request)
    {
        if((isset($_POST["monto"])) && (isset($_POST["interes_anual"])) && (isset($_POST["total_cuotas"]))){
            //Descargar excel de la tabla de amortizacion proyectada del prestamo
            $url = env("API_DIR")."exportarExcelTablaProyeccionPagosPrestamo";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'monto' => $_POST["monto"],
                'interes_anual' => $_POST["interes_anual"],
                'total_cuotas' => $_POST["total_cuotas"]
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Url del excel de los prestamos
            $url_excel_amortizacion_proyectada = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_excel_amortizacion_proyectada = $respuesta["info"];
                }
            }

            return $url_excel_amortizacion_proyectada;
        }
    }

    public function descargarPdfPrestamo(Request $request)
    {
        if((isset($_POST["id_colaborador"])) && (isset($_POST["id_prestamo"]))){
            $id_empresa = $request->session()->get("id_cliente");
            $id_colaborador = Crypt::decrypt($_POST["id_colaborador"]);
            $id_prestamo = Crypt::decrypt($_POST["id_prestamo"]);

            //Descargar pdf del prestamo
            $url = env("API_DIR")."generarPdfColaboradorPrestamo";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_colaborador' => $id_colaborador,
                'id_prestamo' => $id_prestamo
            ];
            $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

            //Url del pdf del prestamo
            $url_pdf_prestamo = "";
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                if ((isset($respuesta["info"])) && ($respuesta["info"] != "")){
                    $url_pdf_prestamo = $respuesta["info"];
                }
            }

            return $url_pdf_prestamo;
        }
    }

}
