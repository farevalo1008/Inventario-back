<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'l_pais';
    protected $primaryKey = 'id_pais';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'estatus',
    ];
}
