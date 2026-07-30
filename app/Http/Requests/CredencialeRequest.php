<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CredencialeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'foto' => 'nullable|string',
            'firma' => 'nullable|string',
            'curp' => 'nullable|string|max:18',
            'apellido_paterno' => 'nullable|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'nombres' => 'nullable|string|max:200',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_expedicion' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'tipo_licencia' => 'nullable|string|max:50',
            'numero_licencia' => 'nullable|string|max:50',
            'oficina_emisora_id' => 'required|exists:oficinas_emisoras,id',
            'fecha_antiguedad' => 'nullable|date',
            'sexo' => 'nullable|string|max:1',
            'tipo_sangre' => 'nullable|string|max:5',
            'donador_organos' => 'nullable|boolean',
            'restricciones' => 'nullable|string',
            'en_caso_accidente_nombre' => 'nullable|string|max:200',
            'en_caso_accidente_numero' => 'nullable|string|max:20',
        ];
    }
}
