<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Conocimientos;
use App\User;

class ConocimientosController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearConocimientos(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $cono = new Conocimientos();
            $cono->descripcion = $params->descripcion;
            $cono->estatus = $params->estatus;
            $cono->save();
        //return $request->all();
        return response()->json($cono,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarConocimientos(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $cono = Conocimientos::find($id);
            $cono->descripcion = $params->descripcion;
            $cono->save();
        //return $request->all();
        return response()->json($cono,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarConocimientos($id){
        
        
        $cono = Conocimientos::find($id);      
        $cono->estatus=true;
        $cono->save();
       
    return response()->json($cono,200);
    }

    public function desactivarConocimientos($id){
        
        
        $cono = Conocimientos::find($id);
        $cono->estatus=false;
        $cono->save();
       
    return response()->json($cono,200);
    }

}
