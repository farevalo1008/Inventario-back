<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Conocimientos extends Model
{
    protected $table = 'l_conocimientos';
    protected $primaryKey = 'id_conocimiento';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'estatus',
    ];
}
