<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventario\Inventario;
use App\Models\Inventario\Articulo;
use App\Models\Inventario\UsuarioArticulo;
use App\Models\Inventario\DepartamentoArticulo;
use App\Models\Inventario\Clasificacion;
use App\Models\Inventario\TipoArticulo;
use App\Models\Inventario\Status;
use App\Models\Inventario\HistorialArticulo;
use App\Models\DatosPersonales;
use App\User;

class AsignacionController extends Controller
{
    public function getPersonal(Request $request){

        $data = DB::select('SELECT dat.* , dat.nombres as name, dat.apellidos as lastname, usu.rolnew as role, dep.descripcion as depa
        		 FROM datos_personales dat
        		 join (SELECT u.* , r.descripcion as rolnew from users u
			join l_roles r on u.rol = r.id_rol) usu on usu.id = dat.id_user
        		 join inv_l_departamento_area dep on dep.id_dep = dat.departamento order by id_datpers asc
        		 ');
        
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200); 
    }



   public function comparaArticulo(Request $request){
       $json = $request->input('json_',null);
       $params =  json_decode($json);
        $data = DB::select('SELECT DISTINCT marca
                            FROM inv_articulo where id_tipo_articulo = '.$params->id_tipo_articulo.'');
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos NEEEY'
            );
        }  
       return response()->json($result,200);
    }




    public function getMarcaComputacion(Request $request){
       $data = DB::select('SELECT * FROM inv_articulo WHERE id_clas_art = 1'); 
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
       return response()->json($result,200);
    }

    public function getMarcaMobiliario(Request $request){
       $data = DB::select('SELECT * FROM inv_articulo WHERE id_clas_art = 3'); 
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
       return response()->json($result,200);
    }



    
    public function getArticuloUso(Request $request){
       $data = DB::select('SELECT his.* , art.id_clas_art as clasificacion, art.id_tipo_articulo as tipo_articulo,
                art.marca as marca
                 FROM inv_usuario_articulo his
                 join inv_articulo art on art.id_articulo = his.id_articulo');
        
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
       return response()->json($result,200);
    }



    public function getArticuloDep(Request $request){
       $data = DB::select('SELECT his.* , art.id_clas_art as clasificacion, art.id_tipo_articulo as tipo_articulo,
                art.marca as marca
                 FROM inv_departamento_articulo his
                 join inv_articulo art on art.id_articulo = his.id_articulo');
        
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
       return response()->json($result,200);
    }




    public function guardarAsignacion(Request $request){

        $json = $request->input('json_',null);
        $jsonArray = json_decode($json, true);

        foreach ($jsonArray as $key => $value) {

            $var = $value;
            $conversion = json_encode($var);
            $params = json_decode($conversion);


            $nombreConcat = DB::select("SELECT CONCAT(nombres, ' ' ,apellidos) as completo
                            FROM datos_personales where id_datpers = ".$params->id_datpers." ");
        

            $articulo = Articulo::find($params->id_articulo);
            $articulo->usuario = $nombreConcat[0]->completo;
            $articulo->save(); 

            $guardaArticulo = new UsuarioArticulo();
            $guardaArticulo->id_datpers = $params->id_datpers;
            $guardaArticulo->id_articulo = $params->id_articulo;
            $guardaArticulo->motivo = $params->motivo;
            $guardaArticulo->created_users_by = 'Whisgel Gonzalez';
            $guardaArticulo->updated_users_by = 'Whisgel Gonzalez';
            $guardaArticulo->save();  

$Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$params->id_articulo." ");
$Persona = DB::select("SELECT *FROM datos_personales where id_datpers = ".$params->id_datpers." ");
$descripcion =('Asignado a '.$Persona[0]->nombres.' '.$Persona[0]->apellidos.' / '.$params->motivo);

            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $params->id_articulo;
            $historialArticulo->cod_soaint = $Articulo[0]->cod_soaint;
            $historialArticulo->id_clas_art = $Articulo[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $Articulo[0]->id_tipo_articulo;
            $historialArticulo->id_status = $Articulo[0]->id_status;
            $historialArticulo->marca = $Articulo[0]->marca;
            $historialArticulo->modelo = $Articulo[0]->modelo;
            $historialArticulo->serial = $Articulo[0]->serial;
            $historialArticulo->caracteristicas = $Articulo[0]->caracteristicas;
            $historialArticulo->descripcion = $descripcion; 
            $historialArticulo->accion = 'ASIGNACIÓN';
            $historialArticulo->color = $Articulo[0]->color;
            $historialArticulo->costo = $Articulo[0]->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();
            
        };

            if($guardaArticulo->save()){
                $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Asignación realizada Correctamente'
            );

            }else{
                $request = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Articulo No se Asigno Correctamente');
            }

        return response()->json($request,200);
    }


    public function guardarAsignacionDep(Request $request){

        $json = $request->input('json_',null);
        $jsonArray = json_decode($json, true);

        foreach ($jsonArray as $key => $value) {

            $var = $value;
            $conversion = json_encode($var);
            $params = json_decode($conversion);

            $guardaArticulo = new DepartamentoArticulo();
            $guardaArticulo->id_dep = $params->id_dep;
            $guardaArticulo->id_articulo = $params->id_articulo;
            $guardaArticulo->motivo = $params->motivo;
            $guardaArticulo->created_users_by = 'Whisgel Gonzalez';
            $guardaArticulo->updated_users_by = 'Whisgel Gonzalez';
            $guardaArticulo->save();  


$Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$params->id_articulo." ");
$Depa = DB::select("SELECT *FROM inv_l_departamento_area where id_dep = ".$params->id_dep." ");
$descripcion =('Asignado a '.$Depa[0]->descripcion.' / '.$params->motivo);

            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $params->id_articulo;
            $historialArticulo->cod_soaint = $Articulo[0]->cod_soaint;
            $historialArticulo->id_clas_art = $Articulo[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $Articulo[0]->id_tipo_articulo;
            $historialArticulo->id_status = $Articulo[0]->id_status;
            $historialArticulo->marca = $Articulo[0]->marca;
            $historialArticulo->modelo = $Articulo[0]->modelo;
            $historialArticulo->serial = $Articulo[0]->serial;
            $historialArticulo->caracteristicas = $Articulo[0]->caracteristicas;
            $historialArticulo->descripcion = $descripcion; 
            $historialArticulo->accion = 'ASIGNACIÓN';
            $historialArticulo->color = $Articulo[0]->color;
            $historialArticulo->costo = $Articulo[0]->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();
        };
            if($guardaArticulo->save()){
                $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Asignación Finalizada!!'
            );
            }else{
                $request = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Articulo No se Asigno Correctamente');
            }
        return response()->json($request,200);
    }
    



     public function BuscarPersonal(){


      $data = DB::select('SELECT dni, nombres, apellidos from datos_personales');    
      $contador = DB::select('SELECT count(dni) from datos_personales');
      // dd($contador[0]->count);
      // die();
      
      for ($i=0; $i < $contador[0]->count; $i++) { 
         // $dni = $data[$i]->dni;
         $nombre = $data[$i]->nombres;
         $apellido = $data[$i]->apellidos;
         
         $datoArray = $nombre." ".$apellido;
         $array[] = $datoArray;
        
        };

           if(count($array)>0) {
            $result = array(
                'status' => 'success',
                'data' => $array
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200);
    }


    public function asignacionesOnePerson(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        
        $data = DB::select('SELECT asig.* ,art.cod_soaint as cod_soaint, asig.motivo as caracteristicas, art.marca as marca, art.tipo as equipo
                 FROM inv_usuario_articulo asig
                 join (SELECT tipoart.* , ti.descripcion as tipo from inv_articulo tipoart
            join inv_l_tipo_articulo ti on tipoart.id_tipo_articulo = ti.id_tipo_articulo)
            art on art.id_articulo = asig.id_articulo where id_datpers ='.$params->id_datpers.' ');    
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => $data,
                'message' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200);
    }


    public function asignacionesOneDepa(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        
        $data = DB::select('SELECT asig.* ,art.cod_soaint as cod_soaint, asig.motivo as caracteristicas, art.marca as marca, art.tipo as equipo
                 FROM inv_departamento_articulo asig
                 join (SELECT tipoart.* , ti.descripcion as tipo from inv_articulo tipoart
            join inv_l_tipo_articulo ti on tipoart.id_tipo_articulo = ti.id_tipo_articulo)
            art on art.id_articulo = asig.id_articulo where id_dep ='.$params->id_dep.' ');    
      

        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => $data,
                'message' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200);
    }



    





public function borrarAsignacion(Request $request){

    $json = $request->input('json_',null);
    $params =  json_decode($json);
        
$usuarioArt = DB::select('SELECT * from inv_usuario_articulo where id_articulo = '.$params->id_articulo.'');     
$Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$params->id_articulo." ");
$Persona = DB::select("SELECT *FROM datos_personales where id_datpers = ".$usuarioArt[0]->id_datpers." ");
$descripcion =('Desasignado a '.$Persona[0]->nombres.' '.$Persona[0]->apellidos.' / '.$usuarioArt[0]->motivo);

            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $params->id_articulo;
            $historialArticulo->cod_soaint = $Articulo[0]->cod_soaint;
            $historialArticulo->id_clas_art = $Articulo[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $Articulo[0]->id_tipo_articulo;
            $historialArticulo->id_status = $Articulo[0]->id_status;
            $historialArticulo->marca = $Articulo[0]->marca;
            $historialArticulo->modelo = $Articulo[0]->modelo;
            $historialArticulo->serial = $Articulo[0]->serial;
            $historialArticulo->caracteristicas = $Articulo[0]->caracteristicas;
            $historialArticulo->descripcion = $descripcion; 
            $historialArticulo->accion = 'DESASIGNACIÓN';
            $historialArticulo->color = $Articulo[0]->color;
            $historialArticulo->costo = $Articulo[0]->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();

       $data = DB::delete('DELETE FROM inv_usuario_articulo where id_articulo = '.$params->id_articulo.' ');

        $result = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Articulo Eliminado Exitosamente'
            );

        return response()->json($result,200);
    }





    public function borrarAsignacionDep(Request $request){

    $json = $request->input('json_',null);
    $params =  json_decode($json);
        
$usuarioArt = DB::select('SELECT * from inv_departamento_articulo where id_articulo = '.$params->id_articulo.'');
$Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$params->id_articulo." ");
$Depa = DB::select("SELECT *FROM inv_l_departamento_area where id_dep = ".$usuarioArt[0]->id_dep." ");
$descripcion =('Desasignado a '.$Depa[0]->descripcion.' / '.$usuarioArt[0]->motivo);

            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $params->id_articulo;
            $historialArticulo->cod_soaint = $Articulo[0]->cod_soaint;
            $historialArticulo->id_clas_art = $Articulo[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $Articulo[0]->id_tipo_articulo;
            $historialArticulo->id_status = $Articulo[0]->id_status;
            $historialArticulo->marca = $Articulo[0]->marca;
            $historialArticulo->modelo = $Articulo[0]->modelo;
            $historialArticulo->serial = $Articulo[0]->serial;
            $historialArticulo->caracteristicas = $Articulo[0]->caracteristicas;
            $historialArticulo->descripcion = $descripcion; 
            $historialArticulo->accion = 'DESASIGNACIÓN';
            $historialArticulo->color = $Articulo[0]->color;
            $historialArticulo->costo = $Articulo[0]->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();

       $data = DB::delete('DELETE FROM inv_departamento_articulo where id_articulo = '.$params->id_articulo.' ');
       

        $result = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Articulo Eliminado Exitosamente'
            );

        return response()->json($result,200);
    }


}
