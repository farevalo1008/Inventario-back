<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class ContratoCandidato extends Model
{
    protected $table = 'rcl_candidato_contrato';
    protected $primaryKey = 'id_contrato';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
