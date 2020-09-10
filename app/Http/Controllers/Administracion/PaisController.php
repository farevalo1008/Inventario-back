<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Pais;
use App\User;

class PaisController extends Controller
{
     /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearPais(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $pais = new Pais();
            $pais->descripcion = $params->descripcion;
            $pais->abreviacion = $params->abreviacion;
            $pais->estatus = $params->estatus;
            $pais->save();
        //return $request->all();
        return response()->json($pais,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarPais(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $pais = Pais::find($id);
            $pais->descripcion = $params->descripcion;
            $pais->abreviacion = $params->abreviacion;
            $pais->save();
        //return $request->all();
        return response()->json($pais,200);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarPais($id){
        
        
        $pais = Pais::find($id);
        $pais->estatus=true;
        $pais->save();
       
    return response()->json($pais,200);
    }

    public function desactivarPais($id){
        
        
        $pais = Pais::find($id);        
        $pais->estatus=false;
        $pais->save();
       
    return response()->json($pais,200);
    }
}
