<?php

namespace App\Http\Requests\Panel\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class CatalogoFeriadoRequest extends FormRequest
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
            'celebracion' => 'required|max:200',
            'fechaFeriado'  => 'required|max:10',
            'fechaTraslado' => 'required|max:10',
            'pagoObligatorio' => 'required|max:10',
        ];
    }
}
