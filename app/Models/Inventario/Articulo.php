<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'inv_articulo';
    protected $primaryKey = 'id_articulo';

    public function clasificacion(){
        return $this->belongsTo('App\Models\Inventario\Clasificacion', 'id_clas_art');
    }

    public function tipoarticulo(){
        return $this->belongsTo('App\Models\Inventario\TipoArticulo', 'id_tipo_articulo');
    }

    public function status(){
        return $this->belongsTo('App\Models\Inventario\Status', 'id_status');
    }
}