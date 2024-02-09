<?php
namespace App\Funciones\Generales;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class funcionesGenerales
{
    public function eliminarAcentos($cadena): array|string
    {

        //Reemplazamos la A y a
        $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );

        //Reemplazamos la I y i
        $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );

        //Reemplazamos la O y o
        $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );

        //Reemplazamos la U y u
        $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
        );

        return $cadena;
    }

    public function guardarInformacionExcel(Request $request,$tipo,$url,$parametros)
    {
        $parametros .= ',"pagina" : "-1"';

        $parametros .= '}';

        $resultado = $this->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($resultado['error']))
        {
            return view('errores.error_api',
                ['detalles' =>$resultado['codigo'],
                    'error' =>$resultado['codigo_error']]);
        }

        //se guarda en caso que se quiera descargar el excel
        $datosDescargar = json_encode($resultado['info']);
        $request->session()->put('excelDescargar', $datosDescargar);
    }

    public function consultaApiMedianteBody($tipo,$url,$parametros)
    {
        return Http::withHeaders(['Authorization' => "Bearer ".env("API_AUTHORIZATION"),
                                  'Usuario-Sistema' => session()->get('name')])
            ->contentType("text/plain")
            ->send($tipo,$url, ['body' => $parametros]);
    }

    public function consultaApiMedianteParametros($url,$array)
    {
        
        return Http::withHeaders(['Authorization'  => "Bearer ".env("API_AUTHORIZATION"),
                                 'Usuario-Sistema' => session()->get('name'),])
//            ->timeout(1 * 60 * 60 * 1000)  //1 hora
            ->post($url,$array)->json();
    }

    public function consultaApiMedianteParametrosProcesosPesados($url,$array)
    {
        return Http::withHeaders(['Authorization' => "Bearer ".env("API_AUTHORIZATION"),])
            ->timeout(1 * 60 * 60 * 1000)  //1 hora
            ->post($url,$array)->json();
    }

    public function obtenerCatalogo($nombreCatalogo,$id_empresa = 0)
    {
        $url = env("API_DIR").$nombreCatalogo;
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","pagina":"-1"';

        if($id_empresa!=0)
        {
            $parametros .= ', "id_empresa" : "'.$id_empresa.'"';
        }
        $parametros .= '}';

        $respuesta = Http::withHeaders(['Authorization' => "Bearer ".env("API_AUTHORIZATION")])
            ->contentType("text/plain")
            ->send($tipo,$url, ['body' => $parametros]);

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

        return $resultadoFinal;
    }

    //Funcion realizada para subacciones de catalogos de acciones de personal
    public function obtenerSubCatalogo($nombreCatalogo,$id_empresa,$id_categoria)
    {
        $url = env("API_DIR").$nombreCatalogo;
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","pagina":"-1"';

        if($id_empresa!=0)
        {
            $parametros .= ', "id_empresa" : "'.$id_empresa.'"';
            $parametros .= ', "id_categoria" : "'.$id_categoria.'"';
        }
        $parametros .= '}';

        $respuesta = Http::withHeaders(['Authorization' => "Bearer ".env("API_AUTHORIZATION")])
            ->contentType("text/plain")
            ->send($tipo,$url, ['body' => $parametros]);

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

        return $resultadoFinal;
    }

    public function obtenerUbicacion($nombreCatalogo,$filtro,$provincia = 0,$canton = 0,$distrito = 0)
    {
        $url = env("API_DIR").$nombreCatalogo;
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        if($distrito!=0)
        {
            $parametros .= ', "filtro" : "'.$filtro.'", "id_provincia" : "'.$provincia.'", "id_canton" : "'.$canton.'", "id_distrito" : "'.$distrito.'"';
        }
        else if($canton!=0)
        {
            $parametros .= ', "filtro" : "'.$filtro.'", "id_provincia" : "'.$provincia.'", "id_canton" : "'.$canton.'"';
        }
        else if($provincia!=0)
        {
            $parametros .= ', "filtro" : "'.$filtro.'", "id_provincia" : "'.$provincia.'"';
        }
        else
        {
            $parametros .= ', "filtro" : "'.$filtro.'"';
        }


        $parametros .= '}';


        $respuesta = Http::withHeaders(['Authorization' => "Bearer ".env("API_AUTHORIZATION")])
            ->contentType("text/plain")
            ->send($tipo,$url, ['body' => $parametros]);

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

        return $resultadoFinal;
    }

    public function obtenerTiposEmpresa(){
        $url = env("API_DIR")."getTiposEmpresa";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"}';

        $respuesta = Http::withHeaders(['Authorization' => "Bearer ".env("API_AUTHORIZATION")])
            ->contentType("text/plain")
            ->send($tipo,$url, ['body' => $parametros]);

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

        return $resultadoFinal;
    }

    function ordena_array_fecha(array $fechasOrdenar)
    {
        for ($contador1 = 0; $contador1 < count($fechasOrdenar) - 1; $contador1++) {
            for ($contador2 = 0; $contador2 < count($fechasOrdenar) - $contador1 - 1; $contador2++) {
                if (strtotime(trim($fechasOrdenar[$contador2 + 1])) < strtotime(trim($fechasOrdenar[$contador2]))) {
                    $auxiliar = $fechasOrdenar[$contador2 + 1];
                    $fechasOrdenar[$contador2 + 1] = $fechasOrdenar[$contador2];
                    $fechasOrdenar[$contador2] = $auxiliar;
                }
            }
        }
        return $fechasOrdenar;
    }

    function indica_fechas_seguidas(array $fechasOrdenar)
    {
        $fechas_final=[];
        $fechas_largas="";
        $nuevafecha=0;

        for ($contador1 = 0; $contador1 <= count($fechasOrdenar)-1; $contador1++)
        {
            //$fechaActual=new DateTime(date_format(date_create($fechasOrdenar[$contador1]),"Y-m-d"));
            //$fechaString = explode("/", $fechasOrdenar[$contador1]);
            //$fechaActual = new DateTime($fechaString[2].'/'.$fechaString[1].'/'.$fechaString[0]);
            $fechaActual = str_replace("-","/",$fechasOrdenar[$contador1]);

            if($nuevafecha == 0)
            {
                //$fechas_largas= $fechaActual->format('Y-m-d');
                $fechas_largas= $fechaActual;
                $nuevafecha=1;
                if(count($fechasOrdenar) - 1 == $contador1)
                {
                    //Si es el ultimo elemento
                    $fechas_final[] = [
                        "fecha" => $fechas_largas
                    ];
                }
            }
            else
            {
                //Datos nuevos
                //$fechaAnterior=new DateTime(date_format(date_create($fechasOrdenar[$contador1-1]),"Y-m-d"));
                //$fechaString = explode("/", $fechasOrdenar[$contador1-1]);
                //$fechaAnterior = new DateTime($fechaString[2].'/'.$fechaString[1].'/'.$fechaString[0]);
                $fechaAnterior = str_replace("-","/",$fechasOrdenar[$contador1-1]);

                $diferenciaAnterior=date_diff( date_create($fechaAnterior), date_create($fechaActual));

                if($contador1 < count($fechasOrdenar) - 1)
                {
                    //$fechaSiguiente = new DateTime(date_format(date_create($fechasOrdenar[$contador1 + 1]), "Y-m-d"));
                    //$fechaSiguiente = new DateTime($fechaString[2].'/'.$fechaString[1].'/'.$fechaString[0]);
                    $fechaSiguiente = str_replace("-","/",$fechasOrdenar[$contador1+1]);
                    $diferenciaSiguiente=date_diff(date_create($fechaActual),date_create($fechaSiguiente));
                }

                if($diferenciaAnterior->format("%a")==1)
                {
                    if(count($fechasOrdenar) - 1 == $contador1)
                    {
                        //Si es el ultimo elemento
                        $fechas_largas.= "|".$fechaActual;
                        $fechas_final[] = [
                            "fecha" => $fechas_largas
                        ];
                        $nuevafecha = 0;
                    }
                    else if(isset($diferenciaSiguiente))
                    {
                        if($diferenciaSiguiente->format("%a")>1)
                        {
                            //Si termina el primer rango de fecha larga
                            $fechas_largas.= "|".$fechaActual;
                            $fechas_final[] = [
                                "fecha" => $fechas_largas
                            ];
                            $nuevafecha = 0;
                        }
                    }
                }
                else
                {
                    $fechas_final[] = [
                        "fecha" => $fechas_largas
                    ];

                    $fechas_largas = $fechaActual->format('Y-m-d');

                    if(count($fechasOrdenar) - 1 == $contador1)
                    {
                        //Si es el ultimo elemento
                        $fechas_final[] = [
                            "fecha" => $fechas_largas
                        ];
                    }
                }
            }

        }
        return $fechas_final;
    }

    public function formatPhoneNumber($countryCode, $phoneNumber)
    {
        if (!isset($countryCode)) {
            $countryCode = "506";
        }

        // Eliminar el guion del número de teléfono
        $phoneNumber = str_replace("-", "", $phoneNumber);

        // Formatear como (506)22222222
        $formattedPhoneNumber = "($countryCode)$phoneNumber";

        return $formattedPhoneNumber;
    }

    public function parsePhoneNumber($formattedPhoneNumber)
    {
        $matches = [];
        preg_match('/\((\d+)\)(\d+)/', $formattedPhoneNumber, $matches);

        if (count($matches) === 3) {
            return [
                'code' => $matches[1],
                'telefono' => $matches[2],
            ];
        }

        return null;
    }

    public function obtener_catalogo_medios_comerciales()
    {
        $url = env("API_MEDIOS_COMERCIALES");
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_MEDIOS_C_USUARIO").'", "clave" : "'.env("API_MEDIOS_C_CLAVE").'"';

        $parametros .= ', "estado" : "ACTIVO"';

        $parametros .= '}';

        $respuesta = Http::withHeaders(['Authorization' => ""])
            ->contentType("text/plain")
            ->send($tipo,$url, ['body' => $parametros]);

        if(isset($respuesta['error']))
        {
//            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
//            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => "error ws medios digitales",]);
        }

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

        }

        return $resultadoFinal;
    }

}

?>
