<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use App\Models\intranet\Int_control_actividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControlActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $json          = $request->input('json', null);
        $params        = json_decode($json);
        $year          = date('Y');
        $query         = 'SELECT * FROM public.int_control_actividades INNER JOIN int_l_tipo_actividad ON int_control_actividades.tipo_actividad_id   =int_l_tipo_actividad.id WHERE int_control_actividades.user_id =' . $params->user_id . ' AND EXTRACT(MONTH FROM int_control_actividades.fecha) =  ' . $params->mes . ' AND EXTRACT(YEAR FROM int_control_actividades.fecha) = ' . $year . '  ORDER BY fecha ASC';
        $actividades   = DB::SELECT($query);
        $cantidad      = count($actividades);
        $hora_curso    = 0;
        $hora_proyecto = 0;
        $hora_cliente  = 0;
        $hora_permiso  = 0;
        $hora_otros    = 0;
        $total_horas   = 0;

        for ($i = 0; $i < $cantidad; $i++) {
            if ($actividades[$i]->tipo_actividad_id == 1) {
                $hora_curso += $actividades[$i]->hora;
            }

            if ($actividades[$i]->tipo_actividad_id == 2) {
                $hora_proyecto += $actividades[$i]->hora;
            }

            if ($actividades[$i]->tipo_actividad_id == 3) {
                $hora_cliente += $actividades[$i]->hora;
            }

            if ($actividades[$i]->tipo_actividad_id == 4) {
                $hora_permiso += $actividades[$i]->hora;
            }

            if ($actividades[$i]->tipo_actividad_id == 5) {
                $hora_otros += $actividades[$i]->hora;
            }

        }

        $total_horas = $hora_curso + $hora_proyecto + $hora_cliente + $hora_permiso + $hora_otros;
        $result      = array(
            'status'        => 'success',
            'data'          => $actividades,
            'cantidad'      => $cantidad,
            'hora_curso'    => $hora_curso,
            'hora_proyecto' => $hora_proyecto,
            'hora_cliente'  => $hora_cliente,
            'hora_permiso'  => $hora_permiso,
            'hora_otros'    => $hora_otros,
            'total_horas'   => $total_horas,
        );
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
        $json       = $request->input('json', null);
        $params     = json_decode($json);
        $sql        = "SELECT * FROM Int_control_actividades WHERE user_id=? AND fecha=?";
        $data       = DB::select($sql, array($params->user, $params->fecha));
        $hora_dia   = 0;
        $hora_resto = 0;
        $mensaje    = '';
        $status     = 'success';

        if (count($data) == 0) {
            if ($params->hora <= 8) {
                $this->registraActividad($params);
                $mensaje = 'Actividad Registrada.';
            } else {
                $status  = 'error';
                $mensaje = 'No puede registrar actividades que sobre pasen las 8 horas.';
            }

            $result = array(
                'status'  => $status,
                'message' => $mensaje,

            );

        } else {

            for ($i = 0; $i < count($data); $i++) {
                $hora_dia = $hora_dia + $data[$i]->hora;
            }

            if ($hora_dia != 8) {
                $hora_resto = 8 - $hora_dia;

                if ($params->hora <= $hora_resto) {
                    $this->registraActividad($params);
                    $mensaje = 'Actividad Registrada.';
                } else {
                    $status  = 'error';
                    $mensaje = 'El registro de actividades en un día no puede ser superior a 8 horas, para el día ' . $params->fecha . ' tiene registrado un total de ' . $hora_dia . ' horas y esta intentando registrar una actividad de ' . $params->hora . ' horas.';
                }
            } else {
                $status  = 'error';
                $mensaje = 'Día registrado';
            }

            $result = array(
                'status'  => $status,
                'message' => $mensaje,
            );
        }

        return response()->json($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function registraActividad($params)
    {
        $actividad                    = new Int_control_actividades();
        $actividad->fecha             = $params->fecha;
        $actividad->user_id           = $params->user;
        $actividad->tipo_actividad_id = $params->tipo_actividad;
        $actividad->hora              = $params->hora;
        $actividad->descripcion       = $params->descripcion;
        $actividad->save();
    }

}
