<?php

namespace App\Http\Controllers\Panel\Login;

use App\Funciones\Generales\funcionesGenerales;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BannerController;
use Session;

class LoginAdminController extends Controller
{
    private $general;
    private $banner;
    public function __construct()
    {
        $this->general = new funcionesGenerales();
        $this->banner  = new BannerController();
    }

    public function showLoginForm()
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
        return view('panel.autenticacion.login')->with([
            'banner' => $banner,
            'login' => 'si',
        ]);
    }

    public function panelLogin(Request $request)
    {
        $this->validateLogin($request);

        //recolección de datos
        $user = base64_encode($request['usuario']);
        $password = base64_encode($request['password']);

        
        //variables a usar en el api
        $url =  env("API_DIR")."loginPanelAdministrativo";
    
        $conjuntoParametros = [
            'usuario'           => env("API_USUARIO"),
            'clave'             => env("API_CLAVE"),
            'usuario_sistema'   => $request->usuario,     
            'password'          => $request->password
        ];

       
        $respuesta = $this->general->consultaApiMedianteParametros($url,$conjuntoParametros);

        if($respuesta['estado'] === 'error')
        {
            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors(['usuario'=>'Error en usuario o contraseña']);
        }

        session(['empresa' => 'CyberFuel',
            'name'  => $respuesta['info']['name'],
            'email' => $respuesta['info']['email'],
            'id_cliente' => 0,
            'sessionWS'=> 'activa']);


        return redirect()->route('clientes.index');
    }



    protected function validateLogin(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);
    }

    public function panelLogout(Request $request)
    {
        $request->session()->invalidate();

        return redirect()->route('panel');
    }
}
