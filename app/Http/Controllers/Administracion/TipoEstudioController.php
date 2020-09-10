<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\TipoEstudio;
use App\User;

class TipoEstudioController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearTipoEstudio(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $tipo = new TipoEstudio();
            $tipo->descripcion = $params->descripcion;
            $tipo->estatus = $params->estatus;
            $tipo->save();
        //return $request->all();
        return response()->json($tipo,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarTipoEstudio(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $tipo = TipoEstudio::find($id);
            $tipo->descripcion = $params->descripcion;
            $tipo->save();
        //return $request->all();
        return response()->json($tipo,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarTipoEstudio($id){
        
        
        $tipo = TipoEstudio::find($id);
        $tipo->estatus=true;
        $tipo->save();
       
    return response()->json($tipo,200);
    }

    public function desactivarTipoEstudio($id){
        
        
        $tipo = TipoEstudio::find($id);        
        $tipo->estatus=false;
        $tipo->save();
       
    return response()->json($tipo,200);
    }
}
