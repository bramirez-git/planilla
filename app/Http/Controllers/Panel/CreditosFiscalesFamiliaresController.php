<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CreditosFiscalesFamiliaresController extends Controller
{

    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function edit($id)
    {

        //variables a usar en el api
        $url=env("API_DIR")."getCreditosFamiliares";
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

        return view('panel.configuracion.creditosFiscalesFamiliares.creditosFiscalesFamiliares_edit',$conjuntoResultados);
    }

    public function update(Request $request,$id_credito_familiar)
    {
        $id_credito_familiar=Crypt::decrypt($id_credito_familiar);
        $numeros_string=[
            "monto_mensual_hijo"=>trim($request["montoMensualHijo"]),
            "monto_anual_hijo"=>trim($request["montoAnualHijo"]),
            "monto_mensual_conyuge"=>trim($request["montoMensualConyugue"]),
            "monto_anual_conyuge"=>trim($request["montoAnualConyugue"])
        ];
        $array_numeros = array_map(function($numeroString) {
            $numeroFloat = (float) str_replace(',', '', $numeroString);
            return (float) number_format($numeroFloat, 2, '.', '');
        }, $numeros_string);

        //Modificar creditos familiares en api
        $url=env("API_DIR")."editarCreditosFamiliares";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_credito_familiar'=>$id_credito_familiar,
            "monto_mensual_hijo"=>$array_numeros["monto_mensual_hijo"],
            "monto_anual_hijo"=>$array_numeros["monto_anual_hijo"],
            "monto_mensual_conyuge"=>$array_numeros["monto_mensual_conyuge"],
            "monto_anual_conyuge"=>$array_numeros["monto_anual_conyuge"]
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
