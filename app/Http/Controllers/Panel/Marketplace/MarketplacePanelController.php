<?php

namespace App\Http\Controllers\Panel\Marketplace;

use App\Http\Controllers\Controller;
use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;

class MarketplacePanelController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {        
        //variables a usar en el api
        $url =  env("API_DIR")."getMarketplace";
        $tipo = "POST";
        // Se guardan variables de búsqueda
        $buscar = "";

        
        if (isset($request->buscar) && trim($request->buscar) != "") {
            $buscar = $request->buscar;
           
        }

        // Se guardan variables de orden
        $orden = "";
        $tipo_orden = "";

        if (isset($request->orden) && trim($request->orden) != "") {
            $orden = $request->orden;
            $tipo_orden = $request->tipo_orden;
        }
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'buscar' => $buscar,     
            'orden' => $orden,    
            'tipo_orden' => $tipo_orden   
        ];
        
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

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
            $cantidadProductos = json_encode($respuesta['Cantidad']);

        }

        $porPagina = request()->get('porPagina', 5);
        $paginaActual = request()->get('page', 1);
        
        $inicio = ($paginaActual - 1) * $porPagina;
        
        $conjuntoResultados = [
            'resultado'      => $resultadoFinal->slice($inicio, $porPagina),
            'cantidad'       => $cantidadProductos,
            'porPagina'      => $porPagina,
            'totalRegistros' => $resultadoFinal->count(),
            'paginaActual'   => $paginaActual,
            'buscar'         => $buscar,
            'orden'          => $orden,
            'tipo_orden'     => $tipo_orden,
        ];
        

        return view('panel.marketplace.marketplace_index',$conjuntoResultados);
    }


    public function descargar_excel(Request $request){
        //Genera datos de excel
        $url = env("API_DIR")."exportarExcelMarketplace";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'buscar' => isset($request['buscar']) ? $request['buscar'] : '',
            'orden' => isset($request['orden']) ? $request['orden'] : '',
            'tipo_orden' => isset($request['tipo_orden']) ? $request['tipo_orden'] : '',
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
