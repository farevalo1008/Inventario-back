<?php

namespace App\Http\Controllers\Proyecto;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use App\Models\Proyecto\Actv_user;

class AsignaractividadController extends Controller
{
    public function asignacion(Request $request){
    	//echo "Acion ASIGNAR";die();
    	$json = $request->input('json', null);
      //$clas = json_encode($json);

   	$params = json_decode($json);
    $asigno= new Actv_user();

   	$asigno->id_datpers = $params->id_datpers;
   	$asigno->id_actividad = $params->id_actividad;

   	
   	$asigno->created_user_at = 'merci fernandez';
   	$asigno->update_user_at = 'merci fernandez';
   	

   	$asigno->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Registrada con exito.',
        );

      //print_r($request);
	//return $request->all();
    return response()->json($result, 200);
   
    }
   public function actualizarasignacion($id_actv_user, Request $request){
      //echo "actualizar";

   

        $json                    = $request->input('json', null);
        $params                  = json_decode($json);
        $asigno              = Actv_user::find($id_actv_user);
       
       
          $asigno->id_datpers = $params->id_datpers;
          $asigno->created_user_at = 'merci fernandez';
          $asigno->update_user_at = 'merci fernandez';
          $asigno->save();

          $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'proyecto Actualizada con exito.',
        );

        return response()->json($result, 200);
   }
    
}
