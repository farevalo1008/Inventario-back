<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'l_nivel';
    protected $primaryKey = 'id_nivel';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'estatus',
    ];
}
