<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\AreaTrabajo;
use App\User;


class AreaTrabajoController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearAreasTrabajo(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $area = new AreaTrabajo();
            $area->descripcion = $params->descripcion;
            $area->estatus = $params->estatus;
            $area->save();
        //return $request->all();
        return response()->json($area,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarAreasTrabajo(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $area = AreaTrabajo::find($id);
            $area->descripcion = $params->descripcion;
            $area->save();
        //return $request->all();
        return response()->json($area,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarAreasTrabajo($id){
        
        
        $area = AreaTrabajo::find($id);
        $area->estatus=true;
        $area->save();
       
    return response()->json($area,200);
    }

    public function desactivarAreasTrabajo($id){
        
        
        $area = AreaTrabajo::find($id);        
        $area->estatus=false;
        $area->save();
       
    return response()->json($area,200);
    }
}
