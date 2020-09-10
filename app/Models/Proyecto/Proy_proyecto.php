<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Proy_proyecto extends Model
{
    protected $table = 'proy_proyectos';
    protected $primaryKey = 'id_proyecto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'cliente', 'fecha_inicio', 'fecha_fin', 'created_user_at', 'updated_user_at',
    ];
}
