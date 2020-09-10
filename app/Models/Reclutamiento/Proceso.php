<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'rcl_candidato_proceso';
    protected $primaryKey = 'id_candidato_proceso';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
