<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargos extends Model
{
    //use SoftDeletes;
    protected $table = 'l_cargos';
    protected $primaryKey = 'id_cargo';
    //protected $dates = ['estatus'];
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'estatus',
    ];
}
