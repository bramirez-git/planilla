<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ImpuestosRentaController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function edit(Request $request){
        //variables a usar en el api
        $url=env("API_DIR")."getImpuestosRenta";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            return view('errores.error_api', [
                    'detalles'=>$respuesta['codigo'],
                    'error'=>$respuesta['codigo_error']
                ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){
            $datosDescargar=json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal=collect(json_decode($datosDescargar));
        }

        $conjuntoResultados=[
            'resultado'=>$resultadoFinal[0]
        ];

        return view('panel.configuracion.impuestosRenta.impuestosRenta_edit',$conjuntoResultados);
    }

    public function update(Request $request,$id_impuesto_renta){
        $id_impuesto_renta=Crypt::decrypt($id_impuesto_renta);
        $numeros_string=[
            "tramo1_inicio"=>trim($request["tramo1_inicio"]),
            "tramo1_final"=>trim($request["tramo1_final"]),
            "tarifa1"=>trim($request["tarifa1"]),
            "tramo2_inicio"=>trim($request["tramo2_inicio"]),
            "tramo2_final"=>trim($request["tramo2_final"]),
            "tarifa2"=>trim($request["tarifa2"]),
            "tramo3_inicio"=>trim($request["tramo3_inicio"]),
            "tramo3_final"=>trim($request["tramo3_final"]),
            "tarifa3"=>trim($request["tarifa3"]),
            "tramo4"=>trim($request["tramo4"]),
            "tarifa4"=>trim($request["tarifa4"])
        ];
        $array_numeros = array_map(function($numeroString) {
            $numeroFloat = (float) str_replace(',', '', $numeroString);
            return (float) number_format($numeroFloat, 2, '.', '');
        }, $numeros_string);

        //Modificar Impuesto Renta en api
        $url=env("API_DIR")."editarImpuestosRenta";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_impuesto_renta'=>$id_impuesto_renta,
            "tramo1_inicio"=>trim($array_numeros["tramo1_inicio"]),
            "tramo1_final"=>trim($array_numeros["tramo1_final"]),
            "tarifa1"=>trim($array_numeros["tarifa1"]),
            "tramo2_inicio"=>trim($array_numeros["tramo2_inicio"]),
            "tramo2_final"=>trim($array_numeros["tramo2_final"]),
            "tarifa2"=>trim($array_numeros["tarifa2"]),
            "tramo3_inicio"=>trim($array_numeros["tramo3_inicio"]),
            "tramo3_final"=>trim($array_numeros["tramo3_final"]),
            "tarifa3"=>trim($array_numeros["tarifa3"]),
            "tramo4"=>trim($array_numeros["tramo4"]),
            "tarifa4"=>trim($array_numeros["tarifa4"])
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                'mensaje1'=>$mensaje1,
                'mensaje2'=>$mensaje2
            ]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            return redirect()
                ->back()
                ->withSuccess("Los datos fueron modificados con éxito.");
        }
    }

}
