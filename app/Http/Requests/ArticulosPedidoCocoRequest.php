<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticulosPedidoCocoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pedido_id' => 'required',
            'nombre' => 'required|string',
            'color' => 'required|string',
            'cantidad' => 'required',
            'tipo_id' => 'required',
        ];
    }
}
