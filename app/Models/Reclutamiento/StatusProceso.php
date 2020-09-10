<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class StatusProceso extends Model
{
    protected $table = 'rcl_candidato_status';
    protected $primaryKey = 'id_candidato_status';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
