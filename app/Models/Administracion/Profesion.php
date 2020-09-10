<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesion extends Model
{
    //use SoftDeletes;
    protected $table = 'l_profesion';
    protected $primaryKey = 'id_profesion';
    //protected $dates = ['deleted_at'];
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'estatus',
    ];
}
