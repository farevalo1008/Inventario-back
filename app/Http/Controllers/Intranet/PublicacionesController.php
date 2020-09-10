<?php

namespace App\Http\Controllers\Intranet;

use App\Models\Intranet\Int_publicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $data          = DB::select('select * from int_publicaciones ORDER BY id DESC  LIMIT 3');
        $publicaciones = DB::select('select * from int_publicaciones ORDER BY id DESC LIMIT 10');
        if (count($data) > 0) {
            $result = array(
                'status'        => 'success',
                'data'          => $data,
                'publicaciones' => $publicaciones,
            );
        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'no data',
            );
        }
        return response()->json($result, 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json   = $request->input('json', null);
        $params = json_decode($json);

        $publicacion               = new Int_publicaciones;
        $publicacion->user_name    = $params->user_name;
        $publicacion->publicacion  = $params->publicacion;
        $publicacion->departamento = $params->departamento;
        $publicacion->save();

        $result = array(
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Informacion publicada',
        );
        return response()->json($result, 200);

    }

   
    public function getnoticias()
    {
        $publicaciones = DB::select('select * from int_publicaciones ORDER BY id DESC LIMIT 200');
        if (count($publicaciones) > 0) {
            $result = array(
                'status'        => 'success',
                'publicaciones' => $publicaciones,
            );
        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'no data',
            );
        }
        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
