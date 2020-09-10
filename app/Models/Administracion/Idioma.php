<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table = 'l_idiomas';
    protected $primaryKey = 'id_idioma';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'estatus',
    ];
}
