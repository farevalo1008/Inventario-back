<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class TipoRequerimiento extends Model
{
    protected $table = 'l_tipo_requerimiento';
    protected $primaryKey = 'id_tipo_requerimiento';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'estatus',
    ];
}
