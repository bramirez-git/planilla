<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Funciones\Generales\funcionesGenerales;
use App\Models\User;
use Illuminate\Http\Request;

class UsuariosPanelController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        //variables a usar en el api
        $url =  env("API_DIR")."getUsuarioPanelAdministrativo";
        // Se guardan variables de búsqueda
        $buscar = "";


        if (isset($request->buscar) && trim($request->buscar) != "") {
            $buscar = $request->buscar;
        
        }

        // Se guardan variables de orden
        $estado = "";
        $tipo_orden = "";

        if (isset($request->estado) && trim($request->estado) != "") {
            $estado = $request->estado;
        }
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave'   => env("API_CLAVE"),
            'buscar'  => $buscar,     
            'estado'  => $estado
        ];

       
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        if(isset($respuesta['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$respuesta['codigo'],
                'error'   =>$respuesta['codigo_error'] ]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
           
            $usuarios = json_encode($respuesta['info']);
            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $usuarios));
            
            $porPagina = request()->get('porPagina', 5);
            $paginaActual = request()->get('page', 1);
              
            $inicio = ($paginaActual - 1) * $porPagina;
            $cantidad = $respuesta['Cantidad'];
           
            return view('panel.usuarios.usuarios_index')->with([
                'usuarios'       => $resultadoFinal->slice($inicio, $porPagina),
                'cantidad'       => $cantidad,
                'porPagina'      => $porPagina,
                'totalRegistros' => $resultadoFinal->count(),
                'paginaActual'   => $paginaActual,
            ]);


        }
    }
    
}
