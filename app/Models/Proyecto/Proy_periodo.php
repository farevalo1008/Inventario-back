<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Proy_periodo extends Model
{
  	protected $table = 'proy_periodos';
    protected $primaryKey = 'id_periodo';

    public function candidato(){
        return $this->hasMany('App\Models\proyecto\Proy_turnos', 'id_turno');
    }
}
