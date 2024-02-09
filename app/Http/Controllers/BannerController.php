<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Http;
use App\Funciones\Generales\funcionesGenerales;

class BannerController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }


    public function updateBanner(Request $request)
    {
        $directorio = base_path().'/public/img/imagenesBanner/';
        
        $url =  env("API_DIR")."banner";

        $conjuntoParametros = [
            'usuario'    => env("API_USUARIO"),
            'clave'      => env("API_CLAVE"),
            'directorio' => $directorio
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
            $banners = $respuesta['info'];
            return $banners;

        }

    }


    public function obtenerBanner()
    {
        $url =  env("API_DIR")."obtenerBanner";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE")
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
            $banners = $respuesta['info'];
            return $banners;

        }


    }
}
