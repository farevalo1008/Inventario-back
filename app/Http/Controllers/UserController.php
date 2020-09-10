<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use App\User;
use App\Models\DatosPersonales;

class UserController extends Controller
{
    //

    public function register(Request $request){

        $json = $request->input('json',null);
        $params =  json_decode($json);

        $email = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $rol = (!is_null($json) && isset($params->rol)) ? $params->rol : null;
        $password = substr($params->nombres,0,1).substr($params->apellidos,0,1).$params->dni.date('Y');
        
        if(!is_null($email) && !is_null($password) && !is_null($rol)){

            $usuario = new User();
            $usuario->email = strtoupper($email);
            $usuario->rol = $rol;

            $pwd = hash('sha256',$password);
            //echo $password."//".$pwd;die;
            $usuario->password = $pwd;

            $isset_user = User::where('email','=',strtoupper($email))->first();
            //var_dump($isset_user);die;
            if($isset_user==null){
                $usuario->save();
                $id_usuario = $usuario->id;

                $datosPersonales = new DatosPersonales();
                $datosPersonales->dni = $params->dni;
                $datosPersonales->nombres = strtoupper($params->nombres);
                $datosPersonales->apellidos = strtoupper($params->apellidos);
                $datosPersonales->fec_nacimiento = $params->fecnac;
                $datosPersonales->genero = $params->genero;
                $datosPersonales->tel_habitacion = $params->telhab;
                $datosPersonales->tel_movil = $params->telmov;
                $datosPersonales->imagen = $params->image;
                $datosPersonales->id_user = $id_usuario;
                $datosPersonales->id_pais = $params->pais;
                $datosPersonales->nacionalidad = $params->nacionalidad;
                $datosPersonales->save();

                //////////  envio de email al usuario creado con los datos pertinentes

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'usuario registrado exitosamente'
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'usuario duplicado'
                );
            }

        }else{
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuario debe tener un rol'
            );
        }
        
        return response()->json($data,200);

    }

    public function login(Request $request){
        
        $jwtAuth = new JwtAuth();

        $json = $request->input('json',null);
        $params = json_decode($json);

        $correo = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $password = (!is_null($json) && isset($params->password)) ? $params->password : null;
        $getToken = (!is_null($json) && isset($params->gettoken)) ? $params->gettoken : null;

        $email = strtoupper($correo);
        //cifrar password
        $pwd = hash('sha256',$password);
        //echo $password."//".$pwd;die;

        if(!is_null($email) && !is_null($password) && ($getToken==null || $getToken=='false')){
            $signup = $jwtAuth->signup($email,$pwd);
        
        }elseif($getToken != null){
            $signup = $jwtAuth->signup($email, $pwd, $getToken);
        
        }else{
            $signup =array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Debes iniciar sesión nuevamente'
            );
        }

        return response()->json($signup,200);

    }


public function getUsers(){
    $data = DatosPersonales::all()->user;
    return response()->json($data,200);
}



  

}
