<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColaboradoresRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tipoIdentificacion' => 'required|numeric',
            'identificacion'  => 'required|max:50',
            'nombre1' => 'required|max:50',
            'nombre2' => '',
            'apellido1' => 'required|max:50',
            'apellido2' => 'required|max:50',
            'genero' => 'required|numeric',
            'fechaNacimiento' => 'required|max:10',
            'estadoCivil' => 'required|numeric',
            'telefonoCelular' => 'required',
            'telefonoCasa' => '',
            'correoPersonal' => 'required',
            'provincia'  => 'required|numeric',
            'canton' => 'required|numeric',
            'distrito'   => 'required|numeric',
            'barrio' => 'required|numeric',
            'direccion' => 'required',
            'numeroColaborador'  => '',
        ];
    }
}
