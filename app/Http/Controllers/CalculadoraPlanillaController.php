<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;

class CalculadoraPlanillaController extends Controller{
    private $general;

    public function __construct(){
        $this->general=new funcionesGenerales();
    }

    public function index(Request $request){

        $conjuntoResultados=['resultado'=>$request->session()->get('resultado')];

        return view('calculadora', $conjuntoResultados);
    }

    public function show(Request $request){

        //variables a usar en el api
        $url=env("API_DIR")."calculadoraSalarial";
        //      $url="http://localhost/dev_api/public/calculadoraSalarial";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        if(is_array($request['data'])){

            $data=$request['data'];

            $numeros_string=[
                "salario"=>trim($data['salario']),
                "monto_prestamos"=>trim($data['monto_prestamos']),
                "monto_embargos"=>trim($data["monto_embargos"]),
                "monto_pensiones"=>trim($data["monto_pensiones"]),
                "total_otros_incrementos"=>trim($data["total_otros_incrementos"]),
                "total_otras_deducciones"=>trim($data["total_otras_deducciones"])
            ];
            $array_montos = array_map(function($numeroString) {
                $numeroFloat = (float) str_replace(',', '', $numeroString);
                return (float) number_format($numeroFloat, 2, '.', '');
            }, $numeros_string);

            if(!empty($array_montos['salario']) && $array_montos['salario']>0){
                $parametros.=',"salario" : "'.$array_montos['salario'].'"';
            }
            else{
                return redirect()->back()->withInput(request()->all())->withErrors([
                        'mensaje1'=>'',
                        'mensaje2'=>'El salario es requerido'
                    ]);
            }
            if(!empty($data['porcentaje_salario'])){
                $parametros.=',"porcentaje_salario" : "'.$data['porcentaje_salario'].'"';
            }
            if(!empty($data['conyuge'])){
                $parametros.=',"conyuge" : "'.(isset($data['conyuge'])?1:0).'"';
            }
            if(!empty($data['hijos'])){
                $parametros.=',"hijos" : "'.$data['hijos'].'"';
            }
            if(!empty($data['horas_normal'])){
                $parametros.=',"horas_normal" : "'.$data['horas_normal'].'"';
            }
            if(!empty($data['horas_extra'])){
                $parametros.=',"horas_extra" : "'.$data['horas_extra'].'"';
            }
            if(!empty($data['horas_doble'])){
                $parametros.=',"horas_doble" : "'.$data['horas_doble'].'"';
            }
            if(!empty($data['dias_feriados'])){
                $parametros.=',"dias_feriados" : "'.$data['dias_feriados'].'"';
            }
            if(!empty($data['dias_vacaciones'])){
                $parametros.=',"dias_vacaciones" : "'.$data['dias_vacaciones'].'"';
            }
            if(!empty($data['ausencias'])){
                $parametros.=',"ausencias" : "'.$data['ausencias'].'"';
            }
            if(!empty($data['permisos'])){
                $parametros.=',"permisos" : "'.$data['permisos'].'"';
            }
            if(!empty($data['dias_incapacidad'])){
                $parametros.=',"dias_incapacidad" : "'.$data['dias_incapacidad'].'"';
            }

            if($array_montos['monto_prestamos']>0){
                $parametros.=',"monto_prestamos" : "'.trim($array_montos['monto_prestamos']).'"';
            }
            if($array_montos['monto_prestamos']>0){
                $parametros.=',"monto_embargos" : "'.trim($array_montos['monto_embargos']).'"';
            }

            if($array_montos['monto_prestamos']>0){
                $parametros.=',"monto_pensiones" : "'.trim($array_montos['monto_pensiones']).'"';
            }
            if($array_montos['monto_prestamos']>0){
                $parametros.=',"monto_otros_incremento" : "'.trim($array_montos['total_otros_incrementos']).'"';
            }

            if($array_montos['monto_prestamos']>0){
                $parametros.=',"monto_otros_deduccion" : "'.trim($array_montos['total_otras_deducciones']).'"';
            }

        }

        $parametros.='}';

        //se consume el api
        $respuesta=$this->general->consultaApiMedianteBody($tipo, $url, $parametros);

        if(isset($respuesta['error'])){
            $mensaje1='Error: '.$respuesta['codigo'].' ';
            $mensaje2='Detalles: '.$respuesta['error'].' ';

            return redirect()->back()->withInput(request()->all())->withErrors([
                    'mensaje1'=>$mensaje1,
                    'mensaje2'=>$mensaje2
                ]);
        }

        //si no dio error
        if($respuesta['estado']=='ok'){
            return redirect()->back()->with([
                'success'=>"Calculos con éxito.",
                'resultado'=>$respuesta['info']
            ]);
        }

        return redirect()->back();
    }

}
