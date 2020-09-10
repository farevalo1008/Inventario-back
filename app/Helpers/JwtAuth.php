<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\DatosPersonales;
use App\Models\Role;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'esta-es-mi-clave-1234567890';
    }

    public function signup($email , $password , $getToken = null){

        $search_user = User::where([
            ['email','=',$email],
            ['password','=',$password],
        ])->first();

        $signup = false;

        if(is_object($search_user)){
            $search_data = DatosPersonales::where('id_user','=',$search_user->id)->first();
            $search_rol = Role::where('id_rol','=',$search_user->rol)->first();

            $signup = true;
        }

        if($signup){
            $token = array(
                'sub' => $search_user->id ,
                'email' => $search_user->email ,
                'rol' => $search_user->rol,
                'des_rol' => $search_rol->descripcion,
                'nombres' => $search_data->nombres,
                'apellidos' => $search_data->apellidos,
                'dni' => $search_data->dni,             
                'iat' => time(),
                'exp' => time() + (7*24*60*60)                
            );

            $jwt = JWT::encode($token , $this->key, 'HS256' );
            $decode = JWT::decode($jwt , $this->key , array('HS256'));

            if(is_null($getToken)){
                return $jwt;
            }else{
                return $decode;
            }

        }else{

            return array('status' => 'error', 'message'=> 'Credenciales invalidas');

        }

    }


    public function checkToken($jwt , $getIdentity = false){
        $auth = false;
        
        try{
            $decode = JWT::decode($jwt, $this->key , array('HS256'));

        }catch(\UnexpectedValueException $e){
            $auth = false;
        
        }catch(\DomainExcepction $e){
            $auth = false;

        }

        if(isset($decode) && is_object($decode) && isset($decode->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $decode;
        }

        return $auth;
    }

}