<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use App\Models\Intranet\Int_control_asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $json        = $request->input('json', null);
        $params      = json_decode($json);
        $id_usuario  = $params->sub;
        $fecha       = date('Y-m-d');
        $reloj       = reloj();
        $asistencias = Int_control_asistencia::where('user_id', '=', $id_usuario)->orderBy('created_at', 'desc')->get();

        $result = array(
            'status' => 'success',
            'data'   => $asistencias,
            'fecha'  => $fecha,
            'hora'   => $reloj['horaM'],
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
        $asistencia = Asistencia($params);
        $status     = 'success';
        $mensaje    = 'Entrada registrada de forma exitosa';
        $pausa      = 0;

        if ($asistencia == 1) {
            $mensaje = 'Ya registro entrada';
            $status  = 'error';
        }

        if ($asistencia == 2) {
            $mensaje = $mensaje . ', puede hacer uso de la pausa activa.';
            $pausa   = 1;
        }

        $result = array(
            'status'      => $status,
            'message'     => $mensaje,
            'pausaActiva' => $pausa,
        );

        return response()->json($result, 200);

    }

    public function update(Request $request, Int_control_asistencia $asistencia)
    {
        $status  = 'error';
        $mensaje = 'Operación registrada con Exito';
        $json    = $request->input('json', null);
        $params  = json_decode($json);
        if (is_string($params->evento)) {
            $reloj      = reloj();
            $fecha      = date('Y-m-d');
            $Asistencia = Int_control_asistencia::where('user_id', '=', $params->id)->where('fecha', '=', $fecha)
                ->orderBy('created_at', 'desc')->first();
            $Asistencia->hora_salida   = $reloj['thora'];
            $Asistencia->observaciones = $Asistencia->observaciones . ' / ' . $params->evento;
            $Asistencia->save();
            $result = array(
                'status'  => 'success',
                'message' => 'Operación registrada con exito',
            );

            return response()->json($result, 200);
        } else {
            $asistencia = Asistencia($params);
            switch ($asistencia) {
                case '2':
                    $mensaje = 'Ya registro Salida Almuerzo';
                    break;
                case '3':
                    $mensaje = 'Registre Salida almuerzo';
                    break;
                case '4':
                    $mensaje = 'Debe registar Entrada';
                    break;
                case '5':
                    $mensaje = 'Ya registro Entrada almuerzo';
                    break;
                case '6':
                    $mensaje = 'Debe registar Entrada Almuerzo';
                    break;
                case '7':
                    $mensaje = 'Ya registro Salida Laboral';
                    break;
                case '8':
                    $mensaje = 'Aun no finaliza la jornada laboral, solicite un  permiso de ser necesario';
                    break;
                case '9':
                    $mensaje = 'La hora de almuerzo es a partir de las 12:00 P.M';
                    break;
                case '10':
                    $mensaje = 'No se encuentra en pausa activa, debe registar su Salida a pausa activa.';
                    break;
                case '11':
                    $mensaje = 'No posee tiempo para disfrutar de la pausa activa.';
                    break;
                case '12':
                    $mensaje = 'Se encuentra en la pausa activa, no puede resgistrar estas operacion.';
                    break;
                case '13':
                    $mensaje = 'Operacion invalida.';
                    break;
                default:
                    $status = 'success';

                    if (is_array($asistencia)) {
                        if ($asistencia['caso'] == 1) {
                            $status  = 'error';
                            $mensaje = $asistencia['message'];
                        }

                        if ($asistencia['caso'] == 2) {
                            $status  = 'error';
                            $mensaje = $asistencia['message'];
                        }

                        if ($asistencia['caso'] == 3) {
                            $mensaje = $asistencia['message'];
                        }
                    }

                    break;
            }

            $result = array(
                'status'  => $status,
                'message' => $mensaje,
            );

            return response()->json($result, 200);
        }

    }

    public function permisoSalida(Request $request)
    {
        $json       = $request->input('json', null);
        $params     = json_decode($json);
        $fecha      = date('Y-m-d');
        $estado     = $params->status;
        $message    = '';
        $Asistencia = Int_control_asistencia::where('user_id', '=', $params->id)->where('fecha', '=', $fecha)
            ->orderBy('created_at', 'desc')->first();
        $Asistencia->evento            = $Asistencia->evento . 'Permiso/';
        $Asistencia->observaciones     = $Asistencia->observaciones . '/ MP-(' . $params->evento . ')';
        $Asistencia->hora_salida_otros = date('H:i');
        $Asistencia->status_otros      = 1;

        if ($estado == 2) {
            $reloj                    = reloj();
            $Asistencia->hora_salida  = $reloj['thora'];
            $Asistencia->status_otros = 2;
        }

        $Asistencia->save();

        $result = array(
            'message' => $message,
        );

        return response()->json($result, 200);
    }

    public function permisoEntrada(Request $request)
    {
        $json       = $request->input('json', null);
        $params     = json_decode($json);
        $fecha      = date('Y-m-d');
        $Asistencia = Int_control_asistencia::where('user_id', '=', $params->id)->where('fecha', '=', $fecha)
            ->orderBy('created_at', 'desc')->first();

        $Asistencia->status_otros       = $params->status;
        $Asistencia->hora_entrada_otros = date('H:i');
        $Asistencia->observaciones .= $params->evento;
        $Asistencia->save();

        $result = array(
            'message' => $params->evento,
            'status'  => $params->status,
            'id'      => $params->id,
        );

        return response()->json($result, 200);
    }

}

