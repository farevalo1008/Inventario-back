<?php

namespace App\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Int_control_asistencia extends Model
{
    protected $fillable = [
        'user_id', 'fecha', 'hora_entrada', 'hora_salida_almuerzo', 'hora_entrada_almuerzo', 'hora_salida', 'evento', 'observaciones', 'hora_diaria', 'pausa_activa', 'hora_entrada_pausa_activa', 'hora_salida_pausa_activa', 'status_otros', 'hora_salida_otros', 'hora_entrada_otros',
    ];
}
