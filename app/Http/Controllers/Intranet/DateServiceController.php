<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DateServiceController extends Controller
{
    public function systemDateTime()
    {
    	$fecha   = date('d-m-Y');
    	$hora = date('h:i A');
    	
	    $result = array(
	    	'date' => $fecha,
            'time' => $hora,
        );

        return response()->json($result, 200);
    }
}
