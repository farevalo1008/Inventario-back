<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\Genero;
use App\User;

class GeneroController extends Controller
{
    /**
    * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearGenero(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $gene = new Genero();
            $gene->descripcion = $params->descripcion;
            $gene->abreviacion = $params->abreviacion;
            $gene->estatus = $params->estatus;
            $gene->save();
        //return $request->all();
        return response()->json($gene,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function actualizarGenero(Request $request , $id){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $gene = Genero::find($id);
            $gene->descripcion = $params->descripcion;
            $gene->abreviacion = $params->abreviacion;
            $gene->save();
        //return $request->all();
        return response()->json($gene,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activarGenero($id){
        
        
        $gene = Genero::find($id);
        $gene->estatus=true;
        $gene->save();
       
    return response()->json($gene,200);
    }

    public function desactivarGenero($id){
        
        
        $gene = Genero::find($id);        
        $gene->estatus=false;
        $gene->save();
       
    return response()->json($gene,200);
    }
}
