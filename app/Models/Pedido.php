<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property $id
 * @property $nombre
 * @property $red_social
 * @property $anticipo
 * @property $fecha_hora_entrega
 * @property $lugar_id
 * @property $informacion_adicional
 * @property $created_at
 * @property $updated_at
 *
 * @property Lugare $lugare
 * @property ArticulosPedido[] $articulosPedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'red_social', 'anticipo', 'total', 'fecha_hora_entrega', 'lugar_id', 'informacion_adicional', 'entrega'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lugare()
    {
        return $this->belongsTo(\App\Models\Lugare::class, 'lugar_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articulosPedidos()
    {
        return $this->hasMany(\App\Models\ArticulosPedido::class, 'pedido_id', 'id');
    }
    
}