/*FUNCION ASISTENCIA: SELECCIONA EL TIPO DE VALIDACION SEGUN EL REQUEST*/

function Asistencia($params)
{
    $valor      = $params->evento;
    $Actualizar = Int_control_asistencia::all()->sortByDesc('created_at')->first();

    switch ($valor) {
        case '1':
            $pregunta = ValidarEntrada($params);
            break;
        case '2':
            $pregunta = ValidarEntradaAlmuerzo($params->id);
            break;
        case '3':
            $pregunta = ValidarSalidaLaboral($params->id);
            break;
        case '4':
            $pregunta = ValidarSalidaAlmuerzo($params->id);
            break;
        case '5':
            $pregunta = ValidarEntradaPausaActiva($params->id);
            break;
        case '6':
            $pregunta = ValidarSalidaPausaActiva($params->id);
            break;
        default:
            echo 'ninguna';die();
            break;
    }
    return $pregunta;
}

/*FUNCION VALIDAR ENTRADA: VALIDA LA HORA DE ENTRADA Y LA SALIDA DEL DIA ANTERIOR*/

function ValidarEntrada($params)
{
    $fecha      = Date('Y-m-d');
    $id_usuario = $params->id;

    $diaAnterior = Int_control_asistencia::where('user_id', '=', $id_usuario)->orderBy('created_at', 'desc')
        ->first();

    if ($diaAnterior != null) {
        if (($diaAnterior->hora_salida == '') && ($diaAnterior->fecha != $fecha)) {
            $diaAnterior->evento        = $diaAnterior->evento . '/ Salida sin resgistrar(ATENCION)';
            $diaAnterior->hora_salida   = '-';
            $diaAnterior->observaciones = $diaAnterior->observaciones . '/ No registro salida';
            $diaAnterior->save();
        }
    }

    $Asistencia = Int_control_asistencia::where('user_id', '=', $id_usuario)->where('fecha', '=', $fecha)
        ->orderBy('created_at', 'desc')->first();

    if ($Asistencia != null) {
        return 1;
    } else {
        $reloj       = reloj();
        $hora        = $reloj['hora'];
        $minutos     = $reloj['minutos'];
        $ampm        = $reloj['ampm'];
        $observacion = '/ Llegada a destiempo';
        $pausaActiva = 10;
        if (($hora == 8) && ($ampm == 'A.M') && ($minutos > 30)) {
            NuevaAsistencia($id_usuario, $fecha, $observacion, $pausaActiva);
        }

        if (($hora > 8) && ($ampm == 'A.M')) {
            NuevaAsistencia($id_usuario, $fecha, $observacion, $pausaActiva);
        }

        if (($hora >= 1) && ($ampm == 'P.M')) {
            NuevaAsistencia($id_usuario, $fecha, $observacion, $pausaActiva);
        }
        if (($hora < 8) && ($ampm == 'A.M')) {
            $observacion = '';
            $pausaActiva = 20;
            NuevaAsistencia($id_usuario, $fecha, $observacion, $pausaActiva);
            return 2;
        }

        if (($hora == 8) && ($ampm == 'A.M') && ($minutos <= 30)) {
            $observacion = '';
            NuevaAsistencia($id_usuario, $fecha, $observacion, $pausaActiva);
        }
    }
}

