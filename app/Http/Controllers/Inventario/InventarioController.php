<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventario\Inventario;
use App\Models\Inventario\Mantenimiento;
use App\Models\Inventario\Articulo;
use App\Models\Inventario\Clasificacion;
use App\Models\Inventario\TipoArticulo;
use App\Models\Inventario\Status;
use App\Models\Inventario\HistorialArticulo;
use App\User;



class InventarioController extends Controller
{

  
//ME TRAE LOS ARTICULOS DESDE LA BASE DE DATOS (TODOS)
    public function getArticulo(Request $request){


        $data = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status ORDER BY id_articulo asc');

        // SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
        //         sta.descripcion as status, usu2.nombre as nombres, usu2.apellido as apellidos
        //          FROM inv_articulo art
        //          join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
        //          join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
        //          join inv_l_status_art sta on sta.id_status = art.id_status 
        //          join (SELECT usu.* , dat.nombres as nombre, dat.apellidos as apellido
        //          FROM inv_usuario_articulo usu
        //          join datos_personales dat on dat.id_datpers = usu.id_datpers) usu2 on usu2.id_articulo = art.id_articulo
        //          ORDER BY id_articulo asc

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






public function getArticuloClas(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        

        $data = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status WHERE art.id_clas_art = '.$params->id_clas_art.' ');

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


public function getArticuloClasHist(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        

        $data = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_historial_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status WHERE art.id_clas_art = '.$params->id_clas_art.' ');

        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en el historial de la Base de Datos'
            );
        }

        return response()->json($result,200);

    }

public function getArticuloTipo(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        
        $data = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status WHERE art.id_clas_art = '.$params->id_clas_art.' and art.id_tipo_articulo = '.$params->id_tipo_articulo.' ');

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

public function getArticuloTipoHist(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        
        $data = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_historial_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status WHERE art.id_clas_art = '.$params->id_clas_art.' and art.id_tipo_articulo = '.$params->id_tipo_articulo.' ');

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


public function getArticuloTipoMarca(Request $request){
 
        $json = $request->input('json_',null);
        $params =  json_decode($json);
        
        
        $data = DB::select("SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_articulo  as art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status 
                 WHERE  art.marca = '$params->marca' and art.id_tipo_articulo = $params->id_tipo_articulo and art.id_clas_art = $params->id_clas_art");



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


//ELIMINAR?????? era para agregar un combo mas al historial
public function getAccionHist(Request $request){
       $json = $request->input('json_',null);
       $params =  json_decode($json);
        $data = DB::select('SELECT DISTINCT accion FROM inv_historial_articulo where id_tipo_articulo = '.$params->id_tipo_articulo.'');
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

//VER UN SOLO ARTICULO SELECCIONADO
    public function detallesArticulo($id_articulo){

        $articulo = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status WHERE id_articulo = '.$id_articulo.'');

        return response()-> json(array('articulo'=> $articulo, 'status'=> 'success'),200);
    }


////VER UN SOLO ARTICULO SELECCIONADO DEL HISTORIAL
    public function detallesArticuloHistorial($id_hist){

        $articulo = DB::select('SELECT art.* , art.cod_soaint as codigo, clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_historial_articulo art
                 join inv_l_clasificacion clas on clas.id_clas_art = art.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = art.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = art.id_status WHERE id_hist = '.$id_hist.'');

        return response()-> json(array('articulo'=> $articulo, 'status'=> 'success'),200);
    }

    



//CARGA UN ARTICULO
    public function cargaInicial(Request $request){



    	$json = $request->input('json_',null);
        $params =  json_decode($json);
       
        $contador = DB::select("SELECT count(id_articulo) FROM inv_historial_articulo where id_tipo_articulo= ".$params->id_tipo_articulo." and accion = 'NUEVO REGISTRO'");
        $cant=$contador[0]->count;


        if($cant<=9){
            $codigo='SOA-1-'.$params->id_clas_art.'-'.$params->id_tipo_articulo.'-'.'00'.$cant;
        }

        if($cant>=10 && $cant<=99){
            $codigo='SOA-1-'.$params->id_clas_art.'-'.$params->id_tipo_articulo.'-'.'0'.$cant;
        }

         if($cant>99){
            $codigo='SOA-1-'.$params->id_clas_art.'-'.$params->id_tipo_articulo.'-'.$cant;
        }

            $articulo = new Articulo();
            //$articulo->cod_soaint = $params->cod_soaint;
            $articulo->cod_soaint = $codigo;
            $articulo->id_clas_art = $params->id_clas_art;
            $articulo->id_tipo_articulo = $params->id_tipo_articulo;
            $articulo->id_status = $params->id_status;
            $articulo->marca = $params->marca;
            $articulo->modelo = $params->modelo;
            $articulo->serial = $params->serial;
            $articulo->caracteristicas = $params->caracteristicas;
            $articulo->descripcion = $params->descripcion;
            $articulo->accion = 'NUEVO REGISTRO';
            $articulo->color = $params->color;
            $articulo->costo = $params->costo;
            $articulo->fechaborrado = $params->fechaborrado;
            $articulo->usuario = 'no tiene';
            $articulo->created_users_by = 'Hugo Roos';
            $articulo->updated_users_by = 'Hugo Roos';
            $articulo->save();

            if($articulo->save()){

            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $articulo->id_articulo;
            //$historialArticulo->cod_soaint = $params->cod_soaint;
            $historialArticulo->cod_soaint = $codigo;
            $historialArticulo->id_clas_art = $params->id_clas_art;
            $historialArticulo->id_tipo_articulo = $params->id_tipo_articulo;
            $historialArticulo->id_status = $params->id_status;
            $historialArticulo->marca = $params->marca;
            $historialArticulo->modelo = $params->modelo;
            $historialArticulo->serial = $params->serial;
            $historialArticulo->caracteristicas = $params->caracteristicas;
            $historialArticulo->descripcion = $params->descripcion;
            $historialArticulo->accion = 'NUEVO REGISTRO';
            $historialArticulo->color = $params->color;
            $historialArticulo->costo = $params->costo;
            $historialArticulo->created_users_by = 'Hugo Roos';
            $historialArticulo->updated_at = null;
            $historialArticulo->updated_users_by = null;
            $historialArticulo->save();

            }

            if($historialArticulo->save()){
                $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Articulo Registrado Exitosamente con el Codigo  '.$codigo
            );

            }else{
                $request = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Articulo No se Registro Correctamente');
            }
        return response()->json($request,200);
    
    }


//ACTUALIZAR ARTICULO
    public function putArticulo($id_articulo, Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        //$params = json_decode($request);
         // dd($params);
         // die();

            $articulo = Articulo::find($id_articulo);
            
            $articulo->id_status = $params->id_status;
            $articulo->marca = $params->marca;
            $articulo->modelo = $params->modelo;
            $articulo->serial = $params->serial;
            $articulo->caracteristicas = $params->caracteristicas;
            $articulo->descripcion = $params->descripcion;
            $articulo->costo = $params->costo;
            $articulo->created_users_by = 'Whisgel Gonzalez';
            $articulo->updated_users_by = 'Whisgel Gonzalez';
            $articulo->save();

           
            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $id_articulo;
            $historialArticulo->cod_soaint = $params->cod_soaint;
            $historialArticulo->id_clas_art = $params->id_clas_art;
            $historialArticulo->id_tipo_articulo = $params->id_tipo_articulo;
            $historialArticulo->id_status = $params->id_status;
            $historialArticulo->marca = $params->marca;
            $historialArticulo->modelo = $params->modelo;
            $historialArticulo->serial = $params->serial;
            $historialArticulo->caracteristicas = $params->caracteristicas;
            $historialArticulo->descripcion = $params->descripcion;
            $historialArticulo->accion = 'ACTUALIZACION';
            $historialArticulo->color = $params->color;
            $historialArticulo->costo = $params->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();

            $data = array(
                'articulo' => $params,
                'status' => 'success' 
            );      
        //return $request->all();
        return response()->json($data,200);
    }


//ACTUALIZAR ARTICULO AVERIADO
    public function putArticuloAveriado($id_articulo, Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);

        
        $status = DB::select("SELECT *FROM inv_l_status_art");

        for ($i=0; $i < 4; $i++) { 
            if ($status[$i]->descripcion == $params->status) {
                $estado = $status[$i]->id_status;
            }
        }

            $articulo = Articulo::find($id_articulo);
        
            $articulo->id_status = $estado;
            $articulo->marca = $params->marca;
            $articulo->modelo = $params->modelo;
            $articulo->serial = $params->serial;
            $articulo->caracteristicas = $params->caracteristicas;
            $articulo->descripcion = $params->observaciones;
            $articulo->costo = $params->costo;
            $articulo->created_users_by = 'Whisgel Gonzalez';
            $articulo->updated_users_by = 'Whisgel Gonzalez';
            $articulo->save();


            $delete = DB::delete("DELETE FROM inv_mantenimiento where id_articulo = ".$id_articulo." ");

            $mante = new Mantenimiento();
            $mante->id_articulo = $id_articulo;
            $mante->observaciones = $params->observaciones;
            $mante->created_users_by = 'Whisgel Gonzalez';
            $mante->updated_users_by = 'Whisgel Gonzalez';
            $mante->save();
            

            


            $Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$id_articulo." ");


            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $id_articulo;
            $historialArticulo->cod_soaint = $params->cod_soaint;
            $historialArticulo->id_clas_art = $Articulo[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $Articulo[0]->id_tipo_articulo;
            $historialArticulo->id_status = $Articulo[0]->id_status;
            $historialArticulo->marca = $params->marca;
            $historialArticulo->modelo = $params->modelo;
            $historialArticulo->serial = $params->serial;
            $historialArticulo->caracteristicas = $params->caracteristicas;
            $historialArticulo->descripcion = $params->observaciones;
            $historialArticulo->accion = 'ACTUALIZACION';
            $historialArticulo->costo = $params->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();

            $data = array(
                'articulo' => $articulo,
                'status' => 'success',
                'message' => 'Articulo Actualizado Correctamente'
            );      
        //return $request->all();
        return response()->json($data,200);
    }


//REGISTRO DE UN TIPO ARTICULO NUEVO
     public function tipoRegister(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);

        
        $contador = DB::select("SELECT count(id_tipo_articulo) FROM inv_l_tipo_articulo");
        $var = $contador[0]->count + 1;
        
            $tipo = new TipoArticulo();
           
            $tipo->id_tipo_articulo = $var;
            $tipo->descripcion = $params->descripcion;
            $tipo->clase = $params->clase;
            $tipo->created_users_by = 'Hugo Roos';
            $tipo->updated_users_by = 'Hugo Roos';
            $tipo->save();

            $data = array(
                'status' => 'success' ,
                'message' => 'Tipo de Articulo registrado Exitosamente'
            );      

        return response()->json($data,200);
    }
        
    
//ENVIO A MANTENIMIENTO
    public function enviarMantenimiento(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);

        
            $mante = new Mantenimiento();
           
            $mante->id_articulo = $params->id_articulo;
            $mante->observaciones = $params->observaciones;
            $mante->created_users_by = 'Whisgel Gonzalez';
            $mante->updated_users_by = 'Whisgel Gonzalez';
            $mante->save();


            $Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$params->id_articulo." ");

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
            $historialArticulo->descripcion = $params->observaciones;
            $historialArticulo->accion = 'MANTENIMIENTO';
            $historialArticulo->color = $Articulo[0]->color;
            $historialArticulo->costo = $Articulo[0]->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();

            $data = array(
                'status' => 'success' ,
                'message' => 'Articulo enviado a mantenimiento Exitosamente'
            );      

        return response()->json($data,200);
    }

//CONSULTA A LA TABLA INV_MANTENIMIENTO
    public function getListaMante(){

        $mante = DB::select('SELECT * from inv_mantenimiento ');


          if(count($mante)>0){
                $data = array(
                'data' => $mante,
                'status' => 'success',
                'code' => 200,
                'message' => 'Busqueda Exitosa'
            );

            }else{
                $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'No existen Articulos en Mantenimiento');
            };

        return response()-> json($data,200);

    }


public function getArticulosMant(Request $request){

        
        $data = DB::select('SELECT art.* , mant.created_at as ingreso
                 FROM inv_articulo art 
                 join inv_mantenimiento mant 
                 on mant.id_articulo = art.id_articulo');

      

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

//NUMERO DE ARTICULOS EN MANTENIMIENTO #
    public function getListaManteEspe(){

        $mante = DB::select('SELECT mant.* , art.id_clas_art as clasificacion, art.id_tipo_articulo as tipo_articulo, art.marca as marca
                 FROM inv_Mantenimiento mant
                 join inv_articulo art on art.id_articulo = mant.id_articulo');


          if(count($mante)>0){
                $data = array(
                'data' => $mante,
                'status' => 'success',
                'code' => 200,
                'message' => 'Busqueda Exitosa'
            );

            }else{
                $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'No existen Articulos en Mantenimiento');
            };

        return response()-> json($data,200);

    }

//DEVOLUCION DE UN ARTICULO EN MANTENIMIENTO AL INVENTARIO
    public function reincorporarArticulo($id_articulo, Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
       
        
            $articulo = Articulo::find($id_articulo);
            
            $articulo->descripcion = $params->descripcion;
            $articulo->updated_users_by = 'Whisgel Gonzalez';
            $articulo->save();

            // $articulo = Articulo::where('id_articulo',$id_articulo)->update($params_array);

            $Articulo = DB::select("SELECT *FROM inv_articulo where id_articulo = ".$id_articulo." ");

            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $id_articulo;
            $historialArticulo->cod_soaint = $Articulo[0]->cod_soaint;
            $historialArticulo->id_clas_art = $Articulo[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $Articulo[0]->id_tipo_articulo;
            $historialArticulo->id_status = $Articulo[0]->id_status;
            $historialArticulo->marca = $Articulo[0]->marca;
            $historialArticulo->modelo = $Articulo[0]->modelo;
            $historialArticulo->serial = $Articulo[0]->serial;
            $historialArticulo->caracteristicas = $Articulo[0]->caracteristicas;
            $historialArticulo->descripcion = $params->descripcion;
            $historialArticulo->accion = 'REINCORPORADO';
            $historialArticulo->costo = $Articulo[0]->costo;
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_users_by = 'Whisgel Gonzalez';
            $historialArticulo->save();


           $mantenimiento = DB::delete("DELETE FROM inv_mantenimiento where id_articulo = ".$id_articulo." ");

            $data = array(
                'status' => 'success' ,
                'message' => 'Articulo Reincorporado Correctamente'
            );      
        //return $request->all();
        return response()->json($data,200);
    
    }


//ELMININA UN ARTICULO DEL INVENTARIO
    public function borrarArticulo(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        


        $historial = DB::select('SELECT * FROM inv_articulo WHERE id_articulo = '.$params->id_articulo.'');
        
       
            $historialArticulo = new HistorialArticulo();
            $historialArticulo->id_articulo = $historial[0]->id_articulo;
            $historialArticulo->cod_soaint = $historial[0]->cod_soaint;
            $historialArticulo->id_clas_art = $historial[0]->id_clas_art;
            $historialArticulo->id_tipo_articulo = $historial[0]->id_tipo_articulo;
            $historialArticulo->id_status = $historial[0]->id_status;
            $historialArticulo->marca = $historial[0]->marca;
            $historialArticulo->modelo = $historial[0]->modelo;
            $historialArticulo->serial = $historial[0]->serial;
            $historialArticulo->caracteristicas = $historial[0]->caracteristicas;
            $historialArticulo->descripcion = $params->observaciones;
            $historialArticulo->accion = $historial[0]->accion;
            $historialArticulo->color = $historial[0]->color;
            $historialArticulo->costo = $historial[0]->costo;
            $historialArticulo->accion = 'DESINCORPORADO';
            $historialArticulo->created_users_by = 'Whisgel Gonzalez';
            $historialArticulo->updated_at = null;
            $historialArticulo->updated_users_by = null;
            $historialArticulo->fechaborrado = date('Y-m-d');
            $historialArticulo->save();
        
        $articulo = DB::delete('DELETE FROM inv_articulo WHERE id_articulo = '.$params->id_articulo.'');

        $mante = DB::delete('DELETE FROM inv_mantenimiento WHERE id_articulo = '.$params->id_articulo.'');

            $data = array(
                'status' => 'success' ,
                'message' => 'Articulo con codigo '.$historial[0]->cod_soaint.' ha sido Eliminado Exitosamente'
            );      

        return response()->json($data,200);
    }



public function getHistorial(){

        $data = DB::select('SELECT his.* , clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_historial_articulo his
                 join inv_l_clasificacion clas on clas.id_clas_art = his.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = his.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = his.id_status ORDER BY created_at desc');

        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existe Historial en la Base de Datos'
            );
        }

        return response()->json($result,200);
}


public function getArticuloCodHist(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        $codigo =  "'".$params->cod_soaint."'";
        $data = DB::select('SELECT his.* , clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_historial_articulo his
                 join inv_l_clasificacion clas on clas.id_clas_art = his.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = his.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = his.id_status WHERE cod_soaint = '.$codigo.'');
    
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data,
                'codigo' => $params->cod_soaint
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200);
    }


public function getArticuloCodAct(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        $codigo =  "'".$params->cod_soaint."'";
        $data = DB::select('SELECT act.* , clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
                sta.descripcion as status
                 FROM inv_articulo act
                 join inv_l_clasificacion clas on clas.id_clas_art = act.id_clas_art
                 join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = act.id_tipo_articulo
                 join inv_l_status_art sta on sta.id_status = act.id_status WHERE cod_soaint = '.$codigo.'');
    
        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data,
                'codigo' => $params->cod_soaint
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200);
    }



public function getArticuloCodMant(Request $request){

        $json = $request->input('json_',null);
        $params =  json_decode($json);
        $codigo =  "'".$params->cod_soaint."'";
        $data = DB::select('SELECT mant.* , art.cod_soaint as cod_soaint, 
                art.modelo as modelo,
                 art.caracteristicas as caracteristicas,
                 art.usuario as usuario,
                 mant.created_at as ingreso
                 FROM inv_mantenimiento mant
                 
                 join inv_articulo art 
                 on art.id_articulo = mant.id_articulo WHERE cod_soaint = '.$codigo.'');
      

        if(count($data)>0) {
            $result = array(
                'status' => 'success',
                'data' => $data,
                'codigo' => $params->cod_soaint
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Articulos en la Base de Datos'
            );
        }
        return response()->json($result,200);
    }

// public function usuarioHist(Request $request){

//         $json = $request->input('json_',null);
//         $params =  json_decode($json);
//         dd($params);
//         // $codigo =  "'".$params->cod_soaint."'";
//         // $data = DB::select('SELECT act.* , clas.descripcion as clasificacion, tipo_art.descripcion as tipo_articulo,
//         //         sta.descripcion as status
//         //          FROM inv_articulo act
//         //          join inv_l_clasificacion clas on clas.id_clas_art = act.id_clas_art
//         //          join inv_l_tipo_articulo tipo_art on tipo_art.id_tipo_articulo = act.id_tipo_articulo
//         //          join inv_l_status_art sta on sta.id_status = act.id_status WHERE cod_soaint = '.$codigo.'');
    
//         if(count($data)>0) {
//             $result = array(
//                 'status' => 'success',
//                 'data' => $data,
//                 'codigo' => $params
//             );
//         }else{
//             $result = array(
//                 'status' => 'error',
//                 'data' => 'No existen Articulos en la Base de Datos'
//             );
//         }
//         return response()->json($result,200);
// }

}
