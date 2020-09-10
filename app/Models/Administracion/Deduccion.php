<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Deduccion extends Model
{
    //use SoftDeletes;
    protected $table = 'nom_l_deducciones';
    protected $primaryKey = 'id_deduccion';
    //protected $dates = ['estatus'];
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'codigo', 'valor_de_ley', 'articulo_legal', 'valor_agregado', 'observaciones', 'estatus',
    ];
}
