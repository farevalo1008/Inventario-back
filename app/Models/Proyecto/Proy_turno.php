<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Proy_turno extends Model
{
    protected $table = 'proy_turnos';
    protected $primaryKey = 'id_turno';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'created_user_at', 'updated_user_at',
    ];
}
