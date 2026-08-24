<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $pedido_id
 * @property string $nombre
 * @property string $color
 * @property int $cantidad
 * @property int $tipo_id
 * @property bool $realizado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ArticulosPedidoCoco extends Model
{
    protected $table = 'articulos_pedidos_cocos';

    protected $fillable = [
        'pedido_id',
        'nombre',
        'color',
        'cantidad',
        'unidad',
        'tipo_id',
        'realizado',
    ];

    protected $casts = [
        'realizado' => 'boolean',
    ];

    protected $perPage = 20;

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(PedidoCoco::class, 'pedido_id', 'id');
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(TipoCoco::class, 'tipo_id', 'id');
    }
}
