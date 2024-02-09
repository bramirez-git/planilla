<?php

namespace App\Http\Controllers\Autenticacion;

use App\Funciones\Generales\funcionesGenerales;
use App\Funciones\Seguridad\SecureValue;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class UsuariosController extends Controller
{
    private $general;
    private $banner;

    public function __construct()
    {
        $this->general = new funcionesGenerales();
        $this->banner  = new BannerController();
    }

    public function showLoginForm(Request $request)
    {
        if(session()->has('session'))
        {
            return redirect()->route('home');
        }
        if(session()->has('sessionWS'))
        {
            return redirect()->route('clientes.index');
        }

        $banner = $this->banner->obtenerBanner();
        $array_result=[
            'banner' => $banner,
            'login' => 'si',];

        $msj_exito=$request->session()->get('success');
        if(isset($msj_exito)&& !empty($msj_exito)){
            $array_result[]=['success'=>$msj_exito];
        }
        return view('autenticacion.login')->with(
            $array_result
        );
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        //variables a usar en el api
        $url = env("API_DIR")."loginUsuario";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'correo' => trim($request['email']),
            'contrasena' => trim($request['password']),
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
            $resultadoFinal= $resultadoFinal[0];

            try{
                if (file_exists($resultadoFinal->foto) && File::isReadable($resultadoFinal->foto)) {
                    $existe_path=true;
                } else {
                    $existe_path = false;
                }
            }catch(\Exception $e){
                $existe_path=false;
            }

            session(['empresa' => $resultadoFinal->empresa,
                'name' => $resultadoFinal->name,
                'email' => $resultadoFinal->email,
                'id_cliente' => $resultadoFinal->id_cliente,
                'id_usuario' => $resultadoFinal->id,
                'session'=> 'activa',
                'tiempo_sesion' => $resultadoFinal->tiempo_sesion,
                'ultimo_acceso'=>$resultadoFinal->ultimo_acceso,
                'envio_comprobante_pago' => $resultadoFinal->envio_comprobante_pago,
                'prestamos' => $resultadoFinal->prestamos,
                'vacaciones_adelantadas' => $resultadoFinal->vacaciones_adelantadas,
                'adelanto_aguinaldo' => $resultadoFinal->adelanto_aguinaldo,
                'plan_bonificaciones' => $resultadoFinal->plan_bonificaciones,
                'plan_ahorro_voluntario' => $resultadoFinal->plan_ahorro_voluntario,
                'modulo_liquidacion' => $resultadoFinal->modulo_liquidacion,
                'asociacion_solidarista' => $resultadoFinal->asociacion_solidarista,
                'foto_user_name' => basename($resultadoFinal->foto),
                'foto_user_existe' => $existe_path
                ]);


        }

        return redirect()->route('two');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return redirect()->route('login');
    }

    public function sendResetLinkEmail(Request $request)
    {
        //variables a usar en el api
        $url = env("API_DIR")."enviarCorreoCambioClaveUsuario";

        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'correo' => $request->id_recover_email
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        $banner = $this->banner->obtenerBanner();

        //si da respuesta de error
        if(isset($respuesta['error']))
        {
            $mensaje1 = 'Error: '.$respuesta['codigo'].' ';
            $mensaje2 = 'Detalles: '.$respuesta['error'].' ';

            /*return redirect()
                ->back()
                ->with('recover_pass', 'si')
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);*/

            return view('autenticacion.login')
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2])
                ->with([
                'banner' => $banner,
                'recover_pass' => 'si'
            ]);
        }

        /*//Aqui se validaria si no existe el correo
        if($request->id_recover_email != 'jafetsojo@gmail.com')
        {
            return view('autenticacion.login')->with([
                'banner' => $banner,
                'recover_pass' => 'si',
                'error' => 'El correo ingresado no se encuentra registrado en nuestro sistema, por favor intente con otro correo o bien comuníquese con nuestro departamento de servicio al cliente, teléfono: 506.22049494'
            ]);
        }*/

        //si existe aqui se enviaria el correo electronico si existe

        return view('autenticacion.login')
            ->with([
                'banner' => $banner,
                'recover_pass' => 'si',
                'success'=>'Se ha enviado el correo electrónico con las instrucciones de recuperación de contraseña.'
            ]);
    }

    public function showRegistrationForm(Request $request)
    {
        $general = new funcionesGenerales();
        $provincias= $general->obtenerUbicacion("getUbicacion","provincias");
        $cantones= $general->obtenerUbicacion("getUbicacion","cantones",2);
        $distritos= $general->obtenerUbicacion("getUbicacion","distritos",2,1);
        $barrios= $general->obtenerUbicacion("getUbicacion","barrios",2,1,1);
        $tiposIdentificacion = $this->general->obtenerCatalogo("getTiposEmpresa");
        $medios_comerciales = $this->general->obtener_catalogo_medios_comerciales();

        $conjuntoResultados = [
            'provincias' => $provincias,
            'cantones' => $cantones,
            'distritos' => $distritos,
            'barrios' => $barrios,
            'tiposIdentificacion'=>$tiposIdentificacion,
            'medios_comerciales'=>$medios_comerciales
        ];

        return view('autenticacion.register',$conjuntoResultados);
    }

    public function register(Request $request)
    {
        $request->validate([
            'g-recaptcha-response'=> ['required', new \App\Rules\Recaptcha]
        ]);

        //Aqui se guarda el cliente
        $telefono_fijo=false;
        $telefono_celular=false;
        $codigoPais = $request['frm_codigo_pais'];
        $numeroTelefono = $request['telefono'];
        $primerDigito = substr($numeroTelefono, 0, 1);
        if(empty($codigoPais)){
            if (in_array($primerDigito, ['2', '4'])) {
                // Guardar como teléfono fijo
                $telefono_fijo=true;
                // ...
            }
            if (in_array($primerDigito, ['6', '7', '8', '9'])) {
                $telefono_celular=true;
            }
        }else{
            $telefono_fijo=true;
        }

        $url = env("API_DIR")."crearEmpresa";
        $conjuntoParametros = [
            'usuario' => env("API_USUARIO"),
            'clave' => env("API_CLAVE"),
            'id_tipo_empresa' => trim($request["tipoIdentificacion"]),
            'identificacion' => trim($request['identificacion']),
            'nombre' => trim($request['nombrePersona']),
            'nombre_fantasia' => "",
            'telefono_fijo' => $telefono_fijo?$this->general->formatPhoneNumber($request['frm_codigo_pais'], $request['telefono']):"",
            'correo' => trim($request['correo']),
            'telefono_celular' =>$telefono_celular?$this->general->formatPhoneNumber($request['frm_codigo_pais'], $request['telefono']):"",
            'id_provincia' => trim($request['provincia']),
            'id_canton' => trim($request['canton']),
            'id_distrito' => trim($request['distrito']),
            'id_barrio' => trim($request['barrio']),
            'direccion' => trim($request['direccion']),
            'medio_comunicacion' => trim($request['medio_comunicacion']),
            'foto' => "",
            'nombre_contacto' => trim($request['nombreContacto']),
            'email' => trim($request['correoContacto']),
            'comentario' => trim($request['comentario'])??"",
        ];

        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        //si da respuesta de error
        if (isset($respuesta['error']))
        {
            $mensaje1 = 'Error: ' . $respuesta['codigo'] . ' ';
            $mensaje2 = ''; //
            if (is_array($respuesta['error'])) {
                foreach ($respuesta['error'] as $key => $value) {
                    if (is_array($value) && isset($value[0])) {
                        $mensaje2 = 'Detalles: ' . $value[0] . ' ';
                        break;
                    }
                }
            } else {
                // Manejo de error si $respuesta['error'] no es un array
                $mensaje2 = $respuesta['error'];
            }

            if($respuesta['codigo']==="error_correo_empresa_existe"){
                session()->flash('warning_registro', "El correo electrónico suministrado se encuentra asociado a un registro existente. Se ha enviado nuevamente las instrucciones de activación.");
                return redirect()
                    ->back();
            }

            if($respuesta['codigo']==="error_identificacion_existe"){
                session()->flash('warning_registro', "El número de identificación suministrado se encuentra asociado a un registro existente. Se ha enviado nuevamente las instrucciones de activación al correo electrónico.");
                return redirect()
                    ->back();
            }

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1' => $mensaje1, 'mensaje2' => $mensaje2])
                ->with(['data'=>$conjuntoParametros]);
        }


        //si no da error redirige a la lista de colaboradores con mensaje de éxito
        return view('autenticacion.register_exito');
    }

    public function mostrarActivarUsuario($correo)
    {
        session()->now('js-activar-cuenta','1');
        $correo = SecureValue::decode($correo, env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        $banner = $this->banner->obtenerBanner();
        return view('autenticacion.activar_cuenta_show',
            [
            'correo'=>$correo,
            'banner'=>$banner
            ]);
    }

    public function resetPasswordUsuario($correo)
    {
        session()->now('js-password-reset','1');
        $correo = SecureValue::decode($correo, env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true);
        return view('autenticacion.password_reset_show',['correo'=>$correo,'reset'=>true]);
    }

    public function cuentaActiva(Request $request)
    {
        //Validar
        $request->validate([
            'g-recaptcha-response'=> ['required', new \App\Rules\Recaptcha]
        ]);
        //variables a usar en el api
        $url = env("API_DIR")."activarCuentaUsuario";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';


        if(!empty($request['correo'])){
            $parametros.=',"correo" : "'.SecureValue::encode(trim($request['correo']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true).'"';
        }

        if(!empty($request['password'])){
            $parametros.=',"contrasena" : "'.SecureValue::encode(trim($request['password']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true).'"';
        }



        $parametros .= '}';

        //se consume el api
        $result = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($result['error']))
        {
            $mensaje1 = 'Error: '.$result['codigo'].' ';
            $mensaje2 = 'Detalles: '.$result['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($result['estado'] == 'ok')
        {
            $datosDescargar = json_encode($result['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

        }

        session()->flash('success', 'Usuario activado con éxito!');
        // Luego, simplemente devuelve la vista o la respuesta que deseas mostrar al usuario.
        $banner = $this->banner->obtenerBanner();
        return view('autenticacion.login')->with([
                'banner'=>$banner,
                'login'=>'si',
            ]);

    }

    public function passwordReset(Request $request)
    {
        //Validar
        $request->validate([
            'g-recaptcha-response'=> ['required', new \App\Rules\Recaptcha]
        ]);
        //variables a usar en el api
        $url = env("API_DIR")."cambiarClaveUsuario";
        $tipo = "POST";
        $parametros='{"usuario" : "'.env("API_USUARIO").'", "clave" : "'.env("API_CLAVE").'"';


        if(!empty($request['correo'])){
            $parametros.=',"correo" : "'.SecureValue::encode(trim($request['correo']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true).'"';
        }

        if(!empty($request['password'])){
            $parametros.=',"contrasena_temporal" : "'.SecureValue::encode(trim($request['password']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true).'"';
        }

        if(!empty($request['new_password'])){
            $parametros.=',"contrasena" : "'.SecureValue::encode(trim($request['new_password']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true).'"';
        }



        $parametros .= '}';

        //se consume el api
        $result = $this->general->consultaApiMedianteBody($tipo,$url,$parametros);

        if(isset($result['error']))
        {
            $mensaje1 = 'Error: '.$result['codigo'].' ';
            $mensaje2 = 'Detalles: '.$result['error'].' ';

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['mensaje1'=>$mensaje1,'mensaje2'=>$mensaje2]);
        }

        //si no dio error
        if($result['estado'] == 'ok')
        {
            $datosDescargar = json_encode($result['info']);

            //lo convierte en colección
            $resultadoFinal= collect(json_decode( $datosDescargar));

            return redirect()
                ->route('inicio')
                ->withSuccess("Se ha cambiado tu contraseña de inicio de sesión con exito!");

        }
        return redirect()
            ->back()
            ->withInput(request()->all())
            ->withErrors(['mensaje1'=>"Error en el proceso"]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        return 'email';
    }

    public function verificarSesion(Request $request)
    {
        $json = [];
        if ($request->session()->get('session') == "activa") {
            $json['status'] = 'logged';
            $json['msj'] = [];

            if(empty($request->session()->get('id_cliente')) && empty($request->session()->get('id_usuario'))){
                $json['status'] = 'invalid';
                $json['msj'][] = 'La empresa no coincide con la sesión actual';
            }
            elseif(empty($request->session()->get('email'))){
                $json['status'] = 'invalid';
                $json['msj'][] = 'El usuario no coincide con la sesión actual';
            }

        } else {
            $json['status'] = 'login';
            $json['msj'][] = 'La sesión actual es inválida';
        }

        return response()->json($json);
    }

    public function showTwoFactorForm(Request $request)
    {
        session()->now('two_factor','1');
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
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }
        if(isset($resultadoFinal[0]->celular)){

            $entrada = preg_replace('/[\s-]+/', '', $resultadoFinal[0]->celular);

            // Utilizar una expresión regular para extraer el ISO2 y el número
            if (preg_match('/^\((\d+)\)(\d+)$/', $entrada, $matches)) {

                $codigoPaisCelular = $matches[1]; // Número del código de país
                $numeroCelular = $matches[2]; // Número de teléfono

                $resultadoFinal[0]->frm_telefonoCeluar = $numeroCelular;
                $resultadoFinal[0]->frm_cod_paisCelular = $codigoPaisCelular;

            }


        }

        if($resultadoFinal[0]->doble_autenticacion == 1)
        {

            if (!session()->has('codigo_enviado')) {
                // Si no se ha enviado el código aún, envíalo y establece la bandera
                session()->put('two_factor_enabled', true);
                $codigo = $this->enviarCodigo();
                session()->put('codigo_enviado', true);
            }
            $ultimosDosDigitos = substr($resultadoFinal[0]->frm_telefonoCeluar, -2);
            $telefonoOculto = str_repeat('x', strlen($resultadoFinal[0]->frm_telefonoCeluar) - 2) . $ultimosDosDigitos;
            $resultadoFinal[0]->frm_telefonoCeluar = $telefonoOculto;

            return view('autenticacion.twoFactorCodigo',['usuario' => $resultadoFinal]);
        }
        else{

            session()->put('two_factor_enabled', false);
            return view('autenticacion.twoFactor',['resultado' => $resultadoFinal[0]]);
        }
    }

    public function enviarCodigo()
    {
        $url=env("API_DIR")."enviarCodigoDobleAutenticacion";
        $conjuntoParametros=[
            'usuario'              =>env("API_USUARIO"),
            'clave'                =>env("API_CLAVE"),
            'id_empresa'           =>trim(session()->get("id_cliente")),
            'id_usuario'           =>trim(session()->get("id_usuario")),
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

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
            $resultadoFinal= collect(json_decode( $datosDescargar));
        }

        return $resultadoFinal;
    }

    public function activar2FAlogin(Request $request)
    {

        $url=env("API_DIR")."configurarDobleFactorAutenticacion";
        $conjuntoParametros=[
            'usuario'              =>env("API_USUARIO"),
            'clave'                =>env("API_CLAVE"),
            'id_empresa'           =>trim(session()->get("id_cliente")),
            'id_usuario'           =>trim(session()->get("id_usuario")),
            'doble_autenticacion'  => $request['activateTwoFactorAuth'],
            'celular'              => $this->general->formatPhoneNumber($request['codigo'], str_replace('_', '', $request['telefono_factor'])),
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

       return redirect()->route('two');
    }

    public function verificar2FA(Request $request)
    {
        $url=env("API_DIR")."validarCodigoDobleAutenticacion";
        $conjuntoParametros=[
            'usuario'              => env("API_USUARIO"),
            'clave'                => env("API_CLAVE"),
            'id_empresa'           => trim(session()->get("id_cliente")),
            'id_usuario'           => trim(session()->get("id_usuario")),
            'codigo_autenticacion' => SecureValue::encode(trim($request['codigo_validacion']), env("TOKEN_SECURE_VALUE"), env("KEY_SECURE_VALUE"), env("SUBKEY_SECURE_VALUE"), true)
        ];

        $respuesta=$this->general->consultaApiMedianteParametros($url, $conjuntoParametros);

        if($respuesta['estado'] == 'ok')
        {
            if($respuesta['info'] == 'incorrecto'){
                $mensaje1='Código incorrecto';
                return redirect()->back()->withInput(request()->all())->withErrors([
                    'mensaje1'=>$mensaje1
                ]);
            }else{
                session()->forget('two_factor_enabled');
                session()->forget('codigo_enviado');
                return redirect()
                ->route('home')
                ->withSuccess("Código de ingreso correcto.!");
            }
        }
    }
}
