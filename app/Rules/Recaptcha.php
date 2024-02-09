<?php

namespace App\Rules;

use \Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{

    public function __construct(){
        //
    }

    public function passes($attribute, $value){

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
            'secret'=>env('reCAPTCHA_site_key_servidor'),
            'response' => $value
        ])->object();

        if($response->success && $response->score >= 0.6 ){
           return true;
        }

        return false;

    }

    public function message(){
       return 'La verificación de reCAPTCHA ha fallado';
    }

}
