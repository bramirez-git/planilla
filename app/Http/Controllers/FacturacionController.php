<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Funciones\Seguridad\SecureValue;
use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Generales\Mobile_Detect;
use Illuminate\Support\Facades\View;

class FacturacionController extends Controller
{

    private $general;

    public function __construct(){
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request){
        //Obtener datos de la empresa
        $urlEmpresa = env("API_DIR")."getEmpresa";
        $conjuntoParametrosEmpresa = [
            'usuario' => env("API_USUARIO"),
            'clave'   => env("API_CLAVE"),
            'id_empresa' => $request->session()->get('id_cliente')
        ];
        $respuestaEmpresa = $this->general->consultaApiMedianteParametros($urlEmpresa, $conjuntoParametrosEmpresa);
        if(isset($respuestaEmpresa['error'])){
            return view('facturacion.facturacion_index')->with(['errorMessage' => $respuestaEmpresa['error']]);
        }
        if((isset($respuestaEmpresa["estado"])) && ($respuestaEmpresa["estado"] == 'ok')){
            $resultadoFinalEmpresa = $respuestaEmpresa["info"][0];
        }

        //Obtener datos del estado de cuenta
        $paginaActual = 1;
        if(isset($request["pagina"])){
            $paginaActual = $request["pagina"];
        }
        $cantidad = 300;
        if(isset($request["cantidad"])){
            $cantidad = $request["cantidad"];
        }

        //Fechas
        $fechaInicio = "";
        $fechaFinal  = "";
        if((isset($request->fechaInicial)) && (isset($request->fechaFinal))){
            if((trim($request->fechaInicial) != "") && (trim($request->fechaFinal) != "")){
                $fechaInicio = date("Y-m-d", strtotime(str_replace("/", "-", $request->fechaInicial)));
                $fechaFinal  = date("Y-m-d", strtotime(str_replace("/", "-", $request->fechaFinal)));
            }
        }

        $urlEstadoCuenta = env("API_DIR")."getEstadoCuenta";
        $conjuntoParametrosEstadoCuenta = [
            'usuario'      => env("API_USUARIO"),
            'clave'        => env("API_CLAVE"),
            'id_empresa'   => $request->session()->get('id_cliente'),
            'rango_inicio' => $fechaInicio,
            'rango_final'  => $fechaFinal,
            'pagina'       => $paginaActual,
            'cantidad'     => $cantidad
        ];
        $respuestaEstadoCuenta = $this->general->consultaApiMedianteParametros($urlEstadoCuenta, $conjuntoParametrosEstadoCuenta);
        if(isset($respuestaEstadoCuenta['error'])){
            return view('facturacion.facturacion_index')->with(['errorMessage' => $respuestaEstadoCuenta['error']]);
        }
        if((isset($respuestaEstadoCuenta["estado"])) && ($respuestaEstadoCuenta["estado"] == 'ok')){
            $resultadoEstadoCuenta = $respuestaEstadoCuenta["info"];
            $totalPaginas   = $respuestaEstadoCuenta['total_paginas'];
            $totalRegistros = $respuestaEstadoCuenta['total_registros'];
        }

        $conjuntoResultados = [
            'infoEmpresa'      => $resultadoFinalEmpresa,
            'fechaInicio'      => $fechaInicio,
            'fechaFinal'       => $fechaFinal,
            'infoEstadoCuenta' => $resultadoEstadoCuenta,
            'paginaActual'     => $paginaActual,
            'cantidad'         => $cantidad,
            'total_paginas'    => $totalPaginas,
            'total'            => $totalRegistros
        ];

        return view('facturacion.facturacion_index', $conjuntoResultados);
    }

