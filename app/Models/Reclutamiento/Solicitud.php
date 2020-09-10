<?php

namespace App\Models\Reclutamiento;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
	protected $table = 'rcl_solicitud';
    protected $primaryKey = 'id_solicitud';

    public function user(){
        return $this->hasOne('App\User', 'id_user');
    }
}
