<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = 'l_status';
    protected $primaryKey = 'id_status';
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modulo', 'descripcion', 'estatus',
    ];
}