    public function edit($idCuenta, Request $request){
        $idCuenta = Crypt::decrypt($idCuenta);
        session()->now('payCards', '1');

        //Obtener tipo de cambio del dolar
        $tipoCambioDolar = 0;
        $url = env("API_DIR")."getCambioDolar";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE")
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
        if(isset($respuesta['error'])){
            return view('facturacion.facturacion_edit')->with(['errorMessage' => $respuesta['error']]);
        }
        if((isset($respuesta['estado'])) && ($respuesta['estado'] == 'ok')){
            $datosDescargar  = json_encode($respuesta['info']);
            $resultadoFinal  = collect(json_decode( $datosDescargar, true));
            $tipoCambioDolar = $resultadoFinal[0]["monto"];
        }

        //Obtener datos de la empresa
        $urlEmpresa = env("API_DIR")."getEmpresa";
        $conjuntoParametrosEmpresa = [
            'usuario' => env("API_USUARIO"),
            'clave'   => env("API_CLAVE"),
            'id_empresa' => $request->session()->get("id_cliente")
        ];
        $respuestaEmpresa = $this->general->consultaApiMedianteParametros($urlEmpresa, $conjuntoParametrosEmpresa);
        if(isset($respuestaEmpresa['error'])){
            return view('facturacion.facturacion_edit')->with(['errorMessage' => $respuestaEmpresa['error']]);
        }
        if((isset($respuestaEmpresa["estado"])) && ($respuestaEmpresa["estado"] == "ok")){
            $resultadoFinalEmpresa = $respuestaEmpresa["info"][0];
        }

        //Obtener datos de correos de la empresa
        $urlComunicacion = env("API_DIR")."getEmpresaComunicacion";
        $conjuntoParametrosComunicacion = [
            'usuario' => env("API_USUARIO"),
            'clave'   => env("API_CLAVE"),
            'id_empresa' => $request->session()->get("id_cliente")
        ];
        $respuestaComunicacion = $this->general->consultaApiMedianteParametros($urlComunicacion, $conjuntoParametrosComunicacion);
        if(isset($respuestaComunicacion['error'])){
            return view('facturacion.facturacion_edit')->with(['errorMessage' => $respuestaComunicacion['error']]);
        }
        if((isset($respuestaComunicacion["estado"])) && ($respuestaComunicacion["estado"] == "ok")){
            $resultadoFinalComunicacion = $respuestaComunicacion["info"][0];
        }

        //Verifica si tiene cargo automatico
        $resultadoTarjeta = array();
        if($resultadoFinalEmpresa["cargo_automatico"] == 1){
            //Obtener datos de la empresa
            $urlTarjeta = env("API_DIR")."getEmpresaTarjetas";
            $conjuntoParametrosTarjeta = [
                'usuario' => env("API_USUARIO"),
                'clave'   => env("API_CLAVE"),
                'id_empresa' => $request->session()->get("id_cliente")
            ];
            $respuestaTarjeta = $this->general->consultaApiMedianteParametros($urlTarjeta, $conjuntoParametrosTarjeta);
            if(isset($respuestaTarjeta['error'])){
                return view('facturacion.facturacion_edit')->with(['errorMessage' => $respuestaTarjeta['error']]);
            }
            if((isset($respuestaTarjeta["estado"])) && ($respuestaTarjeta["estado"] == "ok")){
                if(isset($respuestaTarjeta["info"][0]["numero"])){
                    //Formato tarjeta
                    $numeroTarjeta = SecureValue::decode($respuestaTarjeta["info"][0]["numero"], env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
                    $respuestaTarjeta["info"][0]["numero"] = $this->enmascararTarjeta($numeroTarjeta);

                    //Formato fecha expiracion
                    $respuestaTarjeta["info"][0]["fecha_expiracion"] = $this->formatoFechaExpiracion($respuestaTarjeta["info"][0]["fecha_expiracion"]);
                    $resultadoTarjeta = $respuestaTarjeta["info"][0];
                }
            }
        }

        //Consultar facturas pendientes de Planilla Profesional
        $totalFacturasPendientes = 0;
        $urlFacturas = env("API_DIR")."consultarTotalFacturasPendientes";
        $conjuntoParametrosFacturas = [
            'usuario' => env("API_USUARIO"),
            'clave'   => env("API_CLAVE"),
            'id_empresa' => $request->session()->get("id_cliente")
        ];
        $respuestaFacturas = $this->general->consultaApiMedianteParametros($urlFacturas, $conjuntoParametrosFacturas);
        if(isset($respuestaFacturas['error'])){
            return view('facturacion.facturacion_edit')->with(['errorMessage' => $respuestaFacturas['error']]);
        }
        if((isset($respuestaFacturas["estado"])) && ($respuestaFacturas["estado"] == "ok")){
            $totalFacturasPendientes = $respuestaFacturas["info"];
        }

        $conjuntoResultados = [
            'totalFacturasPendientes' => $totalFacturasPendientes,
            'tipoCambioDolar'  => $tipoCambioDolar,
            'infoEmpresa'      => $resultadoFinalEmpresa,
            'infoComunicacion' => $resultadoFinalComunicacion,
            'infoTarjeta'      => $resultadoTarjeta
        ];

        return view('facturacion.facturacion_edit', $conjuntoResultados);
    }

    private function enmascararTarjeta($numTarjeta = ""){
        $nuevoNumTarjeta = "";

        if($numTarjeta != ""){
            $arrayNumTarjeta = str_split($numTarjeta, 4);
            foreach($arrayNumTarjeta as $indice => $parteNumTarjeta){
                if(($indice == 1) || ($indice == 2)){
                    $nuevoNumTarjeta.=  sprintf("%s ", "####");
                }else{
                    $nuevoNumTarjeta.=  sprintf("%s ", $parteNumTarjeta);
                }
            }
            $nuevoNumTarjeta = trim($nuevoNumTarjeta);
        }
        return $nuevoNumTarjeta;
    }

    private function enmascararCodigoSeguridad($codigoTarjeta = ""){
        $nuevoCodigoTarjeta = "";

        if($codigoTarjeta != ""){
            $arrayCodigoTarjeta = str_split($codigoTarjeta);
            foreach($arrayCodigoTarjeta as $indice => $digitoCodigo){

                $nuevoCodigoTarjeta.= $digitoCodigo;
            }
        }
        return $nuevoCodigoTarjeta;
    }

    private function formatoFechaExpiracion($fechaExpiracion = ""){
        $nuevaFechaExpiracion = "";

        if($fechaExpiracion != ""){
            $arrayFechaExpiracion = explode("/", $fechaExpiracion);
            $nuevaFechaExpiracion = sprintf("%s / %s", $arrayFechaExpiracion[0], $arrayFechaExpiracion[1]);
        }
        return $nuevaFechaExpiracion;
    }

    public function update($idCuenta){
        return redirect()->route('facturacion.index')->withSuccess("Se guardaron los datos con éxito!");
    }

    public function pagoEnLinea(Request $request){
        if($request->post("accion") == "pagoRecarga"){
            $modalidad = $request->post("modalidad");

            //Inicializa datos tarjeta
            $nombre_tarjeta = "";
            $numero_tarjeta = "";
            $codigo_tarjeta = "";
            $mes_vence_tarjeta  = "";
            $anio_vence_tarjeta = "";

            //Datos tarjeta (recarga)
            if($modalidad == "recarga"){
                $nombre_tarjeta     = $request->post("inputNombre1");
                $mes_vence_tarjeta  = $request->post("selectMes1");
                $anio_vence_tarjeta = $request->post("selectYear1");

                if(($request->post("inputNumero1") != "") && ($request->post("inputCCV1") != "")){
                    $numero_tarjeta = str_replace(" ", "" , trim($request->post("inputNumero1")));
                    $numero_tarjeta = SecureValue::encode($numero_tarjeta, env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
                    $codigo_tarjeta = SecureValue::encode(trim($request->post("inputCCV1")), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
                }
            }

            //Datos tarjeta (cargo automatico)
            if($modalidad == "cargo_automatico"){
                $nombre_tarjeta     = $request->post("inputNombre2");
                $mes_vence_tarjeta  = $request->post("selectMes2");
                $anio_vence_tarjeta = $request->post("selectYear2");

                if(($request->post("inputNumero2") != "") && ($request->post("inputCCV2") != "")){
                    $numero_tarjeta = str_replace(" ", "" , trim($request->post("inputNumero2")));
                    $numero_tarjeta = SecureValue::encode($numero_tarjeta, env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
                    $codigo_tarjeta = SecureValue::encode(trim($request->post("inputCCV2")), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
                }
            }

            //Realizar pago y recarga
            $url = env("API_DIR")."pagoEnLinea";
            $conjuntoParametros = [
                'usuario'         => env("API_USUARIO"),
                'clave'           => env("API_CLAVE"),
                'id_empresa'      => $request->session()->get("id_cliente"),  //Nota: Id empresa se guarda en campo id_cliente
                'id_usuario'      => $request->session()->get("id_usuario"),
                'modalidad'       => $request->post("modalidad"),
                'tipo_pago'       => $request->post("tipoPago"),
                'cod_banco'       => $request->post("codBanco"),
                'moneda'          => $request->post("monedaPago1"),
                'monto'           => $request->post("montoRecarga"),
                'num_ref'         => $request->post("numeroTransferencia"),
                'nombre_tarjeta'  => $nombre_tarjeta,
                'numero_tarjeta'  => $numero_tarjeta,
                'codigo_tarjeta'  => $codigo_tarjeta,
                'mes_expiracion'  => $mes_vence_tarjeta,
                'anio_expiracion' => $anio_vence_tarjeta,
                'comentarios'     => $request->post("comentarios"),
                'correo'          => $request->post("correoFactura")
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                echo json_encode(array("estado" => $respuesta["estado"], "num_factura" => $respuesta["info"]));
            }else{
                $detalle_error = explode("###", $respuesta["error"]);
                if(isset($detalle_error[1])){
                    echo json_encode(array("estado" => "error", "num_factura" => $detalle_error[0], "msje_error" => $detalle_error[1]));
                }else{
                    echo json_encode(array("estado" => "error", "num_factura" => "", "msje_error" => $detalle_error[0]));
                }
            }
        }
        die;
    }

    public function descargarPdfFactura(Request $request){
        if($request->post("accion") == "descargarPdfFactura"){
            $id_empresa = session()->get('id_cliente');
            $id_recarga = $request->post('id_recarga');

            //Realizar pago y recarga
            $url = env("API_DIR")."obtenerPdfFacturaRecarga";
            $conjuntoParametros = [
                'usuario'    => env("API_USUARIO"),
                'clave'      => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_recarga' => $id_recarga
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                echo json_encode(array("estado" => "ok", "url_pdf" => $respuesta["info"]));
            }else{
                echo json_encode(array("estado" => "error", "url_pdf" => ""));
            }
        }
        die;
    }

    public function descargarXmlFactura(Request $request){
        if($request->post("accion") == "descargarXml"){
            $id_empresa = session()->get('id_cliente');
            $id_recarga = $request->post('id_recarga');

            //Realizar pago y recarga
            $url = env("API_DIR")."obtenerXmlFacturaRecarga";
            $conjuntoParametros = [
                'usuario'    => env("API_USUARIO"),
                'clave'      => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_recarga' => $id_recarga
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                echo json_encode(array("estado" => "ok", "url_xml" => $respuesta["info"]));
            }else{
                echo json_encode(array("estado" => "error", "url_xml" => ""));
            }
        }
        die;
    }

    public function descargarXmlMHFactura(Request $request){
        if($request->post("accion") == "descargarXmlMH"){
            $id_empresa = session()->get('id_cliente');
            $id_recarga = $request->post('id_recarga');

            //Realizar pago y recarga
            $url = env("API_DIR")."obtenerXmlMHFacturaRecarga";
            $conjuntoParametros = [
                'usuario'    => env("API_USUARIO"),
                'clave'      => env("API_CLAVE"),
                'id_empresa' => $id_empresa,
                'id_recarga' => $id_recarga
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                echo json_encode(array("estado" => "ok", "url_xml" => $respuesta["info"]));
            }else{
                echo json_encode(array("estado" => "error", "url_xml" => ""));
            }
        }
        die;
    }

    public function desactivarCargoAutomatico(Request $request){
        if($request->post("accion") == "desactivar"){
            $id_empresa = session()->get('id_cliente');

            //Realizar pago y recarga
            $url = env("API_DIR")."desactivarCargoAutomatico";
            $conjuntoParametros = [
                'usuario'    => env("API_USUARIO"),
                'clave'      => env("API_CLAVE"),
                'id_empresa' => $id_empresa
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

    function pagoFactura(Request $request, $idRecarga = ""){

        if($idRecarga != ""){
            //Informacion de la recarga
            $urlRecarga = env("API_DIR")."getRecarga";
            $conjuntoParametrosRecarga = [
                'usuario' => env("API_USUARIO"),
                'clave'   => env("API_CLAVE"),
                'id_empresa' => $request->session()->get("id_cliente"),
                'id_recarga' => Crypt::decrypt($idRecarga)
            ];
            $respuestaRecarga = $this->general->consultaApiMedianteParametros($urlRecarga, $conjuntoParametrosRecarga);
            if(isset($respuestaRecarga['error'])){
                return view('facturacion.facturacion_pago')->with(['errorMessage' => $respuestaRecarga['error']]);
            }
            if((isset($respuestaRecarga["estado"])) && ($respuestaRecarga["estado"] == "ok")){
                $resultadoFinalRecarga = $respuestaRecarga["info"][0];
            }

            $data = [
                'idRecarga'    => $idRecarga,
                'infoRecarga' => $resultadoFinalRecarga
            ];
            $html = View::make('facturacion.facturacion_pago', $data)->render();
            return response()->json(['html' => $html]);
        }
    }

    public function pagoFacturaPendiente(Request $request){
        if($request->post("accion") == "pagoFactura"){
            //Encripta con clase Secure Value el id de la recarga
            $idRecarga = Crypt::decrypt($request->post("idRecarga"));

            //Datos tarjeta
            $numero_tarjeta     = "";
            $codigo_tarjeta     = "";
            $nombre_tarjeta     = $request->post("inputNombre1");
            $mes_vence_tarjeta  = $request->post("selectMes1");
            $anio_vence_tarjeta = $request->post("selectYear1");
            if(($request->post("inputNumero1") != "") && ($request->post("inputCCV1") != "")){
                $numero_tarjeta = str_replace(" ", "" , trim($request->post("inputNumero1")));
                $numero_tarjeta = SecureValue::encode($numero_tarjeta, env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
                $codigo_tarjeta = SecureValue::encode(trim($request->post("inputCCV1")), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
            }

            //Realizar pago y recarga
            $url = env("API_DIR")."pagoFacturaPendiente";
            $conjuntoParametros = [
                'usuario'         => env("API_USUARIO"),
                'clave'           => env("API_CLAVE"),
                'id_empresa'      => $request->session()->get("id_cliente"),  //Nota: Id empresa se guarda en campo id_cliente
                'id_recarga'      => SecureValue::encode($idRecarga, env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true),
                'moneda'          => $request->post("monedaPago1"),
                'nombre_tarjeta'  => $nombre_tarjeta,
                'numero_tarjeta'  => $numero_tarjeta,
                'codigo_tarjeta'  => $codigo_tarjeta,
                'mes_expiracion'  => $mes_vence_tarjeta,
                'anio_expiracion' => $anio_vence_tarjeta
            ];

            $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);
            if((isset($respuesta["estado"])) && ($respuesta["estado"] == "ok")){
                echo json_encode(array("estado" => $respuesta["estado"], "msje_error" => ""));
            }else{
                echo json_encode(array("estado" => "error", "msje_error" => $respuesta["error"]));
            }
        }
        die;
    }

    function pagoFacturaSinpeMovil(Request $request, $idRecarga = ""){
        if($idRecarga != ""){
            $dispositivo = "";
            $separadorSMS = "&";

            //Detecta dispositivo
            $detectar_dispositivo = new Mobile_Detect();
            if($detectar_dispositivo->isMobile()){
                $dispositivo = "movil";
                $separadorSMS = "?";
                if ($detectar_dispositivo->isAndroidOS()){
                    $separadorSMS = "?";
                }
                if ($detectar_dispositivo->isiOS()){
                    $separadorSMS = "&";
                }
            }else{
                $dispositivo = "otro";
            }

            //Informacion de la recarga
            $urlRecarga = env("API_DIR")."getRecarga";
            $conjuntoParametrosRecarga = [
                'usuario' => env("API_USUARIO"),
                'clave'   => env("API_CLAVE"),
                'id_empresa' => $request->session()->get("id_cliente"),
                'id_recarga' => Crypt::decrypt($idRecarga)
            ];
            $respuestaRecarga = $this->general->consultaApiMedianteParametros($urlRecarga, $conjuntoParametrosRecarga);
            if(isset($respuestaRecarga['error'])){
                return view('facturacion.facturacion_pago_sinpe_movil')->with(['errorMessage' => $respuestaRecarga['error']]);
            }
            $num_factura = "";
            $monto_factura = 0;
            if((isset($respuestaRecarga["estado"])) && ($respuestaRecarga["estado"] == "ok")){
                $num_factura = $respuestaRecarga["info"][0]["num_factura"];
                $monto_factura = $respuestaRecarga["info"][0]["total_colones"];
                $resultadoFinalRecarga = $respuestaRecarga["info"][0];
            }

            $data = [
                'idRecarga'    => $idRecarga,
                'infoRecarga'  => $resultadoFinalRecarga,
                'dispositivo'  => $dispositivo,
                'separadorSMS' => $separadorSMS,
                'monto'        => $monto_factura,
                'factura'      => $num_factura
            ];
            $html = View::make('facturacion.facturacion_pago_sinpe_movil', $data)->render();
            return response()->json(['html' => $html]);
        }
    }

}
