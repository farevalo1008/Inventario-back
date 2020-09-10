<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class DatosLaborales extends Model
{
    protected $table = 'rcl_candidato_datos_laborales';
    protected $primaryKey = 'id_candidato_datos_laborales';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
