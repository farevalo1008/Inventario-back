<?php

namespace App\Http\Controllers\Reclutamiento;

use App\Models\Reclutamiento\Candidato;
use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Reclutamiento\DatosAcademicos;
use App\Models\Reclutamiento\DatosLaborales;
use App\Models\Reclutamiento\Habilidades;
use App\Models\Reclutamiento\Archivos;

class AspiranteController extends Controller
{
    //FUNCION PARA BUSCAR SI EL ASPIRANTE SE ENCUENTRA EN EL PROCESO DE RECLUTAMIENTO Y SELECCION
    public function aspirante(Request $request)
    {
    	$json = $request->input('json',null);
        $params =  json_decode($json);
    	$dni = $params->dni;
    	settype($dni, "integer");
    	//$data = DB::select('SELECT * FROM rcl_candidato WHERE dni = '. $dni.'');
    	$data = DB::select('SELECT recan.* , gen.descripcion as genero 
                            FROM 
                            rcl_candidato recan 
                            join l_genero gen on gen.id_genero = recan.genero
                            WHERE dni = '.$dni.''
                            );
    	if (count($data) == 1) {
    		$result = array(
                'status' => 'success',
                'data' => $data
            );	
    	}else{
    		$result = array(
                'status' => 'error',
                'code' => 400,
                'data' => 'La cédula ingresada no se encuentra registrada'
            );
    	}
    	return response()->json($result,200);	
    }
    //FUNCION PARA TRAER DE BASE DE DATOS DATOS ACADEMICOS DE UN CANDIDATO
    public function datosAcademicos($id_candidato){
        //$academicos = DB::select('SELECT * FROM rcl_candidato_datos_academicos WHERE id_candidato ='.$id_candidato.'' );
        $academicos = DB::select('SELECT recdataca.* , est.descripcion as estudio, pai.descripcion as pais 
                            FROM 
                            rcl_candidato_datos_academicos recdataca 
                            join l_tipo_estudio est on est.id_tipo_estudio = recdataca.tipo_estudio 
                            join l_pais pai on pai.id_pais = recdataca.pais
                            WHERE id_candidato = '.$id_candidato.''
                            );    
        if(count($academicos)>0){
            $result = array(
                'status' => 'success',
                'academicos' => $academicos
            );
        }else{
            $result = array(
                'status' => 'erroracademico',
                'academicos' => 'No ha Registrado los Datos Académicos.'
            );
        }

        return response()->json($result,200);
    }
    //FUNCION PARA TRAER DE BASE DE DATOS DATOS ACADEMICOS DE UN CANDIDATO
    public function datosLaborales($id_candidato){
        //$laborales = DB::select('SELECT * FROM rcl_candidato_datos_laborales WHERE id_candidato ='.$id_candidato.'' );
        $laborales = DB::select('SELECT recdatlab.* , atra.descripcion as area 
                            FROM 
                            rcl_candidato_datos_laborales recdatlab 
                            join l_area_trabajo atra on atra.id_area_trabajo = recdatlab.area_trabajo 
                            WHERE id_candidato = '.$id_candidato.''
                            );

        if(count($laborales)>0){
            $result = array(
                'status' => 'success',
                'laborales' => $laborales
            );
        }else{
            $result = array(
                'status' => 'errorlaborales',
                'laborales' => 'No ha Registrado los Datos Laborales.'
            );
        }

        return response()->json($result,200);
    }
    //FUNCION PARA TRAER DE BASE LAS HABILIDADES DE UN CANDIDATO
    public function habilidades($id_candidato){
        //$habilidades = DB::select('SELECT * FROM rcl_candidato_habilidades WHERE id_candidato ='.$id_candidato.'' );
        $habilidades = DB::select('SELECT habi.* , prof.descripcion as profesion, idio.descripcion as idioma, cono.descripcion as conocimiento 
                            FROM 
                            rcl_candidato_habilidades habi 
                            join l_profesion prof on prof.id_profesion = habi.profesion 
                            join l_idiomas idio on idio.id_idioma = habi.idiomas
                            join l_conocimientos cono on cono.id_conocimiento = habi.conocimiento
                            WHERE id_candidato = '.$id_candidato.''
                            );    
        if(count($habilidades)>0){
            $result = array(
                'status' => 'success',
                'habilidades' => $habilidades
            );
        }else{
            $result = array(
                'status' => 'errorhabilidades',
                'habilidades' => 'No ha Registrado las Habilidades.'
            );
        }

        return response()->json($result,200);
    }
    //FUNCION PARA TRAER DE BASE LOS ARCHIVOS DE UN CANDIDATO
    public function archivos($id_candidato){
        $archivos = DB::select('SELECT * FROM rcl_candidato_archivos WHERE id_candidato ='.$id_candidato.'' );
            
        if(count($archivos)>0){
            $result = array(
                'status' => 'success',
                'archivos' => $archivos
            );
        }else{
            $result = array(
                'status' => 'errorarchivos',
                'archivos' => 'No ha Subido Archivos.'
            );
        }

        return response()->json($result,200);
    }
    //FUNCION PARA AGREGAR LOS DATOS ACADEMICOS DEL ASPIRANTE
    public function aspiranteDatosAcademicos(Request $request){


        $json = $request->input('json',null);
        $params =  json_decode($json);

            $datosAcademicos = new DatosAcademicos();
            $datosAcademicos->id_candidato = $params->id_candidato;
            $datosAcademicos->pais = $params->pais;
            $datosAcademicos->tipo_estudio = $params->tipo_estudio;
            $datosAcademicos->institucion = $params->institucion;
            $datosAcademicos->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente los Datos Académicos'
            );

        return response()->json($request,200);

    }

    //FUNCION PARA AGREGAR LOS DATOS LABORALES DEL ASPIRANTE
    public function aspiranteDatosLaborales(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $datosLaborales = new DatosLaborales();
            $datosLaborales->id_candidato = $params->id_candidato;
            $datosLaborales->empresa = $params->empresa;
            $datosLaborales->area_trabajo = $params->area_trabajo;
            $datosLaborales->funciones_principales = $params->funciones_principales;
            $datosLaborales->save();
        

            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente los Datos Laborales'
            );

        return response()->json($request,200);

    }

    //FUNCION PARA AGREGAR LAS HABILIDADES DEL ASPIRANTE
    public function aspiranteHabilidades(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

            $habilidades = new Habilidades();
            $habilidades->id_candidato = $params->id_candidato;
            $habilidades->profesion = $params->profesion;
            $habilidades->conocimiento = $params->conocimiento;
            $habilidades->idiomas = $params->idiomas;
            $habilidades->save();
        
            $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente las Habilidades'
            );

        return response()->json($request,200);

    }

    //FUNCION PARA AGREGAR LOS ARCHIVOS DEL ASPIRANTE
    public function aspiranteArchivos(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

        $archivo = new Archivos();
        $archivo->id_candidato = $params->id_candidato;
        $archivo->nombre_archivo = $params->nombre_archivo;
        $archivo->save();

        $request = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Registrado Exitosamente su Documento'
            );

        return response()->json($request,200);
    }
}
