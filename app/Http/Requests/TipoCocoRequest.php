<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoCocoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string',
        ];
    }
}
