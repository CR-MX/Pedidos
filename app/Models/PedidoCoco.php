<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $red_social
 * @property float $anticipo
 * @property float $total
 * @property \Carbon\Carbon|null $fecha_hora_entrega
 * @property int $lugar_id
 * @property string|null $informacion_adicional
 * @property string $entrega
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PedidoCoco extends Model
{
    protected $table = 'pedidos_cocos';

    protected $fillable = [
        'nombre',
        'red_social',
        'anticipo',
        'total',
        'fecha_hora_entrega',
        'lugar_id',
        'informacion_adicional',
        'entrega',
    ];

    protected $perPage = 20;

    public function lugare(): BelongsTo
    {
        return $this->belongsTo(LugareCoco::class, 'lugar_id', 'id');
    }

    public function articulosPedidos(): HasMany
    {
        return $this->hasMany(ArticulosPedidoCoco::class, 'pedido_id', 'id');
    }
}
