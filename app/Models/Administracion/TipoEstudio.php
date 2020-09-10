<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class TipoEstudio extends Model
{
    protected $table = 'l_tipo_estudio';
    protected $primaryKey = 'id_tipo_estudio';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'estatus',
    ];
}
