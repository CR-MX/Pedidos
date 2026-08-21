<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorCoco extends Model
{
    protected $table = 'colores_cocos';

    protected $fillable = ['nombre'];

    protected $perPage = 20;
}
