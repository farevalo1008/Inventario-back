<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'l_modulos';
    protected $primaryKey = 'id_modulo';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'estatus',
    ];
}
