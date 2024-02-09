<?php

namespace App\Http\Controllers\Panel\Marketplace;

use App\Http\Controllers\Controller;
use App\Funciones\Generales\funcionesGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductoMarketplaceController extends Controller
{
    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }


    public function create()
    {
        session()->now('wysiwyg','1');
        return view('panel.marketplace.marketplace_create');
    }

    public function store(Request $request)
    {

        //Validar
        $customMessages = [
             'nombre_modulo.required'           =>  'Debe ingresar un :attribute'
            ,'nombre_modulo.max'                =>  'El :attribute no puede exceder los 100 caracteres.'
            ,'precio.required'                  =>  'Debe ingresar un :attribute'
            ,'precio.max'                       =>  'El :attribute no puede ser mayor que :max.'
            ,'descripcion.required'             =>  'Debe de ingresar su :attribute'
            ,'editor.required'                  =>  'Debe de ingresar :attribute'
            ,'valor_estado.integer'             =>  'Debe de seleccionar un estado válido'

        ];
        $rules = [
             'nombre_modulo'         => ['required','max:100']
            ,'precio'                => ['required','max:20']
            ,'descripcion'           => ['required']
            ,'editor'                => ['required']
            ,'valor_estado'          => ['required']
        ];

        $this->validate($request, $rules, $customMessages);


        //Crear colaborador en api
        $url = env("API_DIR")."insertarServicio";

        $conjuntoParametros = [
            'usuario'     => env("API_USUARIO"),
            'clave'       => env("API_CLAVE"),
            'nombre'      => trim($request->nombre_modulo),
            'precio'      => trim($request->precio),
            'descripcion' => trim($request->descripcion),
            'terminos'    => trim($request->editor),
            'estado'      => trim($request->valor_estado)
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
            ->route('marketplace.index')
            ->withSuccess("Producto fue creado con éxito!");
    }

    public function edit(Request $request,$idProducto)
    {
        $idProducto=Crypt::decrypt($idProducto);
        //variables a usar en el api
        $url = env("API_DIR")."getMarketplace";
        $conjuntoParametros = [
            'usuario'     => env("API_USUARIO"),
            'clave'       => env("API_CLAVE"),
            'id_servicio' => $idProducto
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

        }

        $conjuntoResultados = [
            'id_servicio' => $idProducto,
            'resultado'   => $resultadoFinal[0]
        ];

        session()->now('wysiwyg','1');
        return view('panel.marketplace.marketplace_edit',$conjuntoResultados);

    }

    public function update(Request $request,$idProducto)
    {
        $customMessages = [
             'nombre_modulo.required'            =>  'Debe ingresar un :attribute'
            ,'nombre_modulo.max'                =>  'El :attribute no puede exceder los 100 caracteres.'
            ,'precio.required'                  =>  'Debe ingresar un :attribute'
            ,'precio.max'                       =>  'El :attribute no puede ser mayor que :max.'
            ,'descripcion.required'             =>  'Debe de ingresar su :attribute'
            ,'editor.required'                  =>  'Debe de ingresar :attribute'
            ,'valor_estado.integer'             =>  'Debe de seleccionar un estado válido'

        ];
        $rules = [
             'nombre_modulo'         => ['required','max:100']
            ,'precio'                => ['required','max:20']
            ,'descripcion'           => ['required']
            ,'editor'                => ['required']
            ,'valor_estado'          => ['required']
        ];

        $this->validate($request, $rules, $customMessages);
        //Crear colaborador en api
        $url = env("API_DIR")."editarServicio";
        $conjuntoParametros = [
            'id_empresa'  => $request->session()->get('id_cliente'),
            'usuario'     => env("API_USUARIO"),
            'clave'       => env("API_CLAVE"),
            'id_servicio' => $idProducto,
            'nombre'      => trim($request->nombre_modulo),
            'precio'      => trim($request->precio),
            'descripcion' => trim($request->descripcion),
            'terminos'    => trim($request->editor),
            'estado'      => trim($request->valor_estado)
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
            ->route('marketplace.index')
            ->withSuccess("Producto fue modificado con éxito!");
    }

    public function destroy($idProducto)
    {
        //Editar colaborador en api
        $url = env("API_DIR")."eliminarServicio";
        $conjuntoParametros = [
            'usuario'     => env("API_USUARIO"),
            'clave'       => env("API_CLAVE"),
            'id_servicio' => trim($idProducto)
        ];


        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);
        $valorNombre = $respuesta['info'][0]['nombre'];

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
            ->route('marketplace.index')
            ->withSuccess("El producto {$valorNombre} fue eliminado con éxito!");
    }
}
