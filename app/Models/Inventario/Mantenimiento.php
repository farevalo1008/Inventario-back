<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'inv_mantenimiento';
    protected $primaryKey = 'id_mante';

    public function articulo(){
        return $this->hasMany('App\Models\Inventario\Articulo');
    }

    
}