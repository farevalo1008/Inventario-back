<?php

namespace App\Http\Controllers\Reclutamiento;

use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Reclutamiento\Solicitud;
use App\Models\Reclutamiento\Candidato;
use App\User;
use App\Models\Reclutamiento\Proceso;
use App\Models\Reclutamiento\StatusProceso;
use App\Models\Reclutamiento\CitaProceso;
use App\Models\Reclutamiento\ObservacionProceso;
use App\Models\Reclutamiento\SolicitudCandidato;
use App\Models\Reclutamiento\ContratoCandidato;
use App\Models\Reclutamiento\RechazoContrato;
use Hash;

class ReclutamientoController extends Controller
{
    //FUNCION PARA TRAER DE BASE DE DATOS TODOS LOS CANDIDATOS
    public function getCandidatos(){
        $data = DB::select('SELECT * FROM rcl_candidato ORDER BY id_candidato DESC');
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Candidatos en la Base de Datos'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE DE DATOS TODAS LAS SOLICITUDES
    public function getSolicitud(){
        $data = DB::select('SELECT sol.* , req.descripcion as requerimiento, car.descripcion as cargo, destra.descripcion as descripcion_trabajo 
                            FROM 
                            rcl_solicitud sol 
                            join l_tipo_requerimiento req on req.id_tipo_requerimiento = sol.tipo_requerimiento 
                            join l_cargos car on car.id_cargo = sol.cargo
                            join l_descripcion_trabajo destra on destra.id_descripcion_trabajo = sol.descripcion_trabajo
                            ORDER BY id_solicitud DESC'
                            );
        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Solicitudes en la Base de Datos'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE DE DATOS TODOS LOS USUARIOS REGISTRADOS EN EL SISTEMA
    public function getUsuarios(){
        //$data = DB::select('SELECT * FROM users');
        $data = DB::select('SELECT usua.* , role.descripcion as rol 
                            FROM 
                            users usua 
                            join l_roles role on role.id_rol = usua.rol'
                            );
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

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE DE DATOS TODOS LOS POSIBLES EMPLEADOS
    public function posiblesEmpleados(){
        //$data = DB::select('SELECT * FROM rcl_candidato_status WHERE status_proceso=5');       
        $data = DB::select('SELECT rclcansta.* , nom.nombres as nombres, ape.apellidos as apellidos 
                            FROM 
                            rcl_candidato_status rclcansta
                            join rcl_candidato nom on nom.id_candidato = rclcansta.id_candidato
                            join rcl_candidato ape on ape.id_candidato = rclcansta.id_candidato
                            WHERE status_proceso=5 ORDER BY id_candidato_status DESC'
                            );

        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Posibles Empleados.'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE DE DATOS TODOS LOS RECURSOS INTERNOS
    public function recursosInternos(){

        $dataCan = DB::select('SELECT *, LC.descripcion as cargo, LP.descripcion as profesion FROM rcl_candidato_contrato CC, rcl_candidato C, l_cargos LC, rcl_candidato_datos_academicos CA, rcl_candidato_datos_laborales CL, rcl_candidato_habilidades CH, rcl_candidato_archivos CD, l_profesion LP WHERE CC.id_candidato = C.id_candidato AND CC.id_cargo = LC.id_cargo AND CC.id_candidato = CA.id_candidato AND CC.id_candidato = CL.id_candidato AND CC.id_candidato = CH.id_candidato AND CC.id_candidato = CD.id_candidato AND LP.id_profesion = CH.profesion');
        

        if(count($dataCan)>0){
            $result = array(
                'status' => 'success',
                'dataCan' => $dataCan
                // 'dataAca' => $dataAca,
                // 'dataLab' => $dataLab,
                // 'dataHab' => $dataHab,
                // 'dataArc' => $dataArc
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'No existen Recursos Internos.'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE DE UNA SOLICITUD
    public function unaSolicitud($id_solicitud){
        //$data = DB::select('SELECT * FROM rcl_solicitud WHERE id_solicitud ='.$id_solicitud.'' );
        $data = DB::select('SELECT sol.* , req.descripcion as requerimiento, prof.descripcion as profesion, cono.descripcion as conocimiento, are.descripcion as area, car.descripcion as cargo, dtra.descripcion as descripcion_trabajo 
                            FROM 
                            rcl_solicitud sol 
                            join l_tipo_requerimiento req on req.id_tipo_requerimiento = sol.tipo_requerimiento
                            join l_area_trabajo are on are.id_area_trabajo = sol.area_trabajo 
                            join l_conocimientos cono on cono.id_conocimiento = sol.conocimiento
                            join l_profesion prof on prof.id_profesion = sol.profesion
                            join l_cargos car on car.id_cargo = sol.cargo
                            join l_descripcion_trabajo dtra on dtra.id_descripcion_trabajo = sol.descripcion_trabajo
                            WHERE id_solicitud = '.$id_solicitud.''
                            );   
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

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE DE UN USUARIO
    public function unUsuario($id){
        $data = DB::select('SELECT * FROM users WHERE id ='.$id.'' );

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

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE LOS CANDIDATOS DE UNA SOLICITUD
    public function candidatoPorSolicitud($id_solicitud){
        //$data = DB::select('SELECT * FROM rcl_solicitud_candidato WHERE id_solicitud ='.$id_solicitud.'' );

        $data = DB::select('SELECT rclsolcan.* , nom.nombres as nombres, ape.apellidos as apellidos 
                            FROM 
                            rcl_solicitud_candidato rclsolcan
                            join rcl_candidato nom on nom.id_candidato = rclsolcan.id_candidato
                            join rcl_candidato ape on ape.id_candidato = rclsolcan.id_candidato
                            WHERE id_solicitud = '.$id_solicitud.''
                            );

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

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE LAS SOLICITUDES DE UN CANDIDATO
    public function solicitudPorcandidato($id_candidato){
        //$data = DB::select('SELECT * FROM rcl_solicitud_candidato WHERE id_solicitud ='.$id_solicitud.'' );

        // $data = DB::select('SELECT rclsolcan.* , soli.solicitante as solicitante, des.descripcion_trabajo as descripcion_trabajo, dt.descripcion as descripcion
        //                     FROM 
        //                     rcl_solicitud_candidato rclsolcan
        //                     join rcl_solicitud soli on soli.id_solicitud = rclsolcan.id_solicitud
        //                     join rcl_solicitud des on des.id_solicitud = rclsolcan.id_solicitud
        //                     join l_descripcion_trabajo dt on dt.id_descripcion_trabajo = rclsolcan.id_solicitud
        //                     WHERE id_candidato = '.$id_candidato.''
        //                     );

        $data = DB::select('SELECT *, LDT.descripcion as descripcion_trabajo FROM rcl_solicitud_candidato SC, l_descripcion_trabajo LDT, rcl_solicitud RS WHERE RS.descripcion_trabajo = LDT.id_descripcion_trabajo AND SC.id_solicitud = RS.id_solicitud AND SC.id_candidato = '.$id_candidato.' ');

        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'errorasig',
                'errorasig' => 'No tiene Asignada ninguna Solicitud.'
            );
        }

        return response()->json($result,200);
    }
    
    //FUNCION PARA TRAER DE BASE DE UN CANDIDATO 
    public function unCandidato($id_candidato){
        $data = DB::select('SELECT rclcan.* , gene.descripcion as genero 
                            FROM 
                            rcl_candidato rclcan
                            join l_genero gene on gene.id_genero = rclcan.genero
                            WHERE id_candidato = '.$id_candidato.''
                            );

        if(count($data)>0){
            $result = array(
                'status' => 'success',
                'data' => $data
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'El Candidato no ha Registrado sus  Datos.'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE EL HISTORIAL DE STATUS DEL CANDIDATO
    public function statusCan($id_candidato){

        $statuscan = DB::select('SELECT rclsta.* , sta.descripcion as status
                            FROM 
                            rcl_candidato_status rclsta 
                            join l_status sta on sta.id_status = rclsta.status_proceso
                            WHERE id_candidato = '.$id_candidato.' ORDER BY id_candidato_status ASC'
                            );
        $statusult = DB::select('SELECT rclsta.* , sta.descripcion as status
                            FROM 
                            rcl_candidato_status rclsta 
                            join l_status sta on sta.id_status = rclsta.status_proceso
                            WHERE id_candidato = '.$id_candidato.' ORDER BY id_candidato_status DESC'
                            );
        
        if((count($statuscan)>0)&&(count($statusult)>0)){
            $result = array(
                'status' => 'success',
                'statuscan' => $statuscan,
                'statusult' => $statusult
            );
        }else{
            $result = array(
                'status' => 'errorstatus',
                'statuscan' => 'Pendiente.'
            );
        }

        return response()->json($result,200);
    }

    
    //FUNCION PARA TRAER DE BASE LA CITA DEL CANDIDATO
    public function citaCan($id_candidato){

        // $citacan = DB::table('rcl_candidato')->where('rcl_candidato.id_candidato', '=', $id_candidato)->join('rcl_candidato_entrevista', 'rcl_candidato.id_candidato', '=', 'rcl_candidato_entrevista.id_candidato')->get();
        
        $citacan = DB::select('SELECT * 
                            FROM 
                            rcl_candidato_entrevista 
                            WHERE id_candidato = '.$id_candidato.' ORDER BY id_candidato_entrevista ASC'
                            );
        $citacanult = DB::select('SELECT * 
                            FROM 
                            rcl_candidato_entrevista 
                            WHERE id_candidato = '.$id_candidato.' ORDER BY id_candidato_entrevista DESC'
                            );

        if((count($citacan)>0)&&(count($citacanult)>0)){
            $result = array(
                'status' => 'success',
                'citacan' => $citacan,
                'citacanult' => $citacanult
            );
        }else{
            $result = array(
                'status' => 'errorcita',
                'citacan' => 'No tiene Cita Asignada el Candidato.'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE LAS OBSERVACIONES DEL CONTRATO DEL CANDIDATO
    public function contratoCan($id_candidato){

        $contratocan = DB::table('rcl_candidato')->where('rcl_candidato.id_candidato', '=', $id_candidato)->join('rcl_candidato_contrato', 'rcl_candidato.id_candidato', '=', 'rcl_candidato_contrato.id_candidato')->get();
        
        $rechazocan = DB::table('rcl_candidato')->where('rcl_candidato.id_candidato', '=', $id_candidato)->join('rcl_candidato_contrato_rechazo', 'rcl_candidato.id_candidato', '=', 'rcl_candidato_contrato_rechazo.id_candidato')->get();

        $cargo = DB::select('SELECT canCon.* , cargo.descripcion as cargo 
                            FROM
                            rcl_candidato_contrato canCon 
                            join l_cargos cargo on cargo.id_cargo = canCon.id_cargo
                            WHERE id_candidato = '.$id_candidato.''
                            );

        if((count($contratocan)>=0)||(count($rechazocan)>=0)){
            $result = array(
                'status' => 'success',
                'contratocan' => $contratocan,
                'cargo' => $cargo,
                'rechazocan' => $rechazocan
            );
        }else{
            $result = array(
                'status' => 'errorcontratocan',
                'contratocan' => 'No Tiene Observaciones sobre Contrato.'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA TRAER DE BASE LAS OBSERVACIONES DEL CANDIDATO
    public function obsCan($id_candidato){
        
        $obscan = DB::select('SELECT obse.* , rol.descripcion as rol 
                            FROM
                            rcl_candidato_observaciones obse 
                            join l_roles rol on rol.id_rol = obse.rol
                            WHERE id_candidato = '.$id_candidato.''
                            );

        if(count($obscan)>0){
            $result = array(
                'status' => 'success',
                'obscan' => $obscan
            );
        }else{
            $result = array(
                'status' => 'errorobs',
                'obscan' => 'No se le han Realizado Observaciones al Candidato.'
            );
        }

        return response()->json($result,200);
    }

    //FUNCION PARA CREAR UN NUEVO CANDIDATO
    public function createCandidato(Request $request){


        $json = $request->input('json',null);
        $params =  json_decode($json);

            $candidato = new Candidato();
            $candidato->dni = $params->dni;
            $candidato->nombres = $params->nombres;
            $candidato->apellidos = $params->apellidos;
            $candidato->fec_nac = $params->fecnac;
            $candidato->genero = $params->genero;
            $candidato->tel_habitacion = $params->telhab;
            $candidato->tel_movil = $params->telmov;
            $candidato->email = $params->email;
            $candidato->save();
        //return $request->all();

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Candidato Registrado Exitosamente'
            );

        return response()->json($request,200);

    }

    //FUNCION PARA CREAR UNA NUEVA SOLICITUD DE PERSONAL
    public function crearSolicitud(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $solicitud = new Solicitud();
            $solicitud->solicitante = $params->solicitante;
            $solicitud->tipo_requerimiento = $params->tipo_requerimiento;
            $solicitud->area_trabajo = $params->area_trabajo;
            $solicitud->cargo = $params->cargo;
            $solicitud->profesion = $params->profesion;
            $solicitud->pais = $params->pais;
            $solicitud->conocimiento = $params->conocimiento;
            $solicitud->experiencia = $params->experiencia;
            $solicitud->otros_requisitos = $params->otros_requisitos;
            $solicitud->descripcion_trabajo = $params->descripcion_trabajo;
            $solicitud->save();
        //return $request->all();

            $request = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Solicitud Registrada Exitosamente'
            );

        return response()->json($request,200);

    }

    //FUNCION PARA MOSTRAR EN EL DASHBOARD CUANTAS SOLICITUDES, CANDIDATOS Y EMPLEADOS Y USUARIOS EXISTEN
    public function contador(Request $request){
        // $candidatosolicitud = DB::select('SELECT count(id_candidato) FROM rcl_candidato CAN join rcl_solicitud_candidato CS on CAN.id_candidato != CS.id_Candidato ');
        $candidatosconsolicitud = DB::select('SELECT count(DISTINCT id_candidato) FROM rcl_solicitud_candidato');
        $solicitudconcandidatos = DB::select('SELECT count(DISTINCT id_solicitud) FROM rcl_solicitud_candidato');

        $data = DB::select('SELECT count(id_solicitud) FROM rcl_solicitud');
        $data2 = DB::select('SELECT count(id_candidato) FROM rcl_candidato');
        $data3 = DB::select('SELECT count(id_contrato) FROM rcl_candidato_contrato');
        $data4 = DB::select('SELECT count(id) FROM users');
        
        $candidatossinsolicitud = $data2[0]->count - $candidatosconsolicitud[0]->count;
        $solicitudsincandidatos = $data[0]->count - $solicitudconcandidatos[0]->count;

        $fecha   = date('Y-m-d');
        $dia     = date('d');
        $dian    = date('N');
        $mes     = date('n');
        $anio    = date('Y');
        
        $fecha_anterior   = date('Y-m-d', strtotime("-1 week"));
        
        $sql5     = "SELECT count(id) FROM users WHERE created_at <=? AND created_at >=? ";
        $data5    = DB::select($sql5, array($fecha,$fecha_anterior));
        $sql6     = "SELECT count(id_solicitud) FROM rcl_solicitud WHERE created_at <=? AND created_at >=? ";
        $data6    = DB::select($sql6, array($fecha,$fecha_anterior));
        $sql7     = "SELECT count(id_candidato) FROM rcl_candidato WHERE created_at <=? AND created_at >=? ";
        $data7    = DB::select($sql7, array($fecha,$fecha_anterior));
        $sql8     = "SELECT count(id_contrato) FROM rcl_candidato_contrato WHERE created_at <=? AND created_at >=? ";
        $data8    = DB::select($sql8, array($fecha,$fecha_anterior));

        $sql9     = "SELECT * FROM rcl_candidato_entrevista CE join rcl_candidato can on can.id_candidato = CE.id_candidato WHERE fecha_entrevista =? ";
        $data9    = DB::select($sql9, array($fecha));
        $sql10     = "SELECT * FROM rcl_solicitud WHERE created_at >=? ";
        $data10    = DB::select($sql10, array($fecha));
        
        //dd($fecha);

        if((count($data)>=0)&&(count($data2)>=0)){
            $result = array(
                'status' => 'success',
                'candidatosconsolicitud' => $candidatosconsolicitud,
                'solicitudconcandidatos' => $solicitudconcandidatos,
                'data' => $data,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4,
                'data5' => $data5,
                'data6' => $data6,
                'data7' => $data7,
                'data8' => $data8,
                'data9' => $data9,
                'data10' => $data10,
                'dia' => $dia,
                'dian' => $dian,
                'mes' => $mes,
                'anio' => $anio,
                'candidatossinsolicitud' => $candidatossinsolicitud,
                'solicitudsincandidatos' => $solicitudsincandidatos,
                'fecha' => $fecha
            );
        }else{
            $result = array(
                'status' => 'error',
                'data' => 'no data'
            );
        }


        return response()->json($result,200);
    }


    //FUNCION PARA ELIMINAR DE BASE DE DATOS UN USUARIO REGISTRADOS EN EL SISTEMA
    public function deleteUsuario($id){
        
        $usuario = User::find($id);

        $usuario->delete();

        $request = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Usuario Eliminado Exitosamente'
            );

        return response()->json($request,200);
        //return response()->json(['data' => $usuario],200);
    }

    //FUNCION PARA ELIMINAR DE BASE DE DATOS UN CANDIDATO
    public function deleteCandidato($id_candidato){
        
        $candidato = Candidato::find($id_candidato);
        
        $candidato->delete();

        $request = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Candidato Eliminado Exitosamente'
            );

        return response()->json($request,200);
        //return response()->json(['data' => $usuario],200);
    }

    //FUNCION PARA ELIMINAR DE BASE DE DATOS UNA SOLICITUD
    public function deleteSolicitud($id_solicitud){
        
        $solicitud = Solicitud::find($id_solicitud);

        $solicitud->delete();

        $request = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Solicitud Eliminado Exitosamente'
            );

        return response()->json($request,200);
        //return response()->json(['data' => $usuario],200);
    }

    //FUNCION PARA ELIMINAR DE BASE DE DATOS UN STATUS DE UN CANDIDATO
    public function deleteStatus($id_candidato){
        
        $statusproceso = StatusProceso::find($id_candidato);

        $statusproceso->delete();

        $request = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Status Eliminado Exitosamente'
            );

        return response()->json($request,200);
        //return response()->json(['data' => $usuario],200);
    }

    //FUNCION PARA ELIMINAR DE BASE DE DATOS UNA CITA DE UN CANDIDATO
    public function deleteCita($id_candidato){
        
        $citaproceso = CitaProceso::find($id_candidato);

        $citaproceso->delete();

        $request = array(
                'status' => 'success',
                'code' => 200,  
                'message' => 'Cita Eliminada Exitosamente'
            );

        return response()->json($request,200);
        //return response()->json(['data' => $usuario],200);
    }

    //FUNCION PARA ASIGNAR CITA A UN CANDIDATO
    public function citaCandidato(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $citaproceso = new CitaProceso();
            // $proceso = Proceso::find($id_candidato);
            $citaproceso->id_candidato = $params->id_candidato;
            $citaproceso->fecha_entrevista = $params->fecha_entrevista;
            $citaproceso->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente la Cita.'
            );

        return response()->json($request,200);
    }

    //FUNCION PARA ASIGNAR CONTRATO A UN CANDIDATO
    public function contratoCandidato(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $contrato = new ContratoCandidato();
            // $proceso = Proceso::find($id_candidato);
            $contrato->id_candidato = $params->id_candidato;
            $contrato->id_cargo = $params->id_cargo;
            $contrato->fecha_ingreso = $params->fecha_ingreso;
            $contrato->salario = $params->salario;
            $contrato->observaciones = $params->observaciones;
            $contrato->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente el Contrato.'
            );

        return response()->json($request,200);
    }

    //FUNCION PARA RECHAZO DE CONTRATO POR UN CANDIDATO
    public function rechazoContrato(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $rechazocontrato = new RechazoContrato();
            // $proceso = Proceso::find($id_candidato);
            $rechazocontrato->id_candidato = $params->id_candidato;
            $rechazocontrato->observaciones = $params->observaciones;
            $rechazocontrato->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente el Rechazo del Contrato.'
            );

        return response()->json($request,200);
    }

    //FUNCION PARA ASIGNAR EL STATUS A UN CANDIDATO
    public function status(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $statusproceso = new StatusProceso();
            //$proceso = Proceso::find($id_candidato);
            $statusproceso->id_candidato = $params->id_candidato;
            $statusproceso->status_proceso = $params->status_proceso;
            $statusproceso->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente el Status del Candidato.'
            );

        return response()->json($request,200);
    }


    //FUNCION PARA REALIZAR LA OBSERVACION DEL ANALISTA A UN CANDIDATO
    public function obsAnalista(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);
        
        

            $proceso = new Proceso();
            //$proceso = Proceso::find($id_candidato);
            $proceso->id_candidato = $params->id_candidato;
            $proceso->obs_analista = $params->obs_analista;
            $proceso->fecha_analista = $params->fecha_analista;
            $proceso->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente la Observación.'
            );

        return response()->json($request,200);
    }

     //FUNCION PARA REALIZAR LA OBSERVACION DEL TECNICO A UN CANDIDATO
    public function obsTecnico(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $proceso = new Proceso();
            //$proceso = Proceso::find($id_candidato);
            $proceso->id_candidato = $params->id_candidato;
            $proceso->obs_tecnico = $params->obs_tecnico;
            $proceso->fecha_tecnico = $params->fecha_tecnico;
            $proceso->save();
        
            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente la Observación.'
            );

        return response()->json($request,200);
    }

    //FUNCION PARA REALIZAR LA OBSERVACION DE LA GERENCIA A UN CANDIDATO
    public function obsGerencia(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $proceso = new Proceso();
            //$proceso = Proceso::find($id_candidato);
            $proceso->id_candidato = $params->id_candidato;
            $proceso->obs_gerencia = $params->obs_gerencia;
            $proceso->fecha_gerencia = $params->fecha_gerencia;
            $proceso->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente la Observación.'
            );

        return response()->json($request,200);
    }

    //FUNCION PARA REALIZAR LA OBSERVACION DE LA GERENCIA A UN CANDIDATO
    public function observacionCandidato(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $observacionproceso = new ObservacionProceso();
            //$proceso = Proceso::find($id_candidato);
            $observacionproceso->id_candidato = $params->id_candidato;
            $observacionproceso->observaciones = $params->observaciones;
            $observacionproceso->entrevistador = $params->entrevistador;
            $observacionproceso->rol = $params->rol;
            $observacionproceso->fecha_observacion = $params->fecha_observacion;
            $observacionproceso->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente la Observación.'
            );

        return response()->json($request,200);
    }

    //FUNCION PARA REALIZAR LA OBSERVACION DE LA GERENCIA A UN CANDIDATO
    public function solicitudCandidato(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $solicitudcandidato = new SolicitudCandidato();
            //$proceso = Proceso::find($id_candidato);
            $solicitudcandidato->id_candidato = $params->id_candidato;
            $solicitudcandidato->id_solicitud = $params->id_solicitud;
            $solicitudcandidato->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente la Solicitud al Candidato.'
            );

        return response()->json($request,200);
    }

    
    //FUNCION PARA ACTUALIZAR DE BASE DE DATOS UN USUARIO REGISTRADOS EN EL SISTEMA
    public function updateUsuario(Request $request, $id){

        $json                    = $request->input('json', null);
        $params                  = json_decode($json);
        $usuario               = User::where('id', '=', $params->id)->first();
        //$usuario               = User::where('id', '=', $id)->first();
        $usuario->email = $params->email;
        $usuario->rol    = $params->rol;
        $usuario->save();
        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Usuario Actualizado con éxito.',
        );

        return response()->json($result, 200);
    }

