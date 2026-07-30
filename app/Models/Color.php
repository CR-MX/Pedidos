<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colores';

    protected $perPage = 20;

    protected $fillable = ['nombre'];
}
