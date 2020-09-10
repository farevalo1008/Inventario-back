<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Modulo;
use App\User;

class ModulosController extends Controller
{
    public function crearModulos(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $mod = new Modulo();
            $mod->descripcion = $params->descripcion;
            $mod->abreviacion = $params->abreviacion;
            $mod->estatus = $params->estatus;
            $mod->save();
        //return $request->all();
        return response()->json($mod,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarModulo(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $mod = Modulo::find($id);
            $mod->descripcion = $params->descripcion;
            $mod->abreviacion = $params->abreviacion;
            $mod->save();
        //return $request->all();
        return response()->json($mod,200);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarModulo($id){
        
        
        $mod = Modulo::find($id);
        $mod->estatus=true;
        $mod->save();
       
    return response()->json($mod,200);
    }

    public function desactivarModulo($id){
        
        
        $mod = Modulo::find($id);        
        $mod->estatus=false;
        $mod->save();
       
    return response()->json($mod,200);
    }
}
