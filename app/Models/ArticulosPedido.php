<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticulosPedido
 *
 * @property $id
 * @property $pedido_id
 * @property $nombre
 * @property $color
 * @property $cantidad
 * @property $tipo_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Pedido $pedido
 * @property Tipo $tipo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ArticulosPedido extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['pedido_id', 'nombre', 'color', 'cantidad', 'tipo_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedido()
    {
        return $this->belongsTo(\App\Models\Pedido::class, 'pedido_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo()
    {
        return $this->belongsTo(\App\Models\Tipo::class, 'tipo_id', 'id');
    }
    
}
