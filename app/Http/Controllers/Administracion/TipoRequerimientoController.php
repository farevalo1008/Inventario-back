<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\TipoRequerimiento;
use App\User;

class TipoRequerimientoController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearTipoRequerimiento(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $reque = new TipoRequerimiento();
            $reque->descripcion = $params->descripcion;
            $reque->estatus = $params->estatus;
            $reque->save();
        //return $request->all();
        return response()->json($reque,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarTipoRequerimiento(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $reque = TipoRequerimiento::find($id);
            $reque->descripcion = $params->descripcion;
            $reque->save();
        //return $request->all();
        return response()->json($reque,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarTipoRequerimiento($id){
        
        
        $reque = TipoRequerimiento::find($id);
        $reque->estatus=true;
        $reque->save();
       
    return response()->json($reque,200);
    }

    public function desactivarTipoRequerimiento($id){
        
        
        $reque = TipoRequerimiento::find($id);        
        $reque->estatus=false;
        $reque->save();
       
    return response()->json($reque,200);
    }
}
