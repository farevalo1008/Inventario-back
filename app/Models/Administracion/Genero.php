<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'l_genero';
    protected $primaryKey = 'id_genero';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'estatus',
    ];
}
