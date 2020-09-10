<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request)
    //         ->header('Access-Control-Allow-Origin', '*')
    //         ->header('Access-Control-Max-Age','86400')

    //         ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS')
    //         ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token, Authorization, X-Requested-With')
    //         //PERMITE EL ACCESO A CREDENCIALES QUE EL Access-Control-Allow-Origin TIENE BLOQUEADAS
    //         ->header('Access-Control-Allow-Credentials', 'true');

    //          if ($request->isMethod('OPTIONS')) {
    //         return response()->json('{"method":"OPTIONS"}', 200, $headers);
    //     }
 
    //     $response = $next($request);
    //     foreach($headers as $key => $value) {
    //         $response->headers->set($key, $value);
    //     }
 
    //     return $response;
       
    // }

     public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS,PATCH,PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With,Origin, X-Auth-Token'
        ];
 
        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }
 
        $response = $next($request);
        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }
 
        return $response;
    }
}


  