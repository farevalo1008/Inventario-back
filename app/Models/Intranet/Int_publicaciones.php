<?php

namespace App\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Int_publicaciones extends Model
{
    protected $fillable = [
        'user_name', 'publicacion', 'departamento',
    ];
}
