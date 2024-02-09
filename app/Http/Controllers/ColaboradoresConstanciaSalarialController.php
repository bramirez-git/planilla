<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PDF;

class ColaboradoresConstanciaSalarialController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function index(Request $request)
    {
        $id_colaborador = Crypt::decrypt($request["id_colaborador"]);
        //Obtener datos generales
        $url = env("API_DIR")."getColaborador";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'","id_empresa": "'.$request->session()->get('id_cliente').'","id_colaborador": "'.$id_colaborador.'"}';

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

        $conjuntoResultados = [
            'idColaborador' => $id_colaborador,
            'resultadoColaborador' => $resultadoColaborador];

        return view('colaboradores.constanciaSalarial.colaboradoresConstanciaSalarial_index',$conjuntoResultados);
    }

    public function create(Request $request)
    {
        session()->now('wysiwyg','1');
        return view('colaboradores.constanciaSalarial.colaboradoresConstanciaSalarial_create');
    }

    public function store(Request $request)
    {
        if(isset($request["accion"]))
        {
            if($request["accion"] == "enviar")
            {
                return redirect()
                ->route('colaboradoresConstanciaSalarial.index')
                ->withSuccess("La constancia fue enviada al correo del colaborador con éxito!");
            }
        }

        return redirect()
            ->route('colaboradoresConstanciaSalarial.index')
            ->withSuccess("La constancia fue registrada con éxito!");
    }

    public function show($idColaborador)
    {
        $idColaborador=Crypt::decrypt($idColaborador);
        return view('colaboradores.constanciaSalarial.colaboradoresConstanciaSalarial_show');
    }

    public function update($idColaborador,Request $request)
    {
        $idColaborador=Crypt::decrypt($idColaborador);
        return redirect()
            ->back()
            ->withSuccess("Se duplicaron los datos de la constancia!");
    }

    public function createPDF() {
        set_time_limit(300);

        $pdf = PDF::loadView('pdf.constanciaSalarial');

        return $pdf->download('constanciaSalarialColaborador.pdf');
    }

}
