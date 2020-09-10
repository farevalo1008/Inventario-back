<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class CitaProceso extends Model
{
    protected $table = 'rcl_candidato_entrevista';
    protected $primaryKey = 'id_candidato_entrevista';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
