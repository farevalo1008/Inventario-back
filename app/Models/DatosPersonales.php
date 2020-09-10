<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosPersonales extends Model
{
    protected $table = 'datos_personales';
    protected $primaryKey = 'id_datpers';

    public function user(){
        return $this->hasOne('App\User', 'id_user');
    }

   
}
