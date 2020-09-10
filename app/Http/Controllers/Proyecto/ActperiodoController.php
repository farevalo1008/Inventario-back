<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Proyecto\DB;
use App\User;

use App\Models\Proyecto\Act_periodo;

class ActperiodoController extends Controller
{
    public function actperiodo(Request $request){
    	//echo "Acion ASIGNAR";die();
    		$json = $request->input('json', null);
      //$clas = json_encode($json);
//dd($request);
//die();
   	$params = json_decode($json);
    $actperiodo= new Act_periodo();
    
   	$actperiodo->id_periodo = $params->id_periodo;
   	$actperiodo->id_actividad = $params->id_actividad;

   	
   	$actperiodo->created_user_at = 'merci fernandez';
   	$actperiodo->update_user_at = 'merci fernandez';
   	

   	$actperiodo->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Registrada con exito.',
        );

      //print_r($request);
	//return $request->all();
    return response()->json($result, 200);
    }

    

       
    
}
