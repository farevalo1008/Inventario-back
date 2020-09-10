<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    protected $table = 'rcl_candidato_archivos';
    protected $primaryKey = 'id_candidato_archivos';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
