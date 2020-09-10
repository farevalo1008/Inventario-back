<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class SolicitudCandidato extends Model
{
    protected $table = 'rcl_solicitud_candidato';
    protected $primaryKey = 'id_solicitud_candidato';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }

    public function solicitud(){
        return $this->hasOne('App\Solicitud', 'id_solicitud');
    }
}