/*FUNCION NUEVA ASISTENCIA: REGISTRA UNA NUEVA ASISTENCIA*/

function NuevaAsistencia($id_usuario, $fecha, $observacion, $pausaActiva)
{
    $reloj                             = reloj();
    $Asistencia                        = new Int_control_asistencia;
    $Asistencia->user_id               = $id_usuario;
    $Asistencia->fecha                 = $fecha;
    $Asistencia->hora_entrada          = $reloj['thora'];
    $Asistencia->hora_salida_almuerzo  = '';
    $Asistencia->hora_entrada_almuerzo = '';
    $Asistencia->hora_salida           = '';
    $Asistencia->evento                = 'Entrada/';
    $Asistencia->observaciones         = $observacion;
    $Asistencia->hora_diaria           = '';
    $Asistencia->pausa_activa          = $pausaActiva;
    $Asistencia->save();
}

/*FUNCION VALIDARSALIDAALMUERZO: VALIDA LA HORA PARA SALIR AL ALMUERZO*/

function ValidarSalidaAlmuerzo($id)
{
    $reloj      = reloj();
    $hora       = $reloj['hora'];
    $minutos    = $reloj['minutos'];
    $id_usuario = $id;
    $fecha      = Date('Y-m-d');
    $result     = '';
    $Asistencia = Int_control_asistencia::where('user_id', '=', $id_usuario)->where('fecha', '=', $fecha)
        ->orderBy('created_at', 'desc')->first();

    if ($Asistencia != null) {

        if ($Asistencia->hora_salida_almuerzo != '') {
            $result = 2;
        }

        if ($Asistencia->hora_salida_almuerzo == '') {
            if (($hora == 12) || (($hora < 12) && ($reloj['ampm'] == 'P.M'))) {
                $Asistencia->hora_salida_almuerzo = $reloj['thora'];
                $Asistencia->evento               = $Asistencia->evento . ' Salida Almuerzo/ ';
                $Asistencia->save();
            }

            if (($hora < 12) && ($reloj['ampm'] == 'A.M')) {
                $result = 9;
            }
        }

    } else {
        $result = 4;
    }
    return $result;
}

/*FUNCION VALIDARENTRADAALMUERZO: VALIDA LA HORA DE ENTRA DEL ALMUERZO Y EL PERIODO ESTABLECIDO*/

