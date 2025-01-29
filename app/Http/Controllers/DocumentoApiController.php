<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\FeFacturacionSap;
use PDO;

class DocumentoApiController extends Controller {

    public function actionBuscarDni($dni) {

        $json = array();    
        $url = "http://app17.susalud.gob.pe:8082/webservices/ws_procesos/obtenerDatosReniec?numero=".$dni;
        header('Content-Type: text/html; charset =utf-8');
        $json = file_get_contents($url, true);
        $json = mb_convert_encoding($json, 'UTF-8',mb_detect_encoding($json, 'UTF-8, ISO-8859-1', true));
        $persona = json_decode($json, true);
        return $persona;
        
    }





    public function actionRegistroGuiaGreta(Request $request) {

        $dni = '';
        header('Content-Type: application/json; charset=utf-8');

        try{ 

            $ID                                 =   $request['ID'];
            $VIAJE                              =   $request['VIAJE'];
            $SERIE                              =   $request['SERIE'];
            $NUMERO                             =   $request['NUMERO'];
            $FECHA_EMISION                      =   $request['FECHA_EMISION'];
            $HORA_EMISION                       =   $request['HORA_EMISION'];
            $FECHA_TRASLADO                     =   $request['FECHA_TRASLADO'];
            $RUC_REMITENTE                      =   $request['RUC_REMITENTE'];
            $NOMBRE_REMITENTE                   =   $request['NOMBRE_REMITENTE'];
            $RUC_DESTINATARIO                   =   $request['RUC_DESTINATARIO'];

            $NOMBRE_DESTINATARIO                =   $request['NOMBRE_DESTINATARIO'];
            $RUC_TRANSPORTISTA                  =   $request['RUC_TRANSPORTISTA'];
            $NOMBRE_TRANSPORTISTA               =   $request['NOMBRE_TRANSPORTISTA'];
            $DIRECCION_PARTIDA                  =   $request['DIRECCION_PARTIDA'];
            $UBIGEO_PARTIDA                     =   $request['UBIGEO_PARTIDA'];
            $DIRECCION_LLEGADA                  =   $request['DIRECCION_LLEGADA'];
            $UBIGEO_LLEGADA                     =   $request['UBIGEO_LLEGADA'];
            $UNIDAD_MEDIDA                      =   $request['UNIDAD_MEDIDA'];
            $PESO                               =   $request['PESO'];
            $RUC_SUBCONTRATA                    =   $request['RUC_SUBCONTRATA'];

            $NOMBRE_SUBCONTRATA                 =   $request['NOMBRE_SUBCONTRATA'];
            $DNI_CONDUCTOR_PRINCIPAL            =   $request['DNI_CONDUCTOR_PRINCIPAL'];
            $NOMBRE_CONDUCTOR_PRINCIPAL         =   $request['NOMBRE_CONDUCTOR_PRINCIPAL'];
            $LICENCIA_CONDUCTOR_PRINCIPAL       =   $request['LICENCIA_CONDUCTOR_PRINCIPAL'];
            $DNI_CONDUCTOR_SECUNDARIO_1         =   $request['DNI_CONDUCTOR_SECUNDARIO_1'];
            $NOMBRE_CONDUCTOR_SECUNDARIO_1      =   $request['NOMBRE_CONDUCTOR_SECUNDARIO_1'];
            $LICENCIA_CONDUCTOR_SECUNDARIO_1    =   $request['LICENCIA_CONDUCTOR_SECUNDARIO_1'];
            $DNI_CONDUCTOR_SECUNDARIO_2         =   $request['DNI_CONDUCTOR_SECUNDARIO_2'];
            $NOMBRE_CONDUCTOR_SECUNDARIO_2      =   $request['NOMBRE_CONDUCTOR_SECUNDARIO_2'];
            $LICENCIA_CONDUCTOR_SECUNDARIO_2    =   $request['LICENCIA_CONDUCTOR_SECUNDARIO_2'];

            $INDRETORNOVEHICULOVACIO            =   $request['INDRETORNOVEHICULOVACIO'];
            $INDRETORNOVEHICULOENVASEVACIO      =   $request['INDRETORNOVEHICULOENVASEVACIO'];
            $INDTRANSPORTE_SUB_CONTRATADO       =   $request['INDTRANSPORTE_SUB_CONTRATADO'];
            $INDTRASNBORDOPROGRAMADO            =   $request['INDTRASNBORDOPROGRAMADO'];
            $INDICADORTRASLADOTOTAL             =   $request['INDICADORTRASLADOTOTAL'];
            $IND_PAGADOR_FLETE                  =   $request['IND_PAGADOR_FLETE'];
            $PLACA_PRINCIPAL                    =   $request['PLACA_PRINCIPAL'];
            $TUCE_PRINCIPAL                     =   $request['TUCE_PRINCIPAL'];
            $PLACA_SECUNDARIA                   =   $request['PLACA_SECUNDARIA'];
            $TUCE_SECUNDARIA                    =   $request['TUCE_SECUNDARIA'];

            $NRO_AUTORIZACION_MTC               =   $request['NRO_AUTORIZACION_MTC'];
            $RUC_TERCERO                        =   $request['RUC_TERCERO'];
            $NOMBRE_TERCERO                     =   $request['NOMBRE_TERCERO'];
            $OBSERVACIONES                      =   $request['OBSERVACIONES'];
            $DOC_RELACIONADOS                   =   $request['DOC_RELACIONADOS'];
            $FECHA_HORA_ENVIO                   =   $request['FECHA_HORA_ENVIO'];
            $ESTADO_SUNAT                       =   $request['ESTADO_SUNAT'];
            $TICKET_ENVIO                       =   $request['TICKET_ENVIO'];
            $COD_QR                             =   $request['COD_QR'];
            $RPTA_SUNAT                         =   $request['RPTA_SUNAT'];

            $PDF                                =   $request['PDF'];
            $XML                                =   $request['XML'];
            $CDR                                =   $request['CDR'];

            $ID_DIRECCION_PARTIDA               =   $request['ID_DIRECCION_PARTIDA'];
            $ID_DIRECCION_LLEGADA               =   $request['ID_DIRECCION_LLEGADA'];
            $CODIGO_DE_CARGA                    =   $request['CODIGO_DE_CARGA'];




            $stmt                               =   DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC OPE.INSERTAR_GUIAS_GRETA 

                                                    @ID = ?,
                                                    @VIAJE = ?,
                                                    @SERIE = ?,
                                                    @NUMERO = ?,
                                                    @FECHA_EMISION = ?,
                                                    @HORA_EMISION = ?,
                                                    @FECHA_TRASLADO = ?,
                                                    @RUC_REMITENTE = ?,
                                                    @NOMBRE_REMITENTE = ?,
                                                    @RUC_DESTINATARIO = ?,

                                                    @NOMBRE_DESTINATARIO = ?,
                                                    @RUC_TRANSPORTISTA = ?,
                                                    @NOMBRE_TRANSPORTISTA = ?,
                                                    @DIRECCION_PARTIDA = ?,
                                                    @UBIGEO_PARTIDA = ?,
                                                    @DIRECCION_LLEGADA = ?,
                                                    @UBIGEO_LLEGADA = ?,
                                                    @UNIDAD_MEDIDA = ?,
                                                    @PESO = ?,
                                                    @RUC_SUBCONTRATA = ?,

                                                    @NOMBRE_SUBCONTRATA = ?,
                                                    @DNI_CONDUCTOR_PRINCIPAL = ?,
                                                    @NOMBRE_CONDUCTOR_PRINCIPAL = ?,
                                                    @LICENCIA_CONDUCTOR_PRINCIPAL = ?,
                                                    @DNI_CONDUCTOR_SECUNDARIO_1 = ?,
                                                    @NOMBRE_CONDUCTOR_SECUNDARIO_1 = ?,
                                                    @LICENCIA_CONDUCTOR_SECUNDARIO_1 = ?,
                                                    @DNI_CONDUCTOR_SECUNDARIO_2 = ?,
                                                    @NOMBRE_CONDUCTOR_SECUNDARIO_2 = ?,
                                                    @LICENCIA_CONDUCTOR_SECUNDARIO_2 = ?,


                                                    @INDRETORNOVEHICULOVACIO = ?,
                                                    @INDRETORNOVEHICULOENVASEVACIO = ?,
                                                    @INDTRANSPORTE_SUB_CONTRATADO = ?,
                                                    @INDTRASNBORDOPROGRAMADO = ?,
                                                    @INDICADORTRASLADOTOTAL = ?,
                                                    @IND_PAGADOR_FLETE = ?,
                                                    @PLACA_PRINCIPAL = ?,
                                                    @TUCE_PRINCIPAL = ?,
                                                    @PLACA_SECUNDARIA = ?,
                                                    @TUCE_SECUNDARIA = ?,

                                                    @NRO_AUTORIZACION_MTC = ?,
                                                    @RUC_TERCERO = ?,
                                                    @NOMBRE_TERCERO = ?,
                                                    @OBSERVACIONES = ?,
                                                    @DOC_RELACIONADOS = ?,
                                                    @FECHA_HORA_ENVIO = ?,
                                                    @ESTADO_SUNAT = ?,
                                                    @TICKET_ENVIO = ?,
                                                    @COD_QR = ?,
                                                    @RPTA_SUNAT = ?,


                                                    @PDF = ?,
                                                    @XML = ?,
                                                    @CDR = ?,

                                                    @ID_DIRECCION_PARTIDA = ?,
                                                    @ID_DIRECCION_LLEGADA = ?,
                                                    @CODIGO_DE_CARGA = ?


                                                    ');

            $stmt->bindParam(1, $ID ,PDO::PARAM_STR);                   
            $stmt->bindParam(2, $VIAJE  ,PDO::PARAM_STR);
            $stmt->bindParam(3, $SERIE  ,PDO::PARAM_STR);
            $stmt->bindParam(4, $NUMERO  ,PDO::PARAM_STR);
            $stmt->bindParam(5, $FECHA_EMISION  ,PDO::PARAM_STR);
            $stmt->bindParam(6, $HORA_EMISION ,PDO::PARAM_STR);
            $stmt->bindParam(7, $FECHA_TRASLADO  ,PDO::PARAM_STR);
            $stmt->bindParam(8, $RUC_REMITENTE  ,PDO::PARAM_STR);
            $stmt->bindParam(9, $NOMBRE_REMITENTE  ,PDO::PARAM_STR);
            $stmt->bindParam(10,$RUC_DESTINATARIO  ,PDO::PARAM_STR);

            $stmt->bindParam(11, $NOMBRE_DESTINATARIO ,PDO::PARAM_STR);                   
            $stmt->bindParam(12, $RUC_TRANSPORTISTA  ,PDO::PARAM_STR);
            $stmt->bindParam(13, $NOMBRE_TRANSPORTISTA  ,PDO::PARAM_STR);
            $stmt->bindParam(14, $DIRECCION_PARTIDA  ,PDO::PARAM_STR);
            $stmt->bindParam(15, $UBIGEO_PARTIDA  ,PDO::PARAM_STR);
            $stmt->bindParam(16, $DIRECCION_LLEGADA ,PDO::PARAM_STR);
            $stmt->bindParam(17, $UBIGEO_LLEGADA  ,PDO::PARAM_STR);
            $stmt->bindParam(18, $UNIDAD_MEDIDA  ,PDO::PARAM_STR);
            $stmt->bindParam(19, $PESO  ,PDO::PARAM_STR);
            $stmt->bindParam(20,$RUC_SUBCONTRATA  ,PDO::PARAM_STR);

            $stmt->bindParam(21, $NOMBRE_SUBCONTRATA ,PDO::PARAM_STR);                   
            $stmt->bindParam(22, $DNI_CONDUCTOR_PRINCIPAL  ,PDO::PARAM_STR);
            $stmt->bindParam(23, $NOMBRE_CONDUCTOR_PRINCIPAL  ,PDO::PARAM_STR);
            $stmt->bindParam(24, $LICENCIA_CONDUCTOR_PRINCIPAL  ,PDO::PARAM_STR);
            $stmt->bindParam(25, $DNI_CONDUCTOR_SECUNDARIO_1  ,PDO::PARAM_STR);
            $stmt->bindParam(26, $NOMBRE_CONDUCTOR_SECUNDARIO_1 ,PDO::PARAM_STR);
            $stmt->bindParam(27, $LICENCIA_CONDUCTOR_SECUNDARIO_1  ,PDO::PARAM_STR);
            $stmt->bindParam(28, $DNI_CONDUCTOR_SECUNDARIO_2  ,PDO::PARAM_STR);
            $stmt->bindParam(29, $NOMBRE_CONDUCTOR_SECUNDARIO_2  ,PDO::PARAM_STR);
            $stmt->bindParam(30,$LICENCIA_CONDUCTOR_SECUNDARIO_2  ,PDO::PARAM_STR);

            $stmt->bindParam(31, $INDRETORNOVEHICULOVACIO ,PDO::PARAM_STR);                   
            $stmt->bindParam(32, $INDRETORNOVEHICULOENVASEVACIO  ,PDO::PARAM_STR);
            $stmt->bindParam(33, $INDTRANSPORTE_SUB_CONTRATADO  ,PDO::PARAM_STR);
            $stmt->bindParam(34, $INDTRASNBORDOPROGRAMADO  ,PDO::PARAM_STR);
            $stmt->bindParam(35, $INDICADORTRASLADOTOTAL  ,PDO::PARAM_STR);
            $stmt->bindParam(36, $IND_PAGADOR_FLETE ,PDO::PARAM_STR);
            $stmt->bindParam(37, $PLACA_PRINCIPAL  ,PDO::PARAM_STR);
            $stmt->bindParam(38, $TUCE_PRINCIPAL  ,PDO::PARAM_STR);
            $stmt->bindParam(39, $PLACA_SECUNDARIA  ,PDO::PARAM_STR);
            $stmt->bindParam(40,$TUCE_SECUNDARIA  ,PDO::PARAM_STR);

            $stmt->bindParam(41, $NRO_AUTORIZACION_MTC ,PDO::PARAM_STR);                   
            $stmt->bindParam(42, $RUC_TERCERO  ,PDO::PARAM_STR);
            $stmt->bindParam(43, $NOMBRE_TERCERO  ,PDO::PARAM_STR);
            $stmt->bindParam(44, $OBSERVACIONES  ,PDO::PARAM_STR);
            $stmt->bindParam(45, $DOC_RELACIONADOS  ,PDO::PARAM_STR);
            $stmt->bindParam(46, $FECHA_HORA_ENVIO ,PDO::PARAM_STR);
            $stmt->bindParam(47, $ESTADO_SUNAT  ,PDO::PARAM_STR);
            $stmt->bindParam(48, $TICKET_ENVIO  ,PDO::PARAM_STR);
            $stmt->bindParam(49, $COD_QR  ,PDO::PARAM_STR);
            $stmt->bindParam(50,$RPTA_SUNAT  ,PDO::PARAM_STR);

                 
            $stmt->bindParam(51, $PDF  ,PDO::PARAM_STR);
            $stmt->bindParam(52, $XML  ,PDO::PARAM_STR);
            $stmt->bindParam(53, $CDR  ,PDO::PARAM_STR);


            $stmt->bindParam(54, $ID_DIRECCION_PARTIDA  ,PDO::PARAM_STR);
            $stmt->bindParam(55, $ID_DIRECCION_LLEGADA  ,PDO::PARAM_STR);
            $stmt->bindParam(56, $CODIGO_DE_CARGA  ,PDO::PARAM_STR);

            $stmt->execute();



            $responsecode = 200;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );

            $arraydata    =     array(
                                    "codigo"                    => '0001',
                                    "mensaje"                   => 'Registro Exitoso',
                                    "data"                      =>  $ID
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


    public function actionListadoDirecciones($ruc) {

        header('Content-Type: application/json; charset=utf-8');

        try{ 

            $stmt                   =           DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC STD.ListarDireccionesGRETA
                                                    @RUCCliente = ?
                                                ');
            $stmt->bindParam(1, $ruc ,PDO::PARAM_STR);
            $stmt->execute();

            $array_detalle_asiento      =   array();

            while($row = $stmt->fetch()){
                $RUCCliente              =   $row['RUCCliente'];
                $NombreCliente           =   $row['NombreCliente'];
                $IdDireccion             =   $row['IdDireccion'];
                $Direccion               =   $row['Direccion'];
                $Departamento            =   $row['Departamento'];

                $Provincia               =   $row['Provincia'];
                $Distrito                =   $row['Distrito'];
                $Ubigeo                  =   $row['Ubigeo'];



                $array_nuevo_asiento    =   array();
                $array_nuevo_asiento    =   array(
                    "RUCCliente"         => $RUCCliente,
                    "NombreCliente"      => $NombreCliente,
                    "IdDireccion"        => $IdDireccion,
                    "Direccion"          => $Direccion,
                    "Departamento"       => $Departamento,

                    "Provincia"          => $Provincia,
                    "Distrito"           => $Distrito,
                    "Ubigeo"             => $Ubigeo

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



    public function actionListadoViaje01($dni,$fechainicio,$fechafin) {

        header('Content-Type: application/json; charset=utf-8');

        try{ 

            $stmt                   =           DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC OPE.ListarViajeGRETA
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
                $Dni_Copiloto                =   $row['Dni_Copiloto'];
                $Fecha                       =   $row['Fecha'];

                $Tracto                      =   $row['Tracto'];
                $Carreta                     =   $row['Carreta'];
                $ViajeVacio                  =   $row['ViajeVacio'];
                $IdOrigen                    =   $row['IdOrigen'];
                $Origen                      =   $row['Origen'];

                $IdDestino                   =   $row['IdDestino'];
                $Destino                     =   $row['Destino'];

                $FechaCreacion                   =   $row['FechaCreacion'];
                $FechaModifica                     =   $row['FechaModifica'];
                $Activo                     =   $row['Activo'];

                $array_nuevo_asiento    =   array();
                $array_nuevo_asiento    =   array(
                    "IdViaje"               => $IdViaje,
                    "Viaje"                 => $Viaje,
                    "Dni_Conductor"         => $Dni_Conductor,
                    "Dni_Copiloto"          => $Dni_Copiloto,
                    "Fecha"                 => $Fecha,

                    "Tracto"                => $Tracto,
                    "Carreta"               => $Carreta,
                    "ViajeVacio"            => $ViajeVacio,
                    "IdOrigen"              => $IdOrigen,
                    "Origen"                => $Origen,

                    "IdDestino"             => $IdDestino,
                    "Destino"               => $Destino,
                    "FechaCreacion"         => $FechaCreacion,
                    "FechaModifica"         => $FechaModifica,
                    "Activo"                => $Activo
                    

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


            $stmt                   =           DB::connection('sqlsrv')->getPdo()->prepare('SET NOCOUNT ON;EXEC OPE.ListarViajeGRETA
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
                $Dni_Copiloto                =   $row['Dni_Copiloto'];
                $Fecha                       =   $row['Fecha'];

                $Tracto                      =   $row['Tracto'];
                $Carreta                     =   $row['Carreta'];
                $ViajeVacio                  =   $row['ViajeVacio'];
                $IdOrigen                    =   $row['IdOrigen'];
                $Origen                      =   $row['Origen'];

                $IdDestino                   =   $row['IdDestino'];
                $Destino                     =   $row['Destino'];

                $FechaCreacion                   =   $row['FechaCreacion'];
                $FechaModifica                     =   $row['FechaModifica'];
                $Activo                     =   $row['Activo'];





                $array_nuevo_asiento    =   array();
                $array_nuevo_asiento    =   array(
                    "IdViaje"               => $IdViaje,
                    "Viaje"                 => $Viaje,
                    "Dni_Conductor"         => $Dni_Conductor,
                    "Dni_Copiloto"          => $Dni_Copiloto,
                    "Fecha"                 => $Fecha,

                    "Tracto"                => $Tracto,
                    "Carreta"               => $Carreta,
                    "ViajeVacio"            => $ViajeVacio,
                    "IdOrigen"              => $IdOrigen,
                    "Origen"                => $Origen,

                    "IdDestino"             => $IdDestino,
                    "Destino"               => $Destino,

                    "FechaCreacion"         => $FechaCreacion,
                    "FechaModifica"         => $FechaModifica,
                    "Activo"                => $Activo


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


    public function actionRegistroErrorGuia(Request $request) {

        $dni = '';
        header('Content-Type: application/json; charset=utf-8');
        $mensajeerror   =   '';
        $mensaje        =   '';
        $ID_GRETA       =   '';
        try{ 
            
            $MSJ  =   '';
            $ID         =   $request['ID'];

            $swprueba   =   0;
            // $swprueba   =   $request['SWPRUEBA'];
            if((int)$swprueba==1){
                $MSJ        =      $request['MENSAJE'];
            }
            else{

                $VIAJE                              =   $request['VIAJE'];
                $SERIE                              =   $request['SERIE'];
                $NUMERO                             =   $request['NUMERO'];
                $FECHA_EMISION                      =   $request['FECHA_EMISION'];
                $HORA_EMISION                       =   $request['HORA_EMISION'];
                $FECHA_TRASLADO                     =   $request['FECHA_TRASLADO'];
                $RUC_REMITENTE                      =   $request['RUC_REMITENTE'];
                $NOMBRE_REMITENTE                   =   $request['NOMBRE_REMITENTE'];
                $RUC_DESTINATARIO                   =   $request['RUC_DESTINATARIO'];
                $NOMBRE_DESTINATARIO                =   $request['NOMBRE_DESTINATARIO'];
                $RUC_TRANSPORTISTA                  =   $request['RUC_TRANSPORTISTA'];
                $NOMBRE_TRANSPORTISTA               =   $request['NOMBRE_TRANSPORTISTA'];
                $DIRECCION_PARTIDA                  =   $request['DIRECCION_PARTIDA'];
                $UBIGEO_PARTIDA                     =   $request['UBIGEO_PARTIDA'];
                $DIRECCION_LLEGADA                  =   $request['DIRECCION_LLEGADA'];
                $UBIGEO_LLEGADA                     =   $request['UBIGEO_LLEGADA'];
                $UNIDAD_MEDIDA                      =   $request['UNIDAD_MEDIDA'];
                $PESO                               =   $request['PESO'];
                $RUC_SUBCONTRATA                    =   $request['RUC_SUBCONTRATA'];
                $NOMBRE_SUBCONTRATA                 =   $request['NOMBRE_SUBCONTRATA'];
                $DNI_CONDUCTOR_PRINCIPAL            =   $request['DNI_CONDUCTOR_PRINCIPAL'];
                $NOMBRE_CONDUCTOR_PRINCIPAL         =   $request['NOMBRE_CONDUCTOR_PRINCIPAL'];
                $LICENCIA_CONDUCTOR_PRINCIPAL       =   $request['LICENCIA_CONDUCTOR_PRINCIPAL'];
                $DNI_CONDUCTOR_SECUNDARIO_1         =   $request['DNI_CONDUCTOR_SECUNDARIO_1'];
                $NOMBRE_CONDUCTOR_SECUNDARIO_1      =   $request['NOMBRE_CONDUCTOR_SECUNDARIO_1'];
                $LICENCIA_CONDUCTOR_SECUNDARIO_1    =   $request['LICENCIA_CONDUCTOR_SECUNDARIO_1'];
                $PLACA_PRINCIPAL                    =   $request['PLACA_PRINCIPAL'];
                $TUCE_PRINCIPAL                     =   $request['TUCE_PRINCIPAL'];
                $PLACA_SECUNDARIA                   =   $request['PLACA_SECUNDARIA'];
                $TUCE_SECUNDARIA                    =   $request['TUCE_SECUNDARIA'];
                $NRO_AUTORIZACION_MTC               =   $request['NRO_AUTORIZACION_MTC'];
                $RUC_TERCERO                        =   $request['RUC_TERCERO'];
                $NOMBRE_TERCERO                     =   $request['NOMBRE_TERCERO'];
                $OBSERVACIONES                      =   $request['OBSERVACIONES'];
                $FECHA_HORA_ENVIO                   =   $request['FECHA_HORA_ENVIO'];
                $ESTADO_SUNAT                       =   $request['ESTADO_SUNAT'];
                $RPTA_SUNAT                         =   $request['RPTA_SUNAT'];



                $stmt                               =   DB::connection('sqlsrv')->getPdo()
                                                    ->prepare('SET NOCOUNT ON;EXEC OPE.INSERTAR_ALERTA_GUIAS_GRETA 
                                                    @ID = ?,
                                                    @VIAJE = ?,
                                                    @SERIE = ?,
                                                    @NUMERO = ?,
                                                    @FECHA_EMISION = ?,
                                                    @HORA_EMISION = ?,
                                                    @FECHA_TRASLADO = ?,
                                                    @RUC_REMITENTE = ?,
                                                    @NOMBRE_REMITENTE = ?,
                                                    @RUC_DESTINATARIO = ?,
                                                    @NOMBRE_DESTINATARIO = ?,
                                                    @RUC_TRANSPORTISTA = ?,
                                                    @NOMBRE_TRANSPORTISTA = ?,
                                                    @DIRECCION_PARTIDA = ?,
                                                    @UBIGEO_PARTIDA = ?,
                                                    @DIRECCION_LLEGADA = ?,
                                                    @UBIGEO_LLEGADA = ?,
                                                    @UNIDAD_MEDIDA = ?,
                                                    @PESO = ?,
                                                    @RUC_SUBCONTRATA = ?,
                                                    @NOMBRE_SUBCONTRATA = ?,
                                                    @DNI_CONDUCTOR_PRINCIPAL = ?,
                                                    @NOMBRE_CONDUCTOR_PRINCIPAL = ?,
                                                    @LICENCIA_CONDUCTOR_PRINCIPAL = ?,
                                                    @DNI_CONDUCTOR_SECUNDARIO_1 = ?,
                                                    @NOMBRE_CONDUCTOR_SECUNDARIO_1 = ?,
                                                    @LICENCIA_CONDUCTOR_SECUNDARIO_1 = ?,
                                                    @PLACA_PRINCIPAL = ?,
                                                    @TUCE_PRINCIPAL = ?,
                                                    @PLACA_SECUNDARIA = ?,
                                                    @TUCE_SECUNDARIA = ?,
                                                    @NRO_AUTORIZACION_MTC = ?,
                                                    @RUC_TERCERO = ?,
                                                    @NOMBRE_TERCERO = ?,
                                                    @OBSERVACIONES = ?,
                                                    @FECHA_HORA_ENVIO = ?,
                                                    @ESTADO_SUNAT = ?,
                                                    @RPTA_SUNAT = ?
                                                    ');

                $stmt->bindParam(1, $ID ,PDO::PARAM_STR);                   
                $stmt->bindParam(2, $VIAJE  ,PDO::PARAM_STR);
                $stmt->bindParam(3, $SERIE  ,PDO::PARAM_STR);
                $stmt->bindParam(4, $NUMERO  ,PDO::PARAM_STR);
                $stmt->bindParam(5, $FECHA_EMISION  ,PDO::PARAM_STR);
                $stmt->bindParam(6, $HORA_EMISION ,PDO::PARAM_STR);
                $stmt->bindParam(7, $FECHA_TRASLADO  ,PDO::PARAM_STR);
                $stmt->bindParam(8, $RUC_REMITENTE  ,PDO::PARAM_STR);
                $stmt->bindParam(9, $NOMBRE_REMITENTE  ,PDO::PARAM_STR);
                $stmt->bindParam(10, $RUC_DESTINATARIO  ,PDO::PARAM_STR);
                $stmt->bindParam(11, $NOMBRE_DESTINATARIO ,PDO::PARAM_STR);                   
                $stmt->bindParam(12, $RUC_TRANSPORTISTA  ,PDO::PARAM_STR);
                $stmt->bindParam(13, $NOMBRE_TRANSPORTISTA  ,PDO::PARAM_STR);
                $stmt->bindParam(14, $DIRECCION_PARTIDA  ,PDO::PARAM_STR);
                $stmt->bindParam(15, $UBIGEO_PARTIDA  ,PDO::PARAM_STR);
                $stmt->bindParam(16, $DIRECCION_LLEGADA ,PDO::PARAM_STR);
                $stmt->bindParam(17, $UBIGEO_LLEGADA  ,PDO::PARAM_STR);
                $stmt->bindParam(18, $UNIDAD_MEDIDA  ,PDO::PARAM_STR);
                $stmt->bindParam(19, $PESO  ,PDO::PARAM_STR);
                $stmt->bindParam(20, $RUC_SUBCONTRATA  ,PDO::PARAM_STR);
                $stmt->bindParam(21, $NOMBRE_SUBCONTRATA ,PDO::PARAM_STR);                   
                $stmt->bindParam(22, $DNI_CONDUCTOR_PRINCIPAL  ,PDO::PARAM_STR);
                $stmt->bindParam(23, $NOMBRE_CONDUCTOR_PRINCIPAL  ,PDO::PARAM_STR);
                $stmt->bindParam(24, $LICENCIA_CONDUCTOR_PRINCIPAL  ,PDO::PARAM_STR);
                $stmt->bindParam(25, $DNI_CONDUCTOR_SECUNDARIO_1  ,PDO::PARAM_STR);
                $stmt->bindParam(26, $NOMBRE_CONDUCTOR_SECUNDARIO_1 ,PDO::PARAM_STR);
                $stmt->bindParam(27, $LICENCIA_CONDUCTOR_SECUNDARIO_1  ,PDO::PARAM_STR);
                $stmt->bindParam(28, $PLACA_PRINCIPAL  ,PDO::PARAM_STR);
                $stmt->bindParam(29, $TUCE_PRINCIPAL  ,PDO::PARAM_STR);
                $stmt->bindParam(30, $PLACA_SECUNDARIA  ,PDO::PARAM_STR);
                $stmt->bindParam(31,$TUCE_SECUNDARIA  ,PDO::PARAM_STR);
                $stmt->bindParam(32, $NRO_AUTORIZACION_MTC ,PDO::PARAM_STR);                   
                $stmt->bindParam(33, $RUC_TERCERO  ,PDO::PARAM_STR);
                $stmt->bindParam(34, $NOMBRE_TERCERO  ,PDO::PARAM_STR);
                $stmt->bindParam(35, $OBSERVACIONES  ,PDO::PARAM_STR);
                $stmt->bindParam(36, $FECHA_HORA_ENVIO ,PDO::PARAM_STR);
                $stmt->bindParam(37, $ESTADO_SUNAT  ,PDO::PARAM_STR);
                $stmt->bindParam(38, $RPTA_SUNAT  ,PDO::PARAM_STR);
             
                $stmt->execute();

                // Capturar los resultados
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                //dd($result);
                // Verificar los valores retornados
                if ($result) {
                    $error = $result['error'];      // Captura el campo 'error'
                    $mensaje = $result['mensaje'];  // Captura el campo 'mensaje'

                    // Evaluar el resultado
                    if ($error == 0) {
                        $ID_GRETA = $mensaje;
                        goto Insertar_Mensaje_Whatsapp;
                    } else {
                        $mensajeerror = $mensaje;
                        goto Error_InsercionRegistroGuia;
                    }
                } else {
                    // Si no se obtienen resultados

                    $responsecode = 401;
                    $header = array (
                        'Content-Type'  => 'application/json; charset=UTF-8',
                        'charset'       => 'utf-8'
                    );
                    $arraydata    =     array(
                                    "codigo"                    => '0000',
                                    "mensaje"                   => 'No se obtuvo respuesta del procedimiento de insercion',
                                    "data"                      =>  $ID_GRETA
                                    );

                    return response()->json($arraydata, 
                    $responsecode, $header, JSON_UNESCAPED_UNICODE);
                }

                Insertar_Mensaje_Whatsapp:

                $MSJ .=   'FECHA_HORA_ENVIO : ' . $FECHA_HORA_ENVIO;
                $MSJ .=   '%0D%0AESTADO_SUNAT : ' . $ESTADO_SUNAT;
                $MSJ .=   '%0D%0ARPTA_SUNAT : ' . $RPTA_SUNAT;

                $MSJ .=   '%0D%0AID: '. $ID;
                $MSJ .=   '%0D%0AVIAJE : ' . $VIAJE;
                $MSJ .=   '%0D%0ASERIE : ' . $SERIE;
                $MSJ .=   '%0D%0ANUMERO : ' . $NUMERO;
                $MSJ .=   '%0D%0AFECHA_EMISION : ' . $FECHA_EMISION;
                $MSJ .=   '%0D%0AHORA_EMISION : ' . $HORA_EMISION;
                $MSJ .=   '%0D%0AFECHA_TRASLADO : ' . $FECHA_TRASLADO;
                $MSJ .=   '%0D%0ARUC_REMITENTE : ' . $RUC_REMITENTE;
                $MSJ .=   '%0D%0ANOMBRE_REMITENTE : ' . $NOMBRE_REMITENTE;
                $MSJ .=   '%0D%0ARUC_DESTINATARIO : ' . $RUC_DESTINATARIO;

                $MSJ .=   '%0D%0ANOMBRE_DESTINATARIO : ' . $NOMBRE_DESTINATARIO;
                $MSJ .=   '%0D%0ARUC_TRANSPORTISTA : ' . $RUC_TRANSPORTISTA;
                $MSJ .=   '%0D%0ANOMBRE_TRANSPORTISTA : ' . $NOMBRE_TRANSPORTISTA;
                $MSJ .=   '%0D%0ADIRECCION_PARTIDA : ' . $DIRECCION_PARTIDA;
                $MSJ .=   '%0D%0AUBIGEO_PARTIDA : ' . $UBIGEO_PARTIDA;
                $MSJ .=   '%0D%0ADIRECCION_LLEGADA : ' . $DIRECCION_LLEGADA;
                $MSJ .=   '%0D%0AUBIGEO_LLEGADA : ' . $UBIGEO_LLEGADA;
                $MSJ .=   '%0D%0AUNIDAD_MEDIDA : ' . $UNIDAD_MEDIDA;
                $MSJ .=   '%0D%0APESO : ' . $PESO;
                $MSJ .=   '%0D%0ARUC_SUBCONTRATA : ' . $RUC_SUBCONTRATA;

                $MSJ .=   '%0D%0ANOMBRE_SUBCONTRATA : ' . $NOMBRE_SUBCONTRATA;
                $MSJ .=   '%0D%0ADNI_CONDUCTOR_PRINCIPAL : ' . $DNI_CONDUCTOR_PRINCIPAL;
                $MSJ .=   '%0D%0ANOMBRE_CONDUCTOR_PRINCIPAL : ' . $NOMBRE_CONDUCTOR_PRINCIPAL;
                $MSJ .=   '%0D%0ALICENCIA_CONDUCTOR_PRINCIPAL : ' . $LICENCIA_CONDUCTOR_PRINCIPAL;
                $MSJ .=   '%0D%0ADNI_CONDUCTOR_SECUNDARIO_1 : ' . $DNI_CONDUCTOR_SECUNDARIO_1;
                $MSJ .=   '%0D%0ANOMBRE_CONDUCTOR_SECUNDARIO_1 : ' . $NOMBRE_CONDUCTOR_SECUNDARIO_1;
                $MSJ .=   '%0D%0ALICENCIA_CONDUCTOR_SECUNDARIO_1 : ' . $LICENCIA_CONDUCTOR_SECUNDARIO_1;
                
                $MSJ .=   '%0D%0APLACA_PRINCIPAL : ' . $PLACA_PRINCIPAL;
                $MSJ .=   '%0D%0ATUCE_PRINCIPAL : ' . $TUCE_PRINCIPAL;
                $MSJ .=   '%0D%0APLACA_SECUNDARIA : ' . $PLACA_SECUNDARIA;
                $MSJ .=   '%0D%0ATUCE_SECUNDARIA : ' . $TUCE_SECUNDARIA;

                $MSJ .=   '%0D%0ANRO_AUTORIZACION_MTC : ' . $NRO_AUTORIZACION_MTC;
                $MSJ .=   '%0D%0ARUC_TERCERO : ' . $RUC_TERCERO;
                $MSJ .=   '%0D%0ANOMBRE_TERCERO : ' . $NOMBRE_TERCERO;
                $MSJ .=   '%0D%0AOBSERVACIONES : ' . $OBSERVACIONES;
            }

            $NombreRemitente                    =   'GRETA';
            $NumeroContacto                     =   '51979628019';
            $NombreContacto                     =   'Alertas Guias Greta';
            $Mensaje                            =   $MSJ;
            $IndArchivo                         =   0;
            $RutaArchivo                        =   '';
            $SizeArchivo                        =   0;
            $NombreProyecto                     =   'ALERTAS-GUIAS-GRETA';
          


            $stmt_wsp                           =   DB::connection('sqlsrv')
                                                        ->getPdo()
                                                        ->prepare('SET NOCOUNT ON;
                                                            INSERT INTO  dbo.whatsapp 
                                                            (NumeroContacto,NombreContacto,Mensaje,IndArchivo,RutaArchivo,SizeArchivo,NombreProyecto,NombreRemitente) 
                                                            VALUES (?,?,?,?,?,?,?,?)');

            $stmt_wsp->bindParam(1, $NumeroContacto ,PDO::PARAM_STR);                   
            $stmt_wsp->bindParam(2, $NombreContacto  ,PDO::PARAM_STR);
            $stmt_wsp->bindParam(3, $Mensaje  ,PDO::PARAM_STR);
            $stmt_wsp->bindParam(4, $IndArchivo  ,PDO::PARAM_STR);
            $stmt_wsp->bindParam(5, $RutaArchivo  ,PDO::PARAM_STR);
            $stmt_wsp->bindParam(6, $SizeArchivo ,PDO::PARAM_STR);
            $stmt_wsp->bindParam(7, $NombreProyecto  ,PDO::PARAM_STR);
            $stmt_wsp->bindParam(8, $NombreRemitente  ,PDO::PARAM_STR);
            $stmt_wsp->execute();


            $responsecode = 200;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );

            $arraydata    =     array(
                                    "codigo"                    => '0001',
                                    "mensaje"                   => 'Registro Exitoso',
                                    "data"                      =>  $ID_GRETA
                                    );

            return response()->json($arraydata, 
                    $responsecode, $header, JSON_UNESCAPED_UNICODE);

        }catch(\Exception $ex){

            $mensajeerror =$ex->getMessage();
            Error_InsercionRegistroGuia:

            $array_respuesta    =   array(
                "codigo"                    => '0000',
                "mensaje"                   => 'Ocurrio un error '.$mensajeerror,
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
