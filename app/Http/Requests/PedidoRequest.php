<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'articulos.required' => 'Se necesita agregar por lo menos un artículo',
            'articulos.min' => 'Se necesita agregar por lo menos un artículo',
        ];
    }

    public function rules(): array
    {
        return [
			'nombre' => 'required|string',
			'red_social' => 'nullable|string',
			'anticipo' => 'required',
			'total' => 'required',
			'fecha_hora_entrega' => 'required',
			'lugar_id' => 'required',
			'informacion_adicional' => 'nullable|string',
			'articulos' => 'required|array|min:1',
			'articulos.*.nombre' => 'required|string',
			'articulos.*.color' => 'required|string',
			'articulos.*.cantidad' => 'required|integer',
			'articulos.*.tipo_id' => 'required|integer',
        ];
    }
}