function ValidarEntradaAlmuerzo($id)
{
    $reloj      = reloj();
    $hora       = $reloj['hora'];
    $id_usuario = $id;
    $fecha      = Date('Y-m-d');
    $Asistencia = Int_control_asistencia::where('user_id', '=', $id_usuario)->where('fecha', '=', $fecha)
        ->orderBy('created_at', 'desc')->first();

    if ($Asistencia != null) {

        if ($Asistencia->hora_salida_almuerzo != '') {

            $horaSalidaAlmuerzo    = $Asistencia->hora_salida_almuerzo;
            $horaSalidaAlmuerzo    = explode(':', $horaSalidaAlmuerzo);
            $minutosSalidaAlmuerzo = explode(' ', $horaSalidaAlmuerzo[1]);
            settype($horaSalidaAlmuerzo[0], "integer");
            settype($minutosSalidaAlmuerzo[0], "integer");
            $horaEntradaAlmuerzo = $horaSalidaAlmuerzo[0] + 1;
            $observacion         = '';
            $result              = '';

            if ($Asistencia->hora_entrada_almuerzo == '') {

                if ($horaSalidaAlmuerzo[0] == 12) {
                    $horaEntradaAlmuerzo = 1;
                }

                if (($hora != 12) && ($horaEntradaAlmuerzo < $hora)) {
                    $observacion       = 'Llegada a destiempo(ALMUERZO)/';
                    $registrarAlmuerzo = registrarAlmuerzo($Asistencia, $reloj['thora'], $observacion);
                }

                if (($horaEntradaAlmuerzo == $hora) && ($reloj['minutos'] > $minutosSalidaAlmuerzo[0])) {
                    $observacion       = 'Llegada a destiempo(ALMUERZO)/';
                    $registrarAlmuerzo = registrarAlmuerzo($Asistencia, $reloj['thora'], $observacion);
                }

                if (($hora == $horaSalidaAlmuerzo[0]) || (($hora == $horaEntradaAlmuerzo) && ($reloj['minutos'] <= $minutosSalidaAlmuerzo[0]))) {
                    $registrarAlmuerzo = registrarAlmuerzo($Asistencia, $reloj['thora'], $observacion);
                }

            } else {
                $result = 5;
            }

        } else {
            $result = 3;
        }

    } else {
        $result = 4;
    }
    return $result;

}

/*FUNCION VALIDARSALIDALABORAL: VALIDA LA HORA DE SALIDA Y LOS EVENTOS ANTERIORES*/

function ValidarSalidaLaboral($id)
{
    $reloj      = reloj();
    $hora       = $reloj['hora'];
    $id_usuario = $id;
    $fecha      = Date('Y-m-d');
    $result     = '';
    $Asistencia = Int_control_asistencia::where('user_id', '=', $id_usuario)->where('fecha', '=', $fecha)
        ->orderBy('created_at', 'desc')->first();
    if ($Asistencia != null) {

        if ($Asistencia->hora_entrada_almuerzo != '') {

            if ($Asistencia->hora_salida == '') {
                if (($Asistencia->hora_entrada_pausa_activa != '') && ($Asistencia->hora_salida_pausa_activa != '')) {
                    $horasD = diferenciaHoraSalidaHoraEntrada($Asistencia);
                    if ($horasD == 1) {
                        if ($hora >= 5) {
                            $Asistencia->hora_salida = $reloj['thora'];
                            $Asistencia->evento      = $Asistencia->evento . ' Salida/';
                            $Asistencia->save();
                        } else {
                            $result = 8;
                        }
                    }
                    if ($horasD == 2) {
                        $result = 12;
                    }

                }

                if (($Asistencia->hora_entrada_pausa_activa == '') && ($Asistencia->hora_salida_pausa_activa == '')) {
                    if ($hora >= 5) {
                        $Asistencia->hora_salida = $reloj['thora'];
                        $Asistencia->evento      = $Asistencia->evento . 'Salida/';
                        $Asistencia->save();
                    } else {
                        $result = 8;
                    }
                }

            } else {
                $result = 7;
            }
        } else {
            $result = 6;
        }
    } else {
        $result = 4;
    }
    return $result;
}

//FUNCION ValidarEntradaPausaActiva: SE ASEGURA QUE EL USUARIO REUNA LOS REQUISITOS

