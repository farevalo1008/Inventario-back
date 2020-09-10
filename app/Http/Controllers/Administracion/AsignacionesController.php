<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Asignacion;
use App\User;

class AsignacionesController extends Controller
{
     /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearAsignaciones(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $asig = new Asignacion();
            $asig->descripcion = $params->descripcion;
            $asig->codigo = $params->codigo;
            $asig->tipo = $params->tipo;
            $asig->estatus = $params->estatus;
            $asig->save();
        //return $request->all();
        return response()->json($asig,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarAsignaciones(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $asig = Asignacion::find($id);
            $asig->descripcion = $params->descripcion;
            $asig->codigo = $params->codigo;
            $asig->tipo = $params->tipo;
            $asig->save();
        //return $request->all();
        return response()->json($asig,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarAsignaciones($id){
        
        //$params =  json_decode($json);
        
        $asig = Asignacion::find($id);
        
        $asig->estatus=true;
        
        $asig->save();
       
        
    //return $request->all();
    return response()->json($asig,200);
    }

    public function desactivarAsignaciones($id){
        
        //$params =  json_decode($json);
        
        $asig = Asignacion::find($id);
       
        $asig->estatus=false;
        
        $asig->save();
     
    return response()->json($asig,200);
    }
}
