<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    protected $table = 'nom_l_tipo_empleado';
    protected $primaryKey = 'id_tipo_empleado';
    //protected $dates = ['estatus'];
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'descripcion', 'estatus',
    ];
}
