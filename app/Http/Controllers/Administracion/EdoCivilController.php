<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\EdoCivil;
use App\User;

class EdoCivilController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearEdoCivil(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $edo = new EdoCivil();
            $edo->descripcion = $params->descripcion;
            $edo->abreviacion = $params->abreviacion;
            $edo->estatus = $params->estatus;
            $edo->save();
        //return $request->all();
        return response()->json($edo,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarEdoCivil(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $edo = EdoCivil::find($id);
            $edo->descripcion = $params->descripcion;
            $edo->abreviacion = $params->abreviacion;
            $edo->save();
        //return $request->all();
        return response()->json($edo,200);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarEdoCivil($id){
        
        
        $edo = EdoCivil::find($id);
        $edo->estatus=true;
        $edo->save();
       
    return response()->json($edo,200);
    }

    public function desactivarEdoCivil($id){
        
        
        $edo = EdoCivil::find($id);        
        $edo->estatus=false;
        $edo->save();
       
    return response()->json($edo,200);
    }
    
}
