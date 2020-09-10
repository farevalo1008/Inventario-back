<?php

namespace App\Models\Documentos;

use Illuminate\Database\Eloquent\Model;

class Doc_documento extends Model
{

	protected $table = 'doc_documentos';
	protected $primaryKey = 'id_documento';
	

    protected $fillable = [
        'nombre', 'descripcion', 'fecha_emision', 'fecha_entrega','ruta', 'codigo','destinatario','origen','id_departamento','id_cliente','id_extension','id_tipo_doc'
    ];
}

          
