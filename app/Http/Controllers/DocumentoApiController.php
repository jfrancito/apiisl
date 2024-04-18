<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\FeFacturacionSap;
use PDO;

class DocumentoApiController extends Controller {


    public function actionListadoViaje01($dni,$fechainicio,$fechafin) {

        header('Content-Type: application/json; charset=utf-8');

        try{ 

            $stmt                   =           DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC TES.ListarViajeGRETA
                                                    @DniConductor = ?,
                                                    @FechaInicio = ?,
                                                    @FechaFin = ?
                                                ');
            $stmt->bindParam(1, $dni ,PDO::PARAM_STR);                   
            $stmt->bindParam(2, $fechainicio  ,PDO::PARAM_STR);
            $stmt->bindParam(3, $fechafin  ,PDO::PARAM_STR);
            $stmt->execute();

            $array_detalle_asiento      =   array();

            while($row = $stmt->fetch()){
                $IdViaje                     =   $row['IdViaje'];
                $Viaje                       =   $row['Viaje'];
                $Dni_Conductor               =   $row['Dni_Conductor'];
                $Fecha                       =   $row['Fecha'];
                $Tracto                      =   $row['Tracto'];
                $array_nuevo_asiento    =   array();
                $array_nuevo_asiento    =   array(
                    "IdViaje"               => $IdViaje,
                    "Viaje"                 => $Viaje,
                    "Dni_Conductor"         => $Dni_Conductor,
                    "Fecha"                 => $Fecha,
                    "Tracto"                => $Tracto
                );

                array_push($array_detalle_asiento,$array_nuevo_asiento);
            }
            

            $responsecode = 200;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );

            $arraydata    =     array(
                                    "codigo"                    => '0001',
                                    "mensaje"                   => 'Consulta Exitosa',
                                    "data"                      =>  $array_detalle_asiento
                                    );


            return response()->json($arraydata,
                    $responsecode, $header, JSON_UNESCAPED_UNICODE);

        }catch(\Exception $ex){


            $array_respuesta    =   array(
                "codigo"                    => '0000',
                "mensaje"                   => 'Ocurrio un error '.$ex->getMessage()
            );

            $responsecode = 401;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );
            return response()->json($array_respuesta, $responsecode, $header, JSON_UNESCAPED_UNICODE);

        }



    }


    public function actionListadoViaje02($fechainicio,$fechafin) {

        $dni = '';
        header('Content-Type: application/json; charset=utf-8');


        try{ 


            $stmt                   =           DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC TES.ListarViajeGRETA
                                                    @DniConductor = ?,
                                                    @FechaInicio = ?,
                                                    @FechaFin = ?
                                                ');
            $stmt->bindParam(1, $dni ,PDO::PARAM_STR);                   
            $stmt->bindParam(2, $fechainicio  ,PDO::PARAM_STR);
            $stmt->bindParam(3, $fechafin  ,PDO::PARAM_STR);
            $stmt->execute();

            $array_detalle_asiento      =   array();

            while($row = $stmt->fetch()){
                $IdViaje                     =   $row['IdViaje'];
                $Viaje                       =   $row['Viaje'];
                $Dni_Conductor               =   $row['Dni_Conductor'];
                $Fecha                       =   $row['Fecha'];
                $Tracto                      =   $row['Tracto'];
                $array_nuevo_asiento    =   array();
                $array_nuevo_asiento    =   array(
                    "IdViaje"               => $IdViaje,
                    "Viaje"                 => $Viaje,
                    "Dni_Conductor"         => $Dni_Conductor,
                    "Fecha"                 => $Fecha,
                    "Tracto"                => $Tracto
                );

                array_push($array_detalle_asiento,$array_nuevo_asiento);
            }
            

            $responsecode = 200;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );


            $arraydata    =     array(
                                    "codigo"                    => '0001',
                                    "mensaje"                   => 'Consulta Exitosa',
                                    "data"                      =>  $array_detalle_asiento
                                    );

            return response()->json($arraydata, 
                    $responsecode, $header, JSON_UNESCAPED_UNICODE);

        }catch(\Exception $ex){


            $array_respuesta    =   array(
                "codigo"                    => '0000',
                "mensaje"                   => 'Ocurrio un error '.$ex->getMessage()
            );

            $responsecode = 401;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );
            return response()->json($array_respuesta, $responsecode, $header, JSON_UNESCAPED_UNICODE);

        }


    }


}
