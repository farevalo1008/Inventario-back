<?php


namespace App\Http\Controllers\Proyecto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;


use App\User;
use App\Models\Proyecto\Proy_proyecto;


class ProyectoController extends Controller
{
 public function crearproyecto(Request $request){
   
   	$json = $request->input('json', null);
      //$clas = json_encode($json);

   	$params = json_decode($json);
      $proyecto = new Proy_proyecto();
   	$proyecto->nombre = $params->nombre; 
   	$proyecto->cliente = $params->cliente;
   	$proyecto->fecha_inicio = $params->fecha_inicio;
   	$proyecto->fecha_fin = $params->fecha_fin;
   	$proyecto->created_user_at = 'Luisa Cartaya';
   	$proyecto->updated_user_at = 'Luisa Cartaya';
   	$proyecto->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Registrada con exito.',
        );

      //print_r($request);
	//return $request->all();
    return response()->json($result, 200);
   }   
   public function actualizarproyecto($id_proyecto, Request $request){
      //echo "actualizar";

    
        $json                    = $request->input('json', null);
        $params                  = json_decode($json);
        $proyecto               = Proy_proyecto::find($id_proyecto);
        $proyecto->nombre = $params->nombre; 
        $proyecto->cliente = $params->cliente;
        $proyecto->fecha_inicio = $params->fecha_inicio;
        $proyecto->fecha_fin    = $params->fecha_fin;
        $proyecto->created_user_at = 'Luisa Cartaya';
        $proyecto->updated_user_at = 'Luisa Cartaya';
        $proyecto->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'proyecto Actualizada con exito.',
        );

        return response()->json($result, 200);
   }
    public function getProyecto(Request $request)
   {  
   
        
        $data    = DB::select("SELECT * from proy_actv_user 
          join proy_tareas 
          on proy_tareas.id_actividad=proy_actv_user.id_actividad
          join datos_personales
          on datos_personales.id_datpers=proy_actv_user.id_datpers
      Where proy_actv_user.id_actividad= $id_actividad");
        
        if (count($data)) {
            $result = array(
                'status'  => 'success',
                'data'    => $data,
               
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No se encuentran Actividades',
            );
        }
        return response()->json($result, 200);
    }
     public function getProyectoactivi($id_proyecto, Request $request)
   {  
   
        
        $data    = DB::select("SELECT * from proy_tareas 
        join proy_proyectos 
        on proy_tareas.id_proyecto=proy_proyectos.id_proyecto
         where proy_proyectos.id_proyecto = $id_proyecto");
        
        if (count($data)) {
            $result = array(
                'status'  => 'success',
                'data'    => $data,
               
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No se encuentran Actividades',
            );
        }
        return response()->json($result, 200);
    }
   
    public function desactivarproyecto($id_proyecto, Request $request){
       // echo "desactivar";
        
        
        $proyecto = Proy_proyecto::find($id_proyecto);        
        $proyecto->delete();
       
       
    return response()->json($proyecto,200);
    }

        


    
}