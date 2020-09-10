<?php

namespace App\Http\Controllers\Documentos;
use App\Models\Documentos\Documentos;//modelo
use App\Models\Documentos\Clientes;//modelo
use App\Models\Documentos\Departamentos;//modelo
use App\Models\Documentos\Procedencias;//modelo
use App\Models\Documentos\Tipo_documentos;//modelo
use App\Models\Documentos\Extension;//modelo
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class GuardarController extends Controller
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//Registra Documento
    public function documento (Request $request){

      $json = $request->input('json',null);
      $params =  json_decode($json);
     
      $sole = new Documentos();

      $sole->nombre=$params->nombre;
      $sole->fecha_emision=$params->fecha_emision;
      $sole->fecha_entrega=$params->fecha_entrega;
      $sole->descripcion=$params->descripcion;
      $sole->ruta=$params->ruta;
      $sole->codigo=$params->codigo;
      $sole->destinatario=$params->destinatario;
      $sole->origen=$params->origen;
      $sole->id_procedencia=$params->id_procedencia;
      $sole->id_departamento=$params->id_departamento;
      $sole->id_cliente=$params->id_cliente;
      $sole->id_extension=$params->id_extension;
      $sole->id_tipo_doc=$params->id_tipo_doc;
      $sole->save();


        $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);

    }

//Guarda Archivos en la Carpeta Public/Archivos de laravel
     public function subirArchivo (Request $request) {
    
     
      if ($request->hasFile('image'))
      {
            $file      = $request->file('image');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            //$picture   = date('His').'-'.$filename;
            $picture   = $filename;
            $picture = str_replace(' ', '', $picture);
 
         
            $file->move(public_path('archivos'), $picture);
           
            return response()->json(["message" => "Archivo Cargado Exitosamente"]);
      } 
      else
      {
            return response()->json(["message" => "Selecciona un Archivo"]);
      }


      $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);
   }

 //Descarga Archivos
      public function download($file) {
        $pathtoFile = public_path().'/archivos/'.$file;
           return response()->download($pathtoFile);
       }

    



//Registra Clientes

    public function cliente (Request $request){
    	

      $json = $request->input('json',null);
      $params =  json_decode($json);

      $cli = new Clientes ;
      $cli->nombre=$params->nombre;
      $cli->direccion=$params->direccion;
      $cli->telefono_fijo=$params->telefono_fijo;
      $cli->telefono_celular=$params->telefono_celular;
      $cli->persona_contacto=$params->persona_contacto;
      
      $cli->save();


      $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);
    }

//Registra Departamento
      public function departamento (Request $request){
    	
      $json = $request->input('json',null);
      $params =  json_decode($json);

      $dep = new Departamentos ;
      $dep->nombre=$params->nombre;
      $dep->save();
      $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);
    }

//Registra Procedencia
     public function procedencia (Request $request){
   
      $json = $request->input('json',null);
      $params =  json_decode($json);

      $pro = new Procedencias ;
      $pro->nombre=$params->nombre; 
      $pro->save();

      $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);
    }

//Registra Tipo de Documento
     public function tipo_documento (Request $request){
   
      $json = $request->input('json',null);
      $params =  json_decode($json);

      $tip = new Tipo_documentos ;
      $tip->nombre=$params->nombre; 
	  $tip->descripcion=$params->descripcion; 

      $tip->save();

      $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);
    }

//Registra Extension
    public function extension (Request $request){
   
      $json = $request->input('json',null);
      $params =  json_decode($json);

      $ext = new Extension ;
      $ext->nombre=$params->nombre; 
   
      $ext->save();

      $result = array(
            'status' => 'success',
        );
        return response()->json($result, 200);
    }
  

   
}
