<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Nacionalidad;
use App\User;

class NacionalidadController extends Controller
{
     /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearNacionalidad(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $nac = new Nacionalidad();
           
            $nac->descripcion = $params->descripcion;
            $nac->abreviacion = $params->abreviacion;
            $nac->estatus = $params->estatus;
            $nac->save();
        //return $request->all();
        return response()->json($nac,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarNacionalidad(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $nac = Nacionalidad::find($id);
            $nac->descripcion = $params->descripcion;
            $nac->abreviacion = $params->abreviacion;
            $nac->save();
        //return $request->all();
        return response()->json($nac,200);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarNacionalidad($id){
        
        
        $nac = Nacionalidad::find($id);
        $nac->estatus=true;
        $nac->save();
       
    return response()->json($nac,200);
    }

    public function desactivarNacionalidad($id){
        
        
        $nac = Nacionalidad::find($id);        
        $nac->estatus=false;
        $nac->save();
       
    return response()->json($nac,200);
    }
}
