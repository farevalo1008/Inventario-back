<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use App\Cars;

class CarsController extends Controller
{
    //

    public function index(Request $request){

        $token = $request->header('Authorization',null);

        $jwtAutn = new JwtAuth();
        $checktoken = $jwtAutn->checkToken($token);

        if($checktoken){

            $cars = Cars::all();
            return response()->json(array(
                'cars'=>$cars,
                'status'=>'success'

            ));

        }else{
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 200
            );

            return response()->json($data,400);

        }

    }

    public function store(Request $request){
        $token = $request->header('Authorization',null);

        $jwtAutn = new JwtAuth();
        $checktoken = $jwtAutn->checkToken($token);

        if($checktoken){
            $user = $jwtAutn->checkToken($token , true);
            $json = $request->input('json',null);
            $params = json_decode($json);
            $params_array = json_decode($json,true);
            
            $valida = \Validator::make($params_array , [
                    'title' => 'required|min:5',
                    'description' => 'required',
                    'price' => 'required',
                    'status' => 'required'
            ]);
            
                
            if($valida->fails()){
                return response()->json($valida->errors(),400);
            }

            $car = new Cars();
            $car->title = $params->title ;
            $car->description = $params->description ;
            $car->price = $params->price ;
            $car->status = $params->status ;
            $car->id_user = $user->sub;

            $car->save();

            $data = array(
                'car' => $car,
                'status' => 'success',
                'code' => 200
            );

        }else{

            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 200
            );
        }

        return response()->json($data,200);
    }

    public function show($id){
        $car = Cars::find($id);

        return response()->json(array(
            'car'=>$car,
            'status'=>'success'
        ),200);
    }

    public function update($id, Request $request){
        $token = $request->header('Authorization',null);

        $jwtAutn = new JwtAuth();
        $checktoken = $jwtAutn->checkToken($token);

        if($checktoken){
            $json = $request->input('json',null);
            $params = json_decode($json);
            $params_array = json_decode($json,true);
            
            $valida = \Validator::make($params_array , [
                'title' => 'required|min:5',
                'description' => 'required',
                'price' => 'required',
                'status' => 'required'
            ]);
                    
            if($valida->fails()){
                return response()->json($valida->errors(),400);
            }


            $car = Cars::where('id_cars','=',$id)->update($params_array);
                        
            $data = array(
                'car' => $params,
                'status' => 'success',
                'code' => 200
            );
        }else{
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 200
            );
        }

        return response()->json($data,200);
    }


    public function destroy($id , Request $request){
        $token = $request->header('Authorization',null);

        $jwtAutn = new JwtAuth();
        $checktoken = $jwtAutn->checkToken($token);

        if($checktoken){
            $car = Cars::find($id);

            $car->delete();
        
            $data = array(
                'car' => $car,
                'status' => 'success',
                'code' => 200
            );

        }else{
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 200
            );
        }

        return response()->json($data,200);
    }
}
