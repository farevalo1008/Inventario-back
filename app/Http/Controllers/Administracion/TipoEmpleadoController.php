<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\TipoEmpleado;
use App\User;

class TipoEmpleadoController extends Controller
{
     /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearTipoEmpleado(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $tpemp = new TipoEmpleado();
            $tpemp->codigo = $params->codigo;
            $tpemp->descripcion = $params->descripcion;
            $tpemp->estatus = $params->estatus;
            $tpemp->save();
        //return $request->all();
        return response()->json($tpemp,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarTipoEmpleado(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $tpemp = TipoEmpleado::find($id);
            $tpemp->codigo = $params->codigo;
            $tpemp->descripcion = $params->descripcion;
            $tpemp->save();
        //return $request->all();
        return response()->json($tpemp,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarTipoEmpleado($id){
        
        //$params =  json_decode($json);
        
        $tpemp = TipoEmpleado::find($id);
        
        $tpemp->estatus=true;
        
        $tpemp->save();
       
    return response()->json($tpemp,200);
    }

    public function desactivarTipoEmpleado($id){
        
        //$params =  json_decode($json);
        
        $tpemp = TipoEmpleado::find($id);
        
        $tpemp->estatus=false;
        
        $tpemp->save();
        //$cargo->delete();
   
        
    return response()->json($tpemp,200);
    }
}
