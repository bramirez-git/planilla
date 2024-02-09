<?php

namespace App\Http\Controllers;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Seguridad\SecureValue;
use App\Funciones\Storage\cls_storage;
use App\Funciones\Storage\TempDir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class MiCuentaController extends Controller
{

    private $general;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
    }

    public function edit(Request $request,$idCuenta)
    {
        $idCuenta=Crypt::decrypt($idCuenta);

        $departamentos= $this->general->obtenerCatalogo("getDepartamentos",$request->session()->get('id_cliente'));
        //variables a usar en el api
        $url=env("API_DIR")."getUsuario";
        $tipo="POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';

        $parametros.=',"id_usuario" : "'.session()->get('id_usuario').'"';



        $parametros .= '}';

        //se consume el api
        $respuesta = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

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
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

            $result_telefono = $this->general->parsePhoneNumber($resultadoFinal[0]->celular);

            $resultadoFinal[0]->telefono_code = !empty($result_telefono)?$result_telefono['code']:'';
            $resultadoFinal[0]->telefono = !empty($result_telefono)?$result_telefono['telefono']:'';

            try{
                if (file_exists($resultadoFinal[0]->foto) && File::isReadable($resultadoFinal[0]->foto)) {
                    $foto = basename($resultadoFinal[0]->foto);
                    $existe_path=true;
                } else {
                    $existe_path = false;
                }
            }catch(\Exception $e){
                $existe_path=false;
            }

        }

        $tab_usuario=session()->get("tab_usuarios");
        if (!in_array($tab_usuario, ['edit_info', 'password','2FA'])) {
            $tab_usuario = "info";
        }

        $conjuntoResultados = [
            'resultado' => $resultadoFinal[0],
            'departamentos'=>$departamentos,
            'foto'=>$foto??"",
            'existe_path'=>$existe_path,
            'tab'=>$tab_usuario];
        session()->put('tab_usuarios', '');
        return view('miCuenta.miCuenta_edit',$conjuntoResultados);
    }

    public function update(Request $request,$idCuenta)
    {
        $idCuenta=Crypt::decrypt($idCuenta);
        session()->put('tab_usuarios', 'edit_info');
        if(isset($request['fotoActual'])){
            $request['fotoActual']= Crypt::decrypt( $request['fotoActual']);
        }

        $path_file_name = "";

        if(isset($request['frm_fotos']))
        {
            if($request['frm_fotos']!="")
            {
                TempDir::destroy_file($request['fotoActual']);
                $content = base64_decode($request['frm_fotos']);
                $dir=cls_storage::dir_warehouse_filesystems_img_group(session()->get('id_cliente'), 3);
                $extension = pathinfo($content, PATHINFO_EXTENSION);
                $filename=cls_storage::filename_doc('png');
                $path_file_name=$dir.$filename;
                $file = fopen($path_file_name, "wb");
                fwrite($file, $content);
                fclose($file);

            }
        }
        else
        {
            if(isset($request['fotoActual']))
            {
                if(trim($request['fotoActual'])!="")
                {
                    $path_file_name = trim($request['fotoActual']);
                }
            }
        }

        $url = env("API_DIR")."editarUsuario";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_empresa' => trim($request["empresa"]),
            'id_usuario' => trim($idCuenta),
            'id_departamento' => trim($request["idDepartamento"]),
            'name' => trim($request["nombre"]),
            'email' => trim($request["email"]),
            'celular' => $this->general->formatPhoneNumber($request['frm_codigo_pais'], $request['telefono']),
            'foto' => trim($path_file_name)
        ];
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            try{
                if (file_exists($path_file_name) && File::isReadable($path_file_name)) {
                    TempDir::destroy_file($path_file_name);
                }
            }catch(\Exception $e){
            }
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
            $datosDescargar = json_encode($respuesta['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));
            try{
                if (file_exists($path_file_name) && File::isReadable($path_file_name)) {
                    session()->put('foto_user_name', basename($path_file_name));
                    session()->put('foto_user_existe', true);
                }
            }catch(\Exception $e){

            }
        }

        return redirect()
            ->back()
            ->withSuccess("La Información de la cuenta fue modificada con éxito!");
    }

    public function cambio_contrasena_usuario(Request $request){
        $url=env("API_DIR")."editarClaveCuentaUsuario";
        session()->put('tab_usuarios', 'password');
        $conjuntoParametros=[
            'usuario'=>env("API_USUARIO"),
            'clave'=>env("API_CLAVE"),
            'id_empresa'=>trim(session()->get("id_cliente")),
            'id_usuario'=>trim(session()->get("id_usuario")),
            'clave_anterior'=>SecureValue::encode(trim($request['contrasena']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true),
            'clave_nueva'=>SecureValue::encode(trim($request['new_contrasena']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true),
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
        return redirect()
            ->back()// Reemplaza $valor con el valor que deseas enviar
            ->withSuccess("La contraseña fue actualizada con éxito!");
    }
    public function actualizacion2FA(Request $request)
    {
        $url=env("API_DIR")."configurarDobleFactorAutenticacion";
        session()->put('tab_usuarios', '2FA');
        $conjuntoParametros=[
            'usuario'              =>env("API_USUARIO"),
            'clave'                =>env("API_CLAVE"),
            'id_empresa'           =>trim(session()->get("id_cliente")),
            'id_usuario'           =>trim(session()->get("id_usuario")),
            'doble_autenticacion'  => $request['activateTwoFactorAuth'],
            'celular'              => $this->general->formatPhoneNumber($request['frm_codigo_pais_factor'], str_replace('_', '', $request['telefono_factor'])),
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
        return redirect()
        ->back()
        ->withSuccess($request['activateTwoFactorAuth'] == '1' ? "Se ha configurado correctamente!" : "Se ha desactivado con éxito!");

    }
}
