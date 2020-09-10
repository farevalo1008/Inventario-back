<?php

namespace App\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Int_actividades extends Model
{
    protected $fillable = [
        'fecha_inicio', 'fecha_fin', 'encargado', 'titulo', 'descripcion',
    ];
}
