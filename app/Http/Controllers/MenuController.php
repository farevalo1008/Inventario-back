<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use App\Models\Menu;


class MenuController extends Controller
{
    public function getMenuRoles(Request $request){
        $json = $request->input('json',null);
        $params =  json_decode($json);

        $rol_usuario = $params;
        
        $menu = Menu::whereIn('id_rol',[1,$rol_usuario])
                        ->orderBy('orden','asc')
                        ->get();

        //print_r($menu);die;
        if(count($menu)>0){
            $data = array(
                'status' => 'success' ,
                'code' => 200,
                'data' => $menu
            );
        }else{
            $data = array(
                'status' => 'error' ,
                'code' => 400,
                'message' => 'No hay rol para este usuario' 
            );
        }
        
        return response()->json($data,200);

    }

}
