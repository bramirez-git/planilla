<?php

namespace App\Http\Controllers\Panel;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DeduccionesPatronalesController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }
    public function edit(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."getDeduccionesPatronales";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"}';

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

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
        }

        $conjuntoResultados = ['resultado' => $resultadoFinal[0],
                               'data_update'=>$request->session()->get('update')];

        return view('panel.configuracion.deduccionesPatronales.deduccionesPatronales_edit',$conjuntoResultados);
    }

    public function update(Request $request,$id_deduccion_patronal)
    {
        $id_deduccion_patronal=Crypt::decrypt($id_deduccion_patronal);

        //Modificar noticias en api
        $url=env("API_DIR")."editarDeduccionesPatronales";
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_deduccion_patronal'=>$id_deduccion_patronal,
            "ccss_sem"=>trim($request["ccssSEM"]),
            "ivm_patronal"=>trim($request["IVMPatronal"]),
            "asfa"=>trim($request["ASFA"]),
            "cuota_patronal"=>trim($request["CuotaBP"]),
            "imas"=>trim($request["IMAS"]),
            "ina"=>trim($request["INA"]),
            "lpt_patrono"=>trim($request["LPTBPPatrono"]),
            "lpt_obrero"=>trim($request["LPTBPObrero"]),
            "lpt_ins"=>trim($request["LPTINS"]),
            "fcl"=>trim($request["FCL"]),
            "pension"=>trim($request["pensionComplementaria"]),
            "empleado_ccss_sem"=>trim($request["ccssSEMColaborador"]),
            "empleado_ivm"=>trim($request["CCSSIVM"]),
            "empleado_banco"=>trim($request["bancoPopular"])
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
            return redirect()->back()->with([
                'success' => "Los datos fueron modificados con éxito.",
                'update' => $respuesta['info']
            ]);
        }
    }
}
