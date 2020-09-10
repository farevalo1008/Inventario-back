<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

class UsuarioArticulo extends Model
{
    protected $table = 'inv_usuario_articulo';
    protected $primaryKey = 'id_usuario_art';

    public function datospersonales(){
        return $this->belongsTo('App\Models\Inventario\DatosPersonales', 'id_datpers');
    }

    public function articulo(){
        return $this->hasMany('App\Models\Inventario\Articulo');
    }


}
