<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ColaboradoresPerfilController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function edit($idColaborador,Request $request)
    {
        $idColaborador = Crypt::decrypt($idColaborador);
        //catalogos
        $departamentos= $this->general->obtenerCatalogo("getDepartamentos",$request->session()->get('id_cliente'));
        $puestos= $this->general->obtenerCatalogo("getEmpresaPuestos",$request->session()->get('id_cliente'));
        $catalogoSalariosMinimos= $this->general->obtenerCatalogo("getSalariosMinimos");

        //Obtener datos generales
        $url = env("API_DIR")."getColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$idColaborador.'"}';

        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            if($respuesta['codigo'] != "error_registro")
            {
                $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
                $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

                return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
            }
            else
            {
                $resultadoColaborador= [];
            }
        }
        else
        {
            //si no dio error
            if ($respuesta['estado'] == 'ok') {
                //se guarda en caso que se quiera descargar el excel
                $datosDescargar = json_encode($respuesta['info']);

                //lo convierte en colección
                $resultadoColaborador = collect(json_decode($datosDescargar));
                $resultadoColaborador = $resultadoColaborador[0];

            }
        }

        //variables a usar en el api
        $url = env("API_DIR")."getColaboradorPerfil";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => $idColaborador
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

        //si no dio error
        if($respuesta['estado'] == 'ok')
        {
            //se guarda en caso que se quiera descargar el excel
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

            if(isset($resultadoFinal[0]))
            {
                $resultadoFinal = $resultadoFinal[0];
            }



            if(isset($resultadoFinal->telefono)){






                $entrada = preg_replace('/[\s-]+/', '', $resultadoFinal->telefono);

                // Utilizar una expresión regular para extraer el ISO2 y el número
                if (preg_match('/^\((\d+)\)(\d+)$/', $entrada, $matches)) {
                    $codigoPais = $matches[1]; // Número del código de país
                    $numero = $matches[2]; // Número de teléfono

                    $resultadoFinal->frm_telefono = $numero;
                    $resultadoFinal->frm_cod_pais = $codigoPais;
                }




            }

        }

        $conjuntoParametros = [
            'resultadoColaborador' => $resultadoColaborador,
            'idColaborador' => $idColaborador,
            'catalogoSalariosMinimos'=>$catalogoSalariosMinimos,
            'departamentos' => $departamentos,
            'puestos' => $puestos,
            'resultado' => $resultadoFinal
        ];

        return view('colaboradores.perfil.colaboradores_perfil_edit',$conjuntoParametros);
    }

    public function update($idColaborador,Request $request)
    {
        //Editar colaborador en api
        $url = env("API_DIR")."editarColaboradorPerfil";

        $numero_telefono= $this->general->formatPhoneNumber($request['frm_codigo_pais'], str_replace('_', '', $request['telefonoCelular']));
        $conjuntoParametros = [
            'id_empresa' => $request->session()->get('id_cliente'),
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim($idColaborador),
            'id_departamento' => trim($request["idDepartamento"]),
            'id_puesto' => trim($request['idPuesto']),
            'correo_empresarial' => trim($request['correoEmpresarial']),
            'telefono' => $numero_telefono,
            'extension' => trim(strtoupper($request['extension'])),
            'identificacion_cargo' => trim(strtoupper($request['identificacionCargo'])),
            'salario_minimo' => trim(strtoupper($request['minimoSalario'])),
            'salario_maximo' => trim(strtoupper($request['maximoSalario'])),
            'objetivo_puesto' => trim($request['objetivoPuesto']),
            'funciones_puesto' => trim($request['funcionesPuesto']),
            'tareas_puesto' => trim($request['tareasPuesto']),
            'habilidades_competencias' => trim($request['habilidadesCompetencias']),
            'formacion_academica' => trim($request['formacionAcademica']),
            'experiencia' => trim($request['experiencia'])
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

        return response()->json([
            'success' => true,
            'message' => 'Los datos del ' . strtolower($request->input('tipoForm')) . ' fueron agregados al colaborador.'
        ]);


    }
}
