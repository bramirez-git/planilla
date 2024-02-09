<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function store(Request $request)
    {
        //documentos adjuntos

        if($request["documento"])
        {
            $ruta =public_path('archivos/documentos/documentosDigitales/');
            $documentos = request('documento')->getClientOriginalName();
            $request->documento->move($ruta, $documentos);
            $rutaDocumentos = public_path('archivos/documentos/documentosDigitales/').$documentos;
            //dd($rutaDocumentos);
        }

        //Crear colaborador en api
        $url = env("API_DIR")."crearColaboradorDocumento";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => trim(Crypt::decrypt($request["idColaborador"])),
            'nombre' => trim($request["nombreDocumento"]),
            'palabras_clave' => trim($request["palabrasClaves"]),
            'url_documento' => trim($rutaDocumentos),
            'fecha' => trim($request['fechaRegistro']),
            'comentarios' => trim($request["descripcionDocumento"])
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

        return redirect()
            ->back()
            ->withSuccess("Se guardó el documento correctamente!");
    }

    public function update(Request $request,$id_colaborador)
    {
        //Envia datos por correo
        $url = env("API_DIR") . "enviarCorreoColaboradorDocumento";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_colaborador' => Crypt::decrypt($id_colaborador),
            'id_documento' => Crypt::decrypt($request['id_documento']),
            "correos"=> trim($request["correo"])
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        //dd($respuesta);
        //si da respuesta de error
        if (isset($respuesta['error'])) {
            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = 'Detalles: ' . $respuesta['error'] . ' ';

            return redirect()->back()->withInput(request()->all())->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2]);
        }

        //si no dio error
        if ($respuesta['estado'] == 'ok') {

            return back()->withSuccess("Se envió el documento correctamente!");
        }
    }
}
