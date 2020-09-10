<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class ObservacionProceso extends Model
{
    protected $table = 'rcl_candidato_observaciones';
    protected $primaryKey = 'id_candidato_observaciones';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
