<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use App\Funciones\Vacaciones\funcionesVacaciones;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\FqsenResolver;
use Exception;

class FuncionesController extends Controller
{
    use funcionesVacaciones;

    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function obtenerDiasDisponibles($fechaInicio,$fechaFinal,$diasUsados,$jornada)
    {
        $resultado = $this->getDiasDisponibles($fechaInicio,$fechaFinal,$diasUsados,$jornada);
        return response()->json($resultado);
    }

    public function obtenerNombreCedula(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."busquedaPadronElectoralPorCedula";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","cedula": "'.$request->cedula.'"}';

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($respuesta['error']))
        {
            return "";
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            $datosDescargar = json_encode($respuesta['info']);
            //lo convierte en colección
            $resultadoFinal= collect(json_decode($datosDescargar))[0];
        }

        return $resultadoFinal->primer_nombre."/@.".$resultadoFinal->segundo_nombre
            ."/@.".$resultadoFinal->primer_apellido."/@.".$resultadoFinal->segundo_apellido;
    }

    public function obtenerNombreCedulaJuridica(Request $request)
    {
        //url
        $url = "https://api.hacienda.go.cr/fe/ae";

        //respuesta de webservice
        $respuesta = Http::get($url,
            [
                'identificacion' => $request->cedula,
            ]
        );

        $persona = $respuesta->json();
        echo "".$persona['nombre'];
        //echo $persona;
    }

    public function obtenerNombreCedulaRegistro(Request $request)
    {
        try {
            // URL
            $url = "https://api.hacienda.go.cr/fe/ae";

            // Respuesta del servicio web
            $respuesta = Http::timeout(10)->get($url, [
                'identificacion' => $request->cedula,
            ]);

            $persona = $respuesta->json();
            return response()->json([
                'success' => 1,
                'resultado'=>$persona['nombre']
            ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'success' => 0,
                'error'=>"Error al conectar con la API: " . $e->getMessage()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => 0,
                'error'=>"Se produjo un error: " . $e->getMessage()
            ]);
        }
    }

    public function obtenerCantones(Request $request)
    {
        $cantones= $this->general->obtenerUbicacion("getUbicacion","cantones",$request['provincia']);
        foreach($cantones as $canton){
            $canton->canton=ucwords(strtolower($canton->canton));
        }
        return view('componentes.ubicacionesCanton',["cantones"=>$cantones]);
    }

    public function obtenerDistritos(Request $request)
    {
        $distritos= $this->general->obtenerUbicacion("getUbicacion","distritos",$request['provincia'],$request['canton']);
        foreach($distritos as $distrito){
            $distrito->distrito=ucwords(strtolower($distrito->distrito));
        }
        return view('componentes.ubicacionesDistrito',["distritos"=>$distritos]);
    }

    public function obtenerBarrios(Request $request)
    {
        $barrios= $this->general->obtenerUbicacion("getUbicacion","barrios",$request['provincia'],$request['canton'],$request['distrito']);
        foreach($barrios as $barrio){
            $barrio->barrio=ucwords(strtolower($barrio->barrio));
        }
        return view('componentes.ubicacionesBarrio',["barrios"=>$barrios]);
    }

    public function testLarabug(){
        try {
            throw new Exception('Testing my application!');
        }catch (Exception $ex){
            return $ex;
        }
        dd("Finalizado");
    }

}
