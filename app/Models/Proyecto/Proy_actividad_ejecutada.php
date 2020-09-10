<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Proy_actividad_ejecutada extends Model
{
    protected $table = 'proy_actividades_ejecutadas';
    protected $primaryKey = 'id_actividad_ejec';

    public function Proy_tarea(){
        return $this->hasMany('App\Models\proyecto\Proy_tareas', 'id_actividad');
    }
}
