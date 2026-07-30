<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Credenciale
 *
 * @property $id
 * @property $foto
 * @property $firma
 * @property $curp
 * @property $apellido_paterno
 * @property $apellido_materno
 * @property $nombres
 * @property $fecha_nacimiento
 * @property $fecha_expedicion
 * @property $fecha_vencimiento
 * @property $tipo_licencia
 * @property $oficina_emisora
 * @property $fecha_antiguedad
 * @property $sexo
 * @property $tipo_sangre
 * @property $donador_organos
 * @property $restricciones
 * @property $en_caso_accidente_nombre
 * @property $en_caso_accidente_numero
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Credenciale extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['foto', 'firma', 'curp', 'apellido_paterno', 'apellido_materno', 'nombres', 'fecha_nacimiento', 'fecha_expedicion', 'fecha_vencimiento', 'tipo_licencia', 'oficina_emisora_id', 'fecha_antiguedad', 'sexo', 'tipo_sangre', 'donador_organos', 'restricciones', 'en_caso_accidente_nombre', 'en_caso_accidente_numero','numero_licencia'];

    public function oficinaEmisora()
    {
        return $this->belongsTo(OficinasEmisora::class, 'oficina_emisora_id');
    }
}
