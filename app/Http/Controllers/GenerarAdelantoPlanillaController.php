<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GenerarAdelantoPlanillaController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
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
            $datosDescargar = json_encode($respuesta['info']);
            $resultadoFinal = collect(json_decode( $datosDescargar));
            $resultadoPlanilla = $resultadoFinal[0];
        }
        $fechaPlanilla = $resultadoPlanilla->nombre_periodo;
        $planillaTotalAdelanto = $resultadoPlanilla->planilla_total_adelanto;

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
            "moneda" => $resultadoPlanilla->moneda,
            'cantidad' => $cantidad,
            'paginaActual' => $paginaActual,
            'buscar' => $buscar,
            'orden' => $orden,
            'tipo_orden' => $tipo_orden,
            'fechaPlanilla' => $fechaPlanilla,
            'planillaTotalAdelanto' => $planillaTotalAdelanto,
            'infoPlanilla' => $resultadoPlanilla,
            'resultadoComunicacion' => $resultadoComunicacion,
            'bancos' => $resultadoFinalBancos
        ];

        //dd($conjuntoResultados);
        return view('adelantoPlanilla.adelantoPlanilla_edit',$conjuntoResultados);
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
        $url = env("API_DIR")."consultarAuxiliarPlanilla";
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

        return view('adelantoPlanilla.adelantoPlanilla_show', $conjuntoResultados);
    }

    public function update(Request $request,$idColaborador)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."editarSalarioBaseAuxiliarPlanilla";
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_planilla' => trim($request["id_planilla"]),
            'id_colaborador' => trim($idColaborador),
            'salario' => trim($request['montoSalarioNuevo'.$idColaborador])
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
            ->withSuccess("El salario fue modificado con éxito!");
    }

    public function descargarTxtAdelantoPlanilla(Request $request,$idPlanilla)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        if($request["opcion"]==1)
        {
            //Genera datos de txt banco para descarga
            $url = env("API_DIR") . "generarTxtBancoAuxiliarPlanilla";
            $conjuntoParametros = [
                'usuario' => env("API_USUARIO"),
                'clave' => env("API_CLAVE"),
                'id_empresa' => $request->session()->get('id_cliente'),
                'id_planilla' => $idPlanilla,
                "enviar_correo"=>"si",
                "correos"=>$request["correo"]
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
            $url = env("API_DIR") . "generarTxtBancoAuxiliarPlanilla";
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

    public function descargarExcelAdelantoPlanilla(Request $request,$idPlanilla)
    {
        $idPlanilla = Crypt::decrypt($idPlanilla);

        if($request["opcionExcel"]==1)
        {
            //Genera datos de txt banco para descarga
            $url = env("API_DIR") . "generarExcelAuxiliarPlanilla";
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
            $url = env("API_DIR")."generarExcelAuxiliarPlanilla";
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

    public function registrarAdelantoPlanilla(Request $request,$idPlanilla)
    {
        //Crear colaborador en api
        $url = env("API_DIR")."cerrarAuxiliarPlanilla";

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
            ->withSuccess("Adelanto de planilla cerrada con éxito!");
    }
}
