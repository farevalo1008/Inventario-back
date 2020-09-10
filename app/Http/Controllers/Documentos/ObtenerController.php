<?php

namespace App\Http\Controllers\Documentos;
use App\Models\Documentos\Doc_documento;//modelo
use App\Models\Documentos\Documentos;//modelo
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ObtenerController extends Controller
{

    //Obtener los documentos internos excepto los clientes
    public function getDocumentoInterno(Request $request){
        $data = DB::select('SELECT docu.* , dep.nombre as dpto, tipo.nombre as tipodoc, exte.nombre as ext
        
       		FROM doc_documentos docu
       		     join  doc_departamentos dep on dep.id_departamento = docu.id_departamento
       		     join  doc_tipo_documentos tipo on tipo.id_tipo_doc = docu.id_tipo_doc
       		     join  l_doc_extension exte on exte.id_extension = docu.id_extension
       		     
       		 WHERE  docu.id_cliente is null ORDER BY fecha_emision DESC
       		     ');
       

       if(count($data)>0) {
           $result = array(
               'status' => 'success',
               'data' => $data
           );
       }else{
           $result = array( 
               'status' => 'error',
               'data' => 'No existen Documentos en la Base de Datos'
           );
       }
       return response()->json($result,200);
   }

  //Buscar los documentos por codigo, nombre y tipo de documento
    public function buscarDocumentoInterno(Request $request){
        
        $json = $request->input('json',null);
        $params =  json_decode($json);
        $nombre = $params->nombre;

        $query = "SELECT docu.*,dep.nombre as dpto, tipo.nombre as tipodoc, exte.nombre as ext
    
            FROM doc_documentos as docu
              join  doc_departamentos dep on dep.id_departamento = docu.id_departamento
              join  doc_tipo_documentos tipo on tipo.id_tipo_doc = docu.id_tipo_doc
              join  l_doc_extension exte on exte.id_extension = docu.id_extension
              
          WHERE docu.nombre like ('%".$nombre."%') and docu.id_cliente is null or docu.codigo like ('%".$nombre."%') and docu.id_cliente is null or  tipo.nombre like ('%".$nombre."%') and docu.id_cliente is null ORDER BY fecha_emision DESC";

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


  //Obtener los documentos externos
	public function getDocumentoExterno(Request $request){
     

        $data = DB::select('SELECT docu.* , dep.nombre as dpto, tipo.nombre as tipodoc, exte.nombre as ext
        	, cli.nombre as client
 
       		FROM doc_documentos docu
       		     join  doc_departamentos dep on dep.id_departamento = docu.id_departamento
       		     join  doc_tipo_documentos tipo on tipo.id_tipo_doc = docu.id_tipo_doc
       		     join  l_doc_extension exte on exte.id_extension = docu.id_extension
       		     join  doc_clientes cli on cli.id_cliente = docu.id_cliente
       		      ORDER BY fecha_emision DESC
       		     ');
       

       if(count($data)>0) {
           $result = array(
               'status' => 'success',
               'data' => $data
           );
       }else{
           $result = array( 
               'status' => 'error',
               'data' => 'No existen Documentos en la Base de Datos'
           );
       }
       return response()->json($result,200);
   }

//Actualizar los documentos
 public function update($id_documento, Request $request)
    {
      //echo "actualizar";
        $json                    = $request->input('json', null);
        $params                  = json_decode($json);
        $documento               = Doc_documento::find($id_documento); 
        $documento ->nombre  = $params->nombre;
        $documento ->descripcion  = $params->descripcion;
        $documento ->origen   = $params->origen;
        $documento ->fecha_emision   = $params->fecha_emision;
        $documento ->fecha_entrega  = $params->fecha_entrega;
        $documento ->ruta  = $params->ruta;
        $documento ->codigo  = $params->codigo;
        $documento ->destinatario  = $params->destinatario;
        $documento ->id_cliente  = $params->id_cliente;
        $documento ->id_departamento  = $params->id_departamento;
        $documento ->id_extension  = $params->id_extension;
        $documento ->id_tipo_doc  = $params->id_tipo_doc;
    
        
        $documento ->save();
        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Documento Actualizado con exito.',
        );

        return response()->json($result, 200);

    }

   
    //Buscar los documentos externos por codigo, tipo de documento, nombre y cliente
    public function buscarDocumentoExterno(Request $request){
        
        $json = $request->input('json',null);
        $params =  json_decode($json);

        $nombre = $params->nombre;

        $query = "SELECT docu.*,dep.nombre as dpto, tipo.nombre as tipodoc, exte.nombre as ext, cli.nombre as      client
   	
   					FROM doc_documentos as docu
  						join  doc_departamentos dep on dep.id_departamento = docu.id_departamento
  						join  doc_tipo_documentos tipo on tipo.id_tipo_doc = docu.id_tipo_doc
  						join  doc_clientes cli on cli.id_cliente = docu.id_cliente
  						join  l_doc_extension exte on exte.id_extension = docu.id_extension
					
					WHERE docu.nombre  like ('%".$nombre."%') or docu.codigo like ('%".$nombre."%') or cli.nombre like ('%".$nombre."%') or  tipo.nombre like ('%".$nombre."%')  ORDER BY fecha_emision DESC";
        


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
