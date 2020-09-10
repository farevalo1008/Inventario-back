<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function getPais(){
        $data = DB::select('select id_pais, descripcion from l_pais order by descripcion asc');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getDescripcionTrabajo(){
        $data = DB::select('select id_descripcion_trabajo, descripcion from l_descripcion_trabajo order by descripcion asc');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getGenero(){
        $data = DB::select('select id_genero, descripcion from l_genero');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getRoles(){
        $data = DB::select('select id_rol, descripcion from l_roles order by descripcion asc');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getProfesion(){
        $data = DB::select('select * from l_profesion');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getCargos(){
        $data = DB::select('select * from l_cargos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getEstadoCivil(){
        $data = DB::select('select * from l_cargos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getIdiomas(){
        $data = DB::select('select * from l_idiomas');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getModulos(){
        $data = DB::select('select * from l_modulos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getNivel(){
        $data = DB::select('select * from l_nivel');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getStatus(){
        $data = DB::select('select * from l_status');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getNacionalidad(){
        $data = DB::select('select * from l_nacionalidad');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getDeducciones(){
        $data = DB::select('select * from nom_l_deducciones');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getAsignaciones(){
        $data = DB::select('select * from nom_l_asignaciones');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getTipoEmpleado(){
        $data = DB::select('select * from nom_l_tipo_empleado');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getAreaTrabajo(){
        $data = DB::select('select * from l_area_trabajo');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getConocimientos(){
        $data = DB::select('select * from l_conocimientos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getEdoCivil(){
        $data = DB::select('select * from l_edo_civil');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getTipoEstudio(){
        $data = DB::select('select * from l_tipo_estudio');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getTipoRequerimiento(){
        $data = DB::select('select * from l_tipo_requerimiento');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

     public function getTipoDepartamento(){
        $data = DB::select('select * from doc_departamentos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

     public function getTipoDocumento(){
        $data = DB::select('select * from doc_tipo_documentos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

     public function getTipoCliente(){
        $data = DB::select('select * from doc_clientes');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getTipoExtension(){
        $data = DB::select('select * from l_doc_extension');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

     public function getTipoProcedencia(){
        $data = DB::select('select * from doc_procedencias');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getTipoTurno(){
        $data = DB::select('select * from proy_turnos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }
    public function getTipoProyecto(){
        $data = DB::select('select * from proy_proyectos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }
     public function getTipoSprint(){
        $data = DB::select('select * from proy_periodos');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }
    public function getTipoUser(){
        $data = DB::select('select * from datos_personales');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }
    public function getTipoActividad(){
        $data = DB::select('select * from proy_tareas');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }
        public function getTipoActasignacion(){
        $data = DB::select('select * from proy_actv_user');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }
      public function getProyectoac($id_proyecto)
   {  
   
        
        $data    = DB::select("SELECT * from proy_actv_user 
          join proy_tareas 
          on proy_tareas.id_actividad=proy_actv_user.id_actividad
          join datos_personales
          on datos_personales.id_datpers=proy_actv_user.id_datpers
          join proy_proyectos
          on proy_proyectos.id_proyecto=proy_tareas.id_proyecto
         WHERE proy_proyectos.id_proyecto = $id_proyecto
          ");
        
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
        public function getProyectoPe($id_proyecto)
        {  
        //print_r($id_proyecto);die();
        
                $data    = DB::select("SELECT * from proy_periodos 
                inner join proy_proyectos 
            on proy_proyectos.id_proyecto=proy_periodos.id_proyecto
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
            public function getProyectoPra($id_periodo)
        {  
        //print_r($id_proyecto);die();
        
                $data    = DB::select("SELECT * from proy_actv_periodos 
          join proy_tareas 
          on proy_tareas.id_actividad=proy_actv_periodos.id_actividad
          join proy_periodos
          on proy_periodos.id_periodo=proy_actv_periodos.id_periodo
          WHERE proy_periodos.id_periodo= $id_periodo");
        
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
      public function getProyectouser($id_actividad)
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
    public function getTipoUserdos(){
        $data = DB::select('select * from datos_personales');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

public function getTipoActividadRealizada($id_actividad){
        $data = DB::select("SELECT * from proy_actividades_ejecutadas 
          inner join proy_tareas 
          on proy_tareas.id_actividad=proy_actividades_ejecutadas.id_actividad
      WHERE proy_actividades_ejecutadas.id_actividad= $id_actividad");

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

        return response()->json($result);
    }

public function getTipoActividadRealizadaUser($id_datpers){
        $data = DB::select("SELECT * from proy_actividades_ejecutadas 
           join proy_tareas 
          on proy_tareas.id_actividad=proy_actividades_ejecutadas.id_actividad
      join proy_actv_user
      on proy_actv_user.id_actividad=proy_actividades_ejecutadas.id_actividad
      WHERE proy_actv_user.id_datpers= $id_datpers");

    if (count($data)) {
            $result = array(
                'status'  => 'success',
                'data'    => $data,
               
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No se encuentran  asignado',
            );
        }

        return response()->json($result);
    }

  public function getStatusArt(){
        $data = DB::select('select * from inv_l_status_art');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

     public function getArticuloCompu(){
        $data = DB::select("select * from inv_l_tipo_articulo where clase='computacion' ORDER BY descripcion ASC");
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getArticuloMobi(){
        $data = DB::select("select * from inv_l_tipo_articulo where clase='mobiliario' ORDER BY descripcion ASC");
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

    public function getArticuloElec(){
        $data = DB::select("select * from inv_l_tipo_articulo where clase='electrodomestico' ORDER BY descripcion ASC");
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }

        return response()->json($result);
    }

         public function getDepartamento(){
        $data = DB::select('select * from inv_l_departamento_area ORDER BY descripcion ASC');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }
        return response()->json($result);
    }

     public function getClasificacion(){
        $data = DB::select('select * from inv_l_clasificacion ORDER BY descripcion ASC');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }
        return response()->json($result);
    }






    
}
