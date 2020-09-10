<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditoriaAccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha   = date('Y-m-d');
        $activos = DB::table('int_control_asistencias')->where('int_control_asistencias.fecha', '=', $fecha)->join('users', 'int_control_asistencias.user_id', '=', 'users.id')->join('datos_personales', 'users.id', '=', 'datos_personales.id_user')->get();
        $count   = count($activos);

        $h       = date('H');
        $min     = date('i');
        $hr      = ($h - 8);
        $retardo = $hr . 'hr y ' . $min . 'min';

        if ($count > 0) {

            for ($i = 0; $i < $count; $i++) {
                $asistentes[$i] = $activos[$i]->id;
            }

            $inactivos = DB::table('users')->whereNotIN('users.id', $asistentes)->join('datos_personales', 'users.id', '=', 'datos_personales.id_user')->get();

            $result = array(
                'status'    => 'success',
                'activos'   => $activos,
                'inactivos' => $inactivos,
                'retardo'   => $retardo,
            );
        } else {
            $inactivos = DB::table('datos_personales')->get();
            $result    = array(
                'status'    => 'error',
                'data'      => 'no data',
                'inactivos' => $inactivos,
                'retardo'   => $retardo,
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
    public function show(Request $request)
    {
        $json   = $request->input('json', null);
        $params = json_decode($json);
        $year   = date('Y');
        $result = '';
        $query  = 'SELECT * FROM public.int_control_asistencias INNER JOIN users ON int_control_asistencias.user_id   =                    users.id INNER JOIN datos_personales ON users.id = datos_personales.id_user WHERE EXTRACT(MONTH FROM int_control_asistencias.fecha) =  ' . $params . ' AND EXTRACT(YEAR FROM int_control_asistencias.fecha) = ' . $year . ' ORDER BY datos_personales.nombres ASC, fecha ASC';

        $consulta = DB::SELECT($query);

        if (isset($consulta)) {
            $result = array(
                'status' => 'success',
                'data'   => $consulta,
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No existen registros',
            );
        }

        return response()->json($result, 200);

    }

    public function showusers()
    {
        $query    = 'SELECT * FROM public.datos_personales ORDER BY datos_personales.nombres ASC';
        $consulta = DB::SELECT($query);
        $result   = '';

        if (isset($consulta)) {
            $result = array(
                'status' => 'success',
                'data'   => $consulta,
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No existen registros',
            );
        }

        return response()->json($result, 200);
    }

    public function showpersonal($id_user)
    {

        $year     = date('Y');
        $moth     = date('m');
        $result   = '';
        $query    = 'SELECT * FROM public.int_control_asistencias INNER JOIN users ON int_control_asistencias.user_id   =                    users.id INNER JOIN datos_personales ON users.id = datos_personales.id_user WHERE int_control_asistencias.user_id =' . $id_user . ' AND EXTRACT(MONTH FROM int_control_asistencias.fecha) =  ' . $moth . ' AND EXTRACT(YEAR FROM int_control_asistencias.fecha) = ' . $year . '  ORDER BY int_control_asistencias.fecha ASC';
        $consulta = DB::SELECT($query);

        if (isset($consulta)) {
            $result = array(
                'status' => 'success',
                'data'   => $consulta,
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No existen registros',
            );
        }

        return response()->json($result, 200);

    }

    public function getuser($id_user)
    {
        $result   = '';
        $query    = 'SELECT * FROM datos_personales WHERE id_user =' . $id_user . '';
        $consulta = DB::SELECT($query);

        if (isset($consulta)) {
            $result = array(
                'status' => 'success',
                'data'   => $consulta,
            );

        } else {
            $result = array(
                'status' => 'error',
                'data'   => 'No existen registros',
            );
        }

        return response()->json($result, 200);
    }

}
