<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Roles;
use App\User;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearRoles(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $rol = new Roles();
            $rol->descripcion = $params->descripcion;
            $rol->modulo = $params->modulo;
            $rol->estatus = $params->estatus;
            $rol->save();
        //return $request->all();
        return response()->json($rol,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarRoles(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $rol = Roles::find($id);
            $rol->descripcion = $params->descripcion;
            $rol->modulo = $params->modulo;
            $rol->save();
        //return $request->all();
        return response()->json($rol,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarRoles(Request $request , $id){
        
        $rol = Roles::find($id);
        
        $rol->estatus=true;

        $rol->save();
    //return $request->all();
    return response()->json($rol,200);
    }

    public function desactivarRoles(Request $request , $id){
        
        $rol = Roles::find($id);
        
        $rol->estatus=false;

        $rol->save();
    //return $request->all();
    return response()->json($rol,200);
    }
}
