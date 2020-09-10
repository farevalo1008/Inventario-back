<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Deduccion;
use App\User;

class DeduccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearDeducciones(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $deduc = new Deduccion();
            $deduc->descripcion = $params->descripcion;
            $deduc->codigo = $params->codigo;
            $deduc->valor_de_ley = $params->valor_de_ley;
            $deduc->articulo_legal = $params->articulo_legal;
            $deduc->valor_agregado = $params->valor_agregado;
            $deduc->observaciones = $params->observaciones;
            $deduc->estatus = $params->estatus;
            $deduc->save();
        //return $request->all();
        return response()->json($deduc,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarDeducciones(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

        $deduc = Deduccion::find($id);
        $deduc->descripcion = $params->descripcion;
        $deduc->codigo = $params->codigo;
        $deduc->valor_de_ley = $params->valor_de_ley;
        $deduc->articulo_legal = $params->articulo_legal;
        $deduc->valor_agregado = $params->valor_agregado;
        $deduc->observaciones = $params->observaciones;
        $deduc->save();
        //return $request->all();
        return response()->json($deduc,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarDeducciones($id){
        
        //$params =  json_decode($json);
        
        $deduc = Deduccion::find($id);
        
        $deduc->estatus=true;
        
        $deduc->save();
       
        
    //return $request->all();
    return response()->json($deduc,200);
    }

    public function desactivarDeducciones($id){
        
        //$params =  json_decode($json);
        
        $deduc = Deduccion::find($id);
       
        $deduc->estatus=false;
        
        $deduc->save();
     
    return response()->json($deduc,200);
    }
}
