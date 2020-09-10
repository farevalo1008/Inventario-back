<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Actv_user extends Model
{
    protected $table = 'proy_actv_user';
    protected $primaryKey = 'id_act_user';

    public function users(){
        return $this->hasMany('App\Models\DatosPersonales', 'id_datpers');
    }

    public function proy_tarea(){
        return $this->hasMany('App\Models\proyecto\Proy_tareas', 'id_actividad');
    }
}

