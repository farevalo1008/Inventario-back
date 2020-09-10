<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model 
{
    protected $table = 'rcl_candidato';
    protected $primaryKey = 'id_candidato';

    public function user(){
        return $this->hasOne('App\User', 'id_user');
    }
}
