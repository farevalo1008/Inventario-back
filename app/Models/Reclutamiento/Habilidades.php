<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class Habilidades extends Model
{
    protected $table = 'rcl_candidato_habilidades';
    protected $primaryKey = 'id_candidato_habilidades';

    public function candidato(){
        return $this->hasOne('App\Candidato', 'id_candidato');
    }
}
