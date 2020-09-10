<?php

namespace App\Http\Controllers\Proyecto;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use App\User;
use App\Models\Proyecto\Proy_tarea;


class RegistraractividadController extends Controller
{
    public function registroactividad(Request $request){
    	//echo "Acion registro";die();

   	$json = $request->input('json', null);
      //$clas = json_encode($json);

   	$params = json_decode($json);
    $actividad = new Proy_tarea();
   	$actividad->nombre = $params->nombre; 
   	$actividad->duracion = $params->duracion;
   	$actividad->observaciones = $params->observaciones;
   	$actividad->avance = 'porcentaje';
    $actividad->fecha_inicio = $params->fecha_inicio;
    $actividad->fecha_fin = $params->fecha_fin;
   	//$actividad->id_proyecto = $params->id_proyecto;
   	$actividad->id_proyecto = $params->id_proyecto;

   	$actividad->created_user_at = 'merci fernandez';
   	$actividad->updated_user_at = 'merci fernandez';

   	$actividad->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Registrada con exito.',
            'id_actividad' =>$actividad->id_actividad
        );

      //print_r($request);
	//return $request->all();
    return response()->json($result, 200);
   }
    public function actualizaractividad($id_actividad, Request $request){
    	//echo "Acion actualizar";die();
        $json = $request->input('json', null);
      //$clas = json_encode($json);

    $params = json_decode($json);
    $actividad = Proy_tarea::find($id_actividad);
    $actividad->nombre = $params->nombre; 
    $actividad->duracion = $params->duracion;
    $actividad->observaciones = $params->observaciones;
    $actividad->avance = 'porcentaje';
    //$actividad->id_proyecto = $params->id_proyecto;
    //$actividad->id_proyectos = $params->id_proyectos;

    $actividad->created_user_at = 'merci fernandez';
    $actividad->updated_user_at = 'merci fernandez';

    $actividad->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad actualizada con exito',
        );
        return response()->json($result, 200);
    }
    }
    

