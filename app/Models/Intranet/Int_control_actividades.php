<?php

namespace App\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Int_control_actividades extends Model
{
    protected $fillable = [
        'user_id', 'fecha', 'tipo_actividad_id', 'hora', 'descripcion',
    ];
}
