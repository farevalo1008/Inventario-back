<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    //
    protected $table = 'cars';
    protected $primaryKey = 'id_cars';

    //relacion con la tabla usuario
    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

}
