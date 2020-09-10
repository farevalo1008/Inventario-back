<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Nivel;
use App\User;

class NivelController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearNivel(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $niv = new Nivel();
            $niv->descripcion = $params->descripcion;
            $niv->estatus = $params->estatus;
            $niv->save();
        //return $request->all();
        return response()->json($niv,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarNivel(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $niv = Nivel::find($id);
            $niv->descripcion = $params->descripcion;
            $niv->save();
        //return $request->all();
        return response()->json($niv,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarNivel($id){
        
        
        $niv = Nivel::find($id);
        $niv->estatus=true;
        $niv->save();
       
    return response()->json($niv,200);
    }

    public function desactivarNivel($id){
        
        
        $niv = Nivel::find($id);        
        $niv->estatus=false;
        $niv->save();
       
    return response()->json($niv,200);
    }
}
