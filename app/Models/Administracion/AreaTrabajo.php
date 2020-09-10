<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaTrabajo extends Model
{
    protected $table = 'l_area_trabajo';
    protected $primaryKey = 'id_area_trabajo';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'estatus',
    ];
}
