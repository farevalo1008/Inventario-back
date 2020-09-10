<?php

namespace App\Http\Controllers\Proyecto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Proyecto\Proy_turno;
use App\User;

class TurnoController extends Controller
{
   public function crearturno(Request $request){
   	
   	$json = $request->input('json', null);
   	$params = json_decode($json);

   	$turno = new Proy_turno();
   	$turno->descripcion = $params->descripcion; 
   	$turno->abreviacion = $params->abreviacion;
   	$turno->created_user_at = 'MERCI';
   	$turno->updated_user_at = 'MERCI';
   	$turno->save();
	//return $request->all();
    return response()->json($turno, 200);
   }
   public function actualizarturno( Request $request , $id_turno){

     $json = $request->input('json',null);
        $params =  json_decode($json);

            $turno = Proy_turno::find($id_turno);
            $turno->descripcion = $params->descripcion;
            $turno->abreviacion = $params->abreviacion;
            $turno->save();
        //return $request->all();
       return response()->json($turno,200);

   }

   public function destroyturno($id , Request $request){
        
        $json = $request->input('json',null);
        $params =  json_decode($json);

        if($json){
            $turno = Proy_turno::find($id);
          //return $request->all();
            $turno->delete();
        
            $data = array(
                'turno' => $turno,
                'status' => 'success',
                'code' => 200
            );

        }
        

       return response()->json($data,200);
    }
   
}
