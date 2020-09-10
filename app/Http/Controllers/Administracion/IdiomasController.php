<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Idioma;
use App\User;

class IdiomasController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearIdioma(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $idio = new Idioma();
            $idio->descripcion = $params->descripcion;
            $idio->abreviacion = $params->abreviacion;
            $idio->estatus = $params->estatus;
            $idio->save();
        //return $request->all();
        return response()->json($idio,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarIdioma(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $idio = Idioma::find($id);
            $idio->descripcion = $params->descripcion;
            $idio->abreviacion = $params->abreviacion;
            $idio->save();
        //return $request->all();
        return response()->json($idio,200);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarIdioma($id){
        
        
        $idio = Idioma::find($id);
        $idio->estatus=true;
        $idio->save();
       
    return response()->json($idio,200);
    }

    public function desactivarIdioma($id){
        
        
        $idio = Idioma::find($id);        
        $idio->estatus=false;
        $idio->save();
       
    return response()->json($idio,200);
    }
}
