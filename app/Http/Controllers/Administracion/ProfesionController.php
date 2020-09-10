<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Profesion;
use App\User;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearProfesion(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $profesion = new Profesion();
            $profesion->descripcion = $params->descripcion;
            $profesion->estatus = $params->estatus;
            $profesion->save();
        //return $request->all();
        return response()->json($profesion,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarProfesion(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $profesion = Profesion::find($id);
            $profesion->descripcion = $params->descripcion;
            $profesion->save();
        //return $request->all();
        return response()->json($profesion,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarProfesion($id){
        
        $profesion = Profesion::find($id);
        
        $profesion->estatus=true;

        $profesion->save();
        
    //return $request->all();
    return response()->json($profesion,200);
    }

    public function desactivarProfesion($id){
        
        $profesion = Profesion::find($id);
        
        $profesion->estatus=false;

        $profesion->save();
        
    //return $request->all();
    return response()->json($profesion,200);
    }
}