function ValidarSalidaPausaActiva($id)
{
    $reloj  = reloj();
    $fecha  = Date('Y-m-d');
    $result = 0;

    $Asistencia = Int_control_asistencia::where('user_id', '=', $id)->where('fecha', '=', $fecha)
        ->orderBy('created_at', 'desc')->first();

    $mensaje = 'Usted posee ' . $Asistencia->pausa_activa . ' min de pausa activa';

    if ($Asistencia->pausa_activa > 0) {

        if (($Asistencia->hora_entrada_pausa_activa == '') && ($Asistencia->hora_salida_pausa_activa != '')) {

            $resto = calcularRestoPausaActiva($Asistencia);

            if ($resto > $Asistencia->pausa_activa) {
                $sobreTiempo = $resto - $Asistencia->pausa_activa;

                $mensaje = 'Tiene ' . $sobreTiempo . ' min. excedidos de su pausa activa, registre la entrada de su pausa activa y justifique.';
                $caso    = 1;
            }

            if ($resto <= $Asistencia->pausa_activa) {
                $trestante = $Asistencia->pausa_activa - $resto;
                $mensaje   = 'Usted se encuentra en pausa activa y le quedan ' . $trestante . ' min.';
                $caso      = 2;

            }

            $result = array(
                'caso'    => $caso,
                'message' => $mensaje,
            );
            return $result;
        }

        if ($Asistencia->hora_salida_pausa_activa == '') {
            $Asistencia->hora_salida_pausa_activa = $reloj['thora'];
            $Asistencia->save();
        }

        if (($Asistencia->hora_salida_pausa_activa != '') && ($Asistencia->hora_entrada_pausa_activa != '')) {
            $horasD = diferenciaHoraSalidaHoraEntrada($Asistencia);
            if ($horasD == 1) {
                $Asistencia->hora_salida_pausa_activa = $reloj['thora'];
                $Asistencia->save();
            }

            if ($horasD == 2) {
                $result = 12;
                return $result;
            }

        }

    } else {
        $result = 11;
        return $result;

    }

}

function ValidarEntradaPausaActiva($id)
{
    $result     = 13;
    $reloj      = reloj();
    $fecha      = Date('Y-m-d');
    $Asistencia = Int_control_asistencia::where('user_id', '=', $id)->where('fecha', '=', $fecha)
        ->orderBy('created_at', 'desc')->first();
    $horasD = diferenciaHoraSalidaHoraEntrada($Asistencia);

    if ($Asistencia->hora_salida_pausa_activa == '') {
        $result = 10;
    }

    // if ($horasD == 1) {
    //     $result = 10;
    // }

    if (($Asistencia->hora_salida_pausa_activa != '') && ($Asistencia->hora_entrada_pausa_activa == '')) {
        $result = regitroEntrada($Asistencia);
    }

    if (($Asistencia->hora_salida_pausa_activa != '') && ($Asistencia->hora_entrada_pausa_activa != '')) {

        if ($horasD == 2) {
            $result = regitroEntrada($Asistencia);
        }
    }

    return $result;

}

/*FUNCION REGISTARALMUERZO: GUARDA LAS HORAS Y DESTIEMPO EN EL REGISTRO*/

function registrarAlmuerzo($Asistencia, $reloj, $observaciones)
{
    $Asistencia->hora_entrada_almuerzo = $reloj;
    $Asistencia->evento                = $Asistencia->evento . ' Entrada Almuerzo/ ';
    $Asistencia->observaciones         = $Asistencia->observaciones . $observaciones;
    $Asistencia->save();
}

/*FUNCIO RELOJ: RETORNA UN ARREGLO CON HORAS TOTALES,HRS,MIN,AMPM*/

function reloj()
{
    $hora = getdate();

    if ($hora['hours'] > 12) {
        $bdhora = $hora['hours'] - 12;
        $ampm   = 'P.M';
        $bdhora = $bdhora;
    } else {
        $ampm   = 'A.M';
        $bdhora = $hora['hours'];
    }

    if ($hora['hours'] == 12) {
        $bdhora = 12;
    }

    if ($bdhora < 10) {
        $bdhora = '0' . $bdhora;
    }

    if ($hora['minutes'] < 10) {
        $bdminutos = "0" . $hora['minutes'];
    } else {
        $bdminutos = $hora['minutes'];
    }

    $thora = $bdhora . ':' . $bdminutos . ' ' . $ampm;
    settype($bdhora, "integer");
    settype($bdminutos, "integer");

    $reloj = array(
        'thora'   => $thora,
        'hora'    => $bdhora,
        'minutos' => $bdminutos,
        'ampm'    => $ampm,
        'horaM'   => $hora['hours']);

    return $reloj;
}

