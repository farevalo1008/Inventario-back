<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

use App\Models\Proyecto\Proy_actividad_ejecutada;


class ActividadrealizadaController extends Controller
{
	public function actividadrealizada(Request $request){
    	
   // echo "Acion Actividades Realizadas";die();

			$json = $request->input('json', null);
      //$clas = json_encode($json);

   	$params = json_decode($json);
    $actejecutada= new Proy_actividad_ejecutada();
    
   	
   	$actejecutada->id_actividad = $params->id_actividad;
   	$actejecutada->fecha_inicio_real = $params->fecha_inicio_real;
   	$actejecutada->fecha_fin_real = $params->fecha_fin_real;
   	
	$actejecutada->id_turno = $params->id_turno;
   	$actejecutada->duracion_de_ejecucion = $params->duracion_de_ejecucion;
	$actejecutada->avance = $params->avance;
	$actejecutada->observaciones = $params->observaciones;

   	$actejecutada->created_user_at = 'merci fernandez';
   	$actejecutada->update_user_at = 'merci fernandez';
   	

   	$actejecutada->save();

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
