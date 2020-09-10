<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class RechazoContrato extends Model
{
    protected $table = 'rcl_candidato_contrato_rechazo';
    protected $primaryKey = 'id_contrato_rechazo';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