function diferenciaHoraSalidaHoraEntrada($Asistencia)
{
    $horasD      = 0;
    $pausaSalida = $Asistencia->hora_salida_pausa_activa;
    if ($pausaSalida != '') {
        $horaSalidaPausa    = explode(':', $pausaSalida);
        $minutosSalidaPausa = explode(' ', $horaSalidaPausa[1]);
        settype($horaSalidaPausa[0], "integer");
        settype($minutosSalidaPausa[0], "integer");
        $hrSalidaPausa  = $horaSalidaPausa[0];
        $minSalidaPausa = $minutosSalidaPausa[0];
    } else {
        $hrSalidaPausa         = 0;
        $minSalidaPausa        = 0;
        $minutosSalidaPausa[1] = 'A.M';
    }

    $pausaEntrada = $Asistencia->hora_entrada_pausa_activa;

    if ($pausaEntrada != '') {
        $horaEntradaPausa    = explode(':', $pausaEntrada);
        $minutosEntradaPausa = explode(' ', $horaEntradaPausa[1]);
        settype($horaEntradaPausa[0], "integer");
        settype($minutosEntradaPausa[0], "integer");
        $hrEntradaPausa  = $horaEntradaPausa[0];
        $minEntradaPausa = $minutosEntradaPausa[0];
    } else {
        $hrEntradaPausa         = 0;
        $minEntradaPausa        = 0;
        $minutosEntradaPausa[1] = 'A.M';
    }

    if ($minutosSalidaPausa[1] == 'P.M') {
        $hrSalidaPausa += 12;
    }

    if ($minutosEntradaPausa[1] == 'P.M') {
        $hrEntradaPausa += 12;
    }

    $minTotalesEntrada = ($hrEntradaPausa * 60) + $minEntradaPausa;
    $minTotalesSalida  = ($hrSalidaPausa * 60) + $minSalidaPausa;

    if ($minTotalesEntrada >= $minTotalesSalida) {
        $horasD = 1;
    } elseif ($minTotalesEntrada < $minTotalesSalida) {
        $horasD = 2;
    }

    return $horasD;
}

function regitroEntrada($Asistencia)
{
    $reloj = reloj();
    $resto = calcularRestoPausaActiva($Asistencia);
    if ($resto > $Asistencia->pausa_activa) {
        $sobreTiempo = $resto - $Asistencia->pausa_activa;

        $mensaje                               = 'Tiene ' . $sobreTiempo . ' min. excedidos de su pausa activa justifique.';
        $Asistencia->hora_entrada_pausa_activa = $reloj['thora'];
        $Asistencia->pausa_activa              = 0;
        $Asistencia->observaciones .= ' se sobre paso ' . $sobreTiempo . ' min de pausa activa /';
        $Asistencia->save();
        $caso = 1;
    }

    if ($resto <= $Asistencia->pausa_activa) {
        $trestante                             = $Asistencia->pausa_activa - $resto;
        $mensaje                               = 'Usted finalizo su pausa activa, aun cuenta con ' . $trestante . ' min.';
        $Asistencia->hora_entrada_pausa_activa = $reloj['thora'];
        $Asistencia->pausa_activa              = $trestante;
        $Asistencia->save();
        $caso = 3;

    }

    $result = array(
        'caso'    => $caso,
        'message' => $mensaje,
    );

    return $result;
}

function calcularRestoPausaActiva($Asistencia)
{
    $reloj        = reloj();
    $pausa        = $Asistencia->hora_salida_pausa_activa;
    $horaPausa    = explode(':', $pausa);
    $minutosPausa = explode(' ', $horaPausa[1]);
    settype($horaPausa[0], "integer");
    settype($minutosPausa[0], "integer");
    $hrRegistrada  = $horaPausa[0];
    $minRegistrado = $minutosPausa[0];
    $horafin       = $reloj['horaM'];
    if ($minutosPausa[1] == 'P.M') {
        $hrRegistrada += 12;
    }
    $resto = 0;
    $caso  = 0;

    if ($horafin == $hrRegistrada) {
        $resto = $reloj['minutos'] - $minRegistrado;
    } else {
        $const  = $horafin - $hrRegistrada;
        $minfin = $reloj['minutos'] + (60 * $const);
        $resto  = $minfin - $minRegistrado;
    }

    return $resto;
}
