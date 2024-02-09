<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class NoticiasRequest extends FormRequest
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
            'titulo' => 'required|max:100',
            'descripcion'  => 'required|max:200',
            'estado' => 'required|max:10',
            'fechaPublicacion' => 'required|max:10',
            'url_web' => '',
        ];
    }
}
