<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Act_periodo extends Model
{
    protected $table = 'proy_actv_periodos';
    protected $primaryKey = 'id_actividad_periodo';

    public function proy_tarea(){
        return $this->hasMany('App\Models\proyecto\proy_tareas', 'id_actividad');
    }

    public function proy_periodo(){
        return $this->hasMany('App\Models\proyecto\proy_periodos', 'id_periodo');
    }
}
