<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Estatus;
use App\User;

class EstatusController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearEstatus(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $status = new Estatus();
            $status->modulo = $params->modulo;
            $status->descripcion = $params->descripcion;
            $status->estatus = $params->estatus;
            $status->save();
        //return $request->all();
        return response()->json($status,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarEstatus(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $status = Estatus::find($id);
            $status->modulo = $params->modulo;
            $status->descripcion = $params->descripcion;
            $status->save();
        //return $request->all();
        return response()->json($status,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarEstatus($id){
        
        
        $status = Estatus::find($id);
        $status->estatus=true;
        $status->save();
       
    return response()->json($status,200);
    }

    public function desactivarEstatus($id){
        
        
        $status = Estatus::find($id);        
        $status->estatus=false;
        $status->save();
       
    return response()->json($status,200);
    }
}
