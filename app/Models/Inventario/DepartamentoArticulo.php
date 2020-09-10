<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

class DepartamentoArticulo extends Model
{
    protected $table = 'inv_departamento_articulo';
    protected $primaryKey = 'id_departamento_art';

    public function articulo(){
        return $this->hasMany('App\Models\Inventario\Articulo');
    }

    public function departamento(){
        return $this->belongsTo('App\Models\Inventario\Departamento', 'id_dep');
    }
}