<?php

namespace App\Models\Documentos;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table = 'doc_documentos';
    protected $primaryKey = 'id_documento';

    public function departamentos(){
        return $this->hasMany('App\Departamentos', 'id_departamento');
    }

    public function procedencias(){
        return $this->hasMany('App\Procedencias', 'id_procedencia');
    }
    public function tipo_documentos(){
        return $this->hasMany('App\Tipo_Documentos', 'id_tipo_doc');
    }
    public function clientes(){
        return $this->hasMany('App\Clientes', 'id_cliente');
    }
     public function extension(){
        return $this->hasMany('App\Extension', 'id_extension');
    }
}




