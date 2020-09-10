<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class EdoCivil extends Model
{
    protected $table = 'l_edo_civil';
    protected $primaryKey = 'id_edo_civil';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'abreviacion', 'estatus',
    ];
}