    //FUNCION PARA BUSCAR UNA SOLICITUD POR SOLICITANTE
    public function buscarSolicitudSolicitante(Request $request){
        
        $json = $request->input('json',null);
        $params =  json_decode($json);

        $solicitante = $params->solicitante;
        $query = "SELECT sol.* , req.descripcion as requerimiento, car.descripcion as cargo, destra.descripcion as descripcion_trabajo
                    FROM rcl_solicitud sol 
                    join l_tipo_requerimiento req on req.id_tipo_requerimiento = sol.tipo_requerimiento 
                            join l_cargos car on car.id_cargo = sol.cargo
                            join l_descripcion_trabajo destra on destra.id_descripcion_trabajo = sol.descripcion_trabajo
                    WHERE solicitante like ('".$solicitante."%')";
        
        $data = DB::select($query);

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

        return response()->json($result,200);
    }

    //FUNCION PARA BUSCAR UN CANDIDATO POR NOMBRE
    public function buscarCandidatoNombres(Request $request){
        
        $json = $request->input('json',null);
        $params =  json_decode($json);

        $nombres = $params->nombres;
        $query = "SELECT * FROM rcl_candidato WHERE nombres like ('".$nombres."%')";
        
        $data = DB::select($query);

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

        return response()->json($result,200);
    }

}
