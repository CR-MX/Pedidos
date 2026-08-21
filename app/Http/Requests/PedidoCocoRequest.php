<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoCocoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'articulos.required' => 'Se necesita agregar por lo menos un artículo',
            'articulos.min' => 'Se necesita agregar por lo menos un artículo',
        ];
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'red_social' => 'nullable|string',
            'anticipo' => 'required',
            'total' => 'required',
            'fecha_hora_entrega' => 'nullable',
            'lugar_id' => 'required',
            'informacion_adicional' => 'nullable|string',
            'entrega' => 'required|in:pendiente,entregado',
            'articulos' => 'required|array|min:1',
            'articulos.*.nombre' => 'required|string',
            'articulos.*.color' => 'required|string',
            'articulos.*.cantidad' => 'required|integer',
            'articulos.*.tipo_id' => 'required|integer',
        ];
    }
}
