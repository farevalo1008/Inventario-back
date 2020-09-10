<?php

namespace App\Http\Controllers\Proyecto;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Models\Proyecto\Proy_periodo;


class FasesController extends Controller
{
    public function crearfase(Request $request){
    	//echo "Acion registro";die();

   	$json = $request->input('json', null);
      //$clas = json_encode($json);

   	$params = json_decode($json);
    $fase = new Proy_periodo();

   	$fase->sprint = $params->sprint; 
   	$fase->mes = $params->mes;
   	$fase->dias = $params->dias;
   	$fase->hora_inicio = $params->hora_inicio;
   	
   	$fase->hora_fin = $params->hora_fin;
    $fase->fecha_inicio_per = $params->fecha_inicio_per;
    $fase->fecha_fin_per = $params->fecha_fin_per;
   	$fase->id_turno = $params->id_turno;
    $fase->id_proyecto = $params->id_proyecto;
   	$fase->create_user_at = 'merci fernandez';
   	$fase->updated_user_at = 'merci fernandez';
   	

   	$fase->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Registrada con exito.',
        );

      //print_r($request);
	//return $request->all();
    return response()->json($result, 200);
   }


   public function actualizarfase($id_periodo, Request $request){
      //echo "Acion registro";die();

    $json = $request->input('json', null);
      //$clas = json_encode($json);

    $params = json_decode($json);
    $fase = Proy_periodo::find($id_periodo);

    $fase->sprint = $params->sprint; 
    $fase->mes = $params->mes;
    $fase->dias = $params->dias;
    $fase->hora_inicio = $params->hora_inicio;
    
    $fase->hora_fin = $params->hora_fin;
    $fase->id_turno = $params->id_turno;
    $fase->create_user_at = 'Luisa Cartaya';
    $fase->updated_user_at = 'Luisa Cartaya';
    

    $fase->save();

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
