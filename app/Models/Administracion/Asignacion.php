<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'nom_l_asignaciones';
    protected $primaryKey = 'id_asignacion';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'codigo', 'tipo',
    ];
}
