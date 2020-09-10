<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    //use SoftDeletes;
    protected $table = 'l_roles';
    protected $primaryKey = 'id_rol';
    protected $dates = ['deleted_at'];
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'modulo', 'estatus',
    ];
}