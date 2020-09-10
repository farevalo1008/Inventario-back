<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Model;

class Proy_tarea extends Model
{
     protected $table = 'proy_tareas';
    protected $primaryKey = 'id_actividad';

    public function Proy_tarea(){
        return $this->hasMany('App\Models\proyecto\proy_proyectos', 'id_proyecto');
    }
}
