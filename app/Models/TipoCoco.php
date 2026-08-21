<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $nombre
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoCoco extends Model
{
    protected $table = 'tipos_cocos';

    protected $fillable = ['nombre'];

    protected $perPage = 20;

    public function articulosPedidos(): HasMany
    {
        return $this->hasMany(ArticulosPedidoCoco::class, 'tipo_id', 'id');
    }
}
