<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Cargos;
use App\User;


class CargosController extends Controller
{
    

    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearCargos(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $cargo = new Cargos();
            $cargo->descripcion = $params->descripcion;
            $cargo->abreviacion = $params->abreviacion;
            $cargo->estatus = $params->estatus;
            $cargo->save();
        //return $request->all();
        return response()->json($cargo,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarCargos(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $cargo = Cargos::find($id);
            $cargo->descripcion = $params->descripcion;
            $cargo->abreviacion = $params->abreviacion;
            $cargo->save();
        //return $request->all();
        return response()->json($cargo,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarCargos($id){
        
        //$params =  json_decode($json);
        
        $cargo = Cargos::find($id);
        //var_dump($cargo);die;
        //$cargo->estatus = $params->estatus;

        
        $cargo->estatus=true;
        
        $cargo->save();
        //$cargo->delete();
   
        
    //return $request->all();
    return response()->json($cargo,200);
    }

    public function desactivarCargos($id){
        
        //$params =  json_decode($json);
        
        $cargo = Cargos::find($id);
        //var_dump($cargo);die;
        //$cargo->estatus = $params->estatus;

        
        $cargo->estatus=false;
        
        $cargo->save();
        //$cargo->delete();
   
        //$cargo->save();
    //return $request->all();
    return response()->json($cargo,200);
    }
    
}
