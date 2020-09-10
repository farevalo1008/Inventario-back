<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class DatosAcademicos extends Model
{
    protected $table = 'rcl_candidato_datos_academicos';
    protected $primaryKey = 'id_candidato_datos_academicos';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
