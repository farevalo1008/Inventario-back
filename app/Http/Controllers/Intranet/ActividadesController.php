<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use App\Models\Intranet\Int_actividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActividadesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result  = '';
        $fecha   = date('d/m/Y');
        $sql     = "SELECT * FROM int_actividades WHERE fecha_inicio<=? AND fecha_fin>=?";
        $data    = DB::select($sql, array($fecha, $fecha));
        $alldata = DB::select('SELECT * FROM int_actividades');
        if (isset($data)) {
            $result = array(
                'status'  => 'success',
                'data'    => $data,
                'alldata' => $alldata,
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No se encuentran Actividades',
            );
        }
        return response()->json($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json                    = $request->input('json', null);
        $params                  = json_decode($json);
        $actividad               = new Int_actividades();
        $actividad->fecha_inicio = $params->fecha_inicio;
        $actividad->fecha_fin    = $params->fecha_fin;
        $actividad->encargado    = $params->encargado;
        $actividad->titulo       = $params->titulo;
        $actividad->descripcion  = $params->descripcion;
        $actividad->save();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Registrada con exito.',
        );

        return response()->json($result, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $json                    = $request->input('json', null);
        $params                  = json_decode($json);
        $actividad               = Int_actividades::where('id', '=', $params->id)->first();
        $actividad->fecha_inicio = $params->fecha_inicio;
        $actividad->fecha_fin    = $params->fecha_fin;
        $actividad->encargado    = $params->encargado;
        $actividad->titulo       = $params->titulo;
        $actividad->descripcion  = $params->descripcion;
        $actividad->save();
        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad Actualizada con exito.',
        );

        return response()->json($result, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $json      = $request->input('json', null);
        $params    = json_decode($json);
        $actividad = Int_actividades::where('id', '=', $params)->first();
        $actividad->delete();
        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => 'Actividad eliminada con exito.',
        );

        return response()->json($result, 200);
    }

    public function getActivity(Request $request)
    {
        $json      = $request->input('json', null);
        $params    = json_decode($json);
        $actividad = Int_actividades::where('id', '=', $params)->first();

        $result = array(
            'status' => 'success',
            'code'   => 200,
            'data'   => $actividad,
        );

        return response()->json($result, 200);
    }

    public function nextEvent()
    {
        $fecha   = date('Y-m-d');
        $result  = '';
        $query   = "SELECT * FROM public.int_actividades WHERE fecha_inicio >? ORDER BY fecha_inicio ASC LIMIT 10";
        $eventos = DB::SELECT($query, array($fecha));
        if (count($eventos) > 0) {
            $result = array(
                'status' => 'success',
                'code'   => 200,
                'data'   => $eventos,
            );
        } else {
            $result = array(
                'status'  => 'error',
                'message' => 'No se han registrado Eventos.',
            );
        }
        return response()->json($result, 200);
    }

}
