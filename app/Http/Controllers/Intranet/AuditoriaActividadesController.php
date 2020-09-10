<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditoriaActividadesController extends Controller
{
    public function reporteactividades($id_user)
    {
        $year          = date('Y');
        $moth          = date('m');
        $result        = '';
        $query         = 'SELECT * FROM public.int_control_actividades INNER JOIN users ON int_control_actividades.user_id   =                    users.id INNER JOIN datos_personales ON users.id = datos_personales.id_user INNER JOIN int_l_tipo_actividad ON int_control_actividades.tipo_actividad_id = int_l_tipo_actividad.id WHERE int_control_actividades.user_id =' . $id_user . ' AND EXTRACT(MONTH FROM int_control_actividades.fecha) =  ' . $moth . ' AND EXTRACT(YEAR FROM int_control_actividades.fecha) = ' . $year . '  ORDER BY fecha ASC';
        $consulta      = DB::SELECT($query);
        $cantidad      = count($consulta);
        $hora_curso    = 0;
        $hora_proyecto = 0;
        $hora_cliente  = 0;
        $hora_permiso  = 0;
        $hora_otros    = 0;
        $total_horas   = 0;

        for ($i = 0; $i < $cantidad; $i++) {
            if ($consulta[$i]->tipo_actividad_id == 1) {
                $hora_curso += $consulta[$i]->hora;
            }

            if ($consulta[$i]->tipo_actividad_id == 2) {
                $hora_proyecto += $consulta[$i]->hora;
            }

            if ($consulta[$i]->tipo_actividad_id == 3) {
                $hora_cliente += $consulta[$i]->hora;
            }

            if ($consulta[$i]->tipo_actividad_id == 4) {
                $hora_permiso += $consulta[$i]->hora;
            }

            if ($consulta[$i]->tipo_actividad_id == 5) {
                $hora_otros += $consulta[$i]->hora;
            }

        }

        $total_horas = $hora_curso + $hora_proyecto + $hora_cliente + $hora_permiso + $hora_otros;

        if ($cantidad > 0) {
            $result = array(
                'status'        => 'success',
                'data'          => $consulta,
                'cantidad'      => $cantidad,
                'hora_curso'    => $hora_curso,
                'hora_proyecto' => $hora_proyecto,
                'hora_cliente'  => $hora_cliente,
                'hora_permiso'  => $hora_permiso,
                'hora_otros'    => $hora_otros,
                'total_horas'   => $total_horas,
                'nombre'        => $consulta[0]->nombres . ' ' . $consulta[0]->apellidos,
                'cedula'        => $consulta[0]->dni,
            );

        } else {
            $query    = 'SELECT * FROM datos_personales  WHERE id_user =' . $id_user . '';
            $consulta = DB::SELECT($query);
            $result   = array(
                'status'        => 'error',
                'data'          => 'No existen registros',
                'cantidad'      => $cantidad,
                'hora_curso'    => $hora_curso,
                'hora_proyecto' => $hora_proyecto,
                'hora_cliente'  => $hora_cliente,
                'hora_permiso'  => $hora_permiso,
                'hora_otros'    => $hora_otros,
                'total_horas'   => $total_horas,
                'nombre'        => $consulta[0]->nombres . ' ' . $consulta[0]->apellidos,
                'cedula'        => $consulta[0]->dni,
            );
        }

        return response()->json($result, 200);
    }
}
