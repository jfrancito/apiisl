<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\FeFacturacionSap;
use PDO;



class ApiTelemetriaController extends Controller
{
    
     public function actionPruebaApi($dni) {

        // $json = array();    
        // $datos = json_encode($dni);

        // $url = "http://app17.susalud.gob.pe:8082/webservices/ws_procesos/obtenerDatosReniec?numero=".$dni;
        // header('Content-Type: text/html; charset =utf-8');
        // $json = file_get_contents($url, true);
        // $json = mb_convert_encoding($json, 'UTF-8',mb_detect_encoding($json, 'UTF-8, ISO-8859-1', true));
        // $persona = json_decode($json, true);
        return json_encode($dni);;
        
    }

}
