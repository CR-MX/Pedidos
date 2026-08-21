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
class LugareCoco extends Model
{
    protected $table = 'lugares_cocos';

    protected $fillable = ['nombre'];

    protected $perPage = 20;

    public function pedidos(): HasMany
    {
        return $this->hasMany(PedidoCoco::class, 'lugar_id', 'id');
    }
}
