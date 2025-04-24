<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\FeFacturacionSap;
use App\Modelos\STDVehiculo;
use App\Modelos\STDTipoVehiculo;
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
		return json_encode($dni);
		
	}

	public function actionRegistroDatosGpsTrackLog(Request $request) {

		// $dni = '';
		header('Content-Type: application/json; charset=utf-8');

		try{ 
			$mensajeerror = '';
			$oeDatos    =   $request->all();


			$responsecode = 200;
			$header = array (
				'Content-Type'  => 'application/json; charset=UTF-8',
				'charset'       => 'utf-8'
			);

			

			$IdProveedorGps     =   '1CH000000000001';
			$IdGps               =  $oeDatos['id'];
			$IdPlaca             =  $oeDatos['idplaca'];
			$Placa               =  $oeDatos['placa'];
			$Fecha               =  $oeDatos['fecha'];
			$Hora                =  $oeDatos['hora'];
			$FechaRegistro       =  date('Y-m-j H:i:s',strtotime(trim($oeDatos['fecha']).' '.trim($oeDatos['hora'])));
			$Calle               =  $oeDatos['calle'];
			$Locaidad            =  $oeDatos['locaidad'];
			$Distrito            =  $oeDatos['distrito'];
			$Pais                =  $oeDatos['pais'];
			$Velocidad           =  $oeDatos['velocidad'];
			$Brujula             =  $oeDatos['brujula'];
			$Evento              =  $oeDatos['evento'];
			$Latitud             =  $oeDatos['latitud'];
			$Longitud            =  $oeDatos['longitud'];
			$Canbus              =  $oeDatos['canbus'];
			// $Odometro            =  (float)$oeDatos['odometro'];
			// $Odometro            =  $Odometro/1000;
			// $Odometro = number_format(((float)$oeDatos['odometro'] / 1000), 4, '.', '');
			// Log::info("Datos Json: " . $Odometro);
			
			$Kilometraje         =  $oeDatos['kilometraje'];
			$Ubicacion           =  $oeDatos['ubicacion'];
	
			$stmt              	 =   DB::connection('sqlsrvtel')->getPdo()->prepare('SET NOCOUNT ON;EXEC INSERTAR_DATOS_GPS_TRACKLOG 
		                                	@IdProveedorGps  =   ?,
											@IdGps           =   ?,
											@IdPlaca         =   ?,
											@Placa           =   ?,
											@Fecha           =   ?,
											@Hora            =   ?,
											@FechaRegistro   =   ?,
											@Calle           =   ?,
											@Locaidad        =   ?,
											@Distrito        =   ?,
											@Pais            =   ?,
											@Velocidad       =   ?,
											@Brujula         =   ?,
											@Evento          =   ?,
											@Latitud         =   ?,
											@Longitud        =   ?,
											@Canbus          =   ?,
											@Odometro        =   ?,
											@Kilometraje     =   ?,
											@Ubicacion       =   ?
		                                ');
			$stmt->bindParam(1, $IdProveedorGps ,PDO::PARAM_STR);                   
			$stmt->bindParam(2, $IdGps  ,PDO::PARAM_STR);
			$stmt->bindParam(3, $IdPlaca  ,PDO::PARAM_STR);
			$stmt->bindParam(4, $Placa  ,PDO::PARAM_STR);
			$stmt->bindParam(5, $Fecha  ,PDO::PARAM_STR);
			$stmt->bindParam(6, $Hora ,PDO::PARAM_STR);
			$stmt->bindParam(7, $FechaRegistro  ,PDO::PARAM_STR);
			$stmt->bindParam(8, $Calle  ,PDO::PARAM_STR);
			$stmt->bindParam(9, $Locaidad  ,PDO::PARAM_STR);
			$stmt->bindParam(10,$Distrito  ,PDO::PARAM_STR);
			$stmt->bindParam(11, $Pais ,PDO::PARAM_STR);                   
			$stmt->bindParam(12, $Velocidad  ,PDO::PARAM_STR);
			$stmt->bindParam(13, $Brujula  ,PDO::PARAM_STR);
			$stmt->bindParam(14, $Evento  ,PDO::PARAM_STR);
			$stmt->bindParam(15, $Latitud  ,PDO::PARAM_STR);
			$stmt->bindParam(16, $Longitud ,PDO::PARAM_STR);
			$stmt->bindParam(17, $Canbus  ,PDO::PARAM_STR);
			$stmt->bindParam(18, $Odometro  ,PDO::PARAM_STR);
			$stmt->bindParam(19, $Kilometraje  ,PDO::PARAM_STR);
			$stmt->bindParam(20, $Ubicacion  ,PDO::PARAM_STR);
			$stmt->execute();

			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			$mensaje = $resultado['mensaje'];
			$swerror = $resultado['error'];
			if((int)$swerror>0){
				$mensajeerror = $mensaje;
				goto Error_InsercionRegistro;
			}

			$responsecode = 200;
			$header = array (
			    'Content-Type'  => 'application/json; charset=UTF-8',
			    'charset'       => 'utf-8'
			);

			$arraydata    =     array(
			                        "codigo"                    => '0001',
			                        "mensaje"                   => 'Registro Exitoso',
			                        "data"                      =>  $IdGps
			                        );

			return response()->json($arraydata, 
			        $responsecode, $header, JSON_UNESCAPED_UNICODE);

		}catch(\Exception $ex){

			$mensajeerror = $ex->getMessage();
			Error_InsercionRegistro:

			$array_respuesta    =   array(
				"codigo"                    => '0000',
				"mensaje"                   => 'Ocurrio un error '.$mensajeerror
			);

			$responsecode = 401;
			$header = array (
				'Content-Type'  => 'application/json; charset=UTF-8',
				'charset'       => 'utf-8'
			);
			return response()->json($array_respuesta, $responsecode, $header, JSON_UNESCAPED_UNICODE);

		}
	}
		

	public function actionRegistroDatosGpsTrackLogMasivo(Request $request) {

		header('Content-Type: application/json; charset=utf-8');
		
		try{ 

			$mensajeerror 	= 	'';
			// $oeDatos    	=   $request->all();
			$contError 		=	0;
			$responsecode 	= 	200;
			$header = array (
				'Content-Type'  => 'application/json; charset=UTF-8',
				'charset'       => 'utf-8'
			);
			$rpta = [];
			// return $request->all();
			// $oeDatosRq    =   $request->all()['items'];
			// $oelDatos   =   $oeDatosRq['items'];
			$oelDatos    	=   $request->all()['items'];
			// return json_encode($oelDatos);
			$contDatos  	=   count($oelDatos);
			$errors			=	[];
			foreach ($oelDatos as $index => $oeRegistro) 
			{
				$IdProveedorGps     =   '1CH000000000001';
				$IdGps               =  $oeRegistro['id'];
				$IdPlaca             =  $oeRegistro['idplaca'];
				$Placa               =  $oeRegistro['placa'];
				$Fecha               =  $oeRegistro['fecha'];
				$Hora                =  $oeRegistro['hora'];
				$FechaRegistro       =  date('Y-d-m H:i:s',strtotime(trim($oeRegistro['fecha']).' '.trim($oeRegistro['hora'])));
				$Calle               =  $oeRegistro['calle'];
				$Locaidad            =  $oeRegistro['locaidad'];
				$Distrito            =  $oeRegistro['distrito'];
				$Pais                =  $oeRegistro['pais'];
				$Velocidad           =  $oeRegistro['velocidad'];
				$Brujula             =  $oeRegistro['brujula'];
				$Evento              =  $oeRegistro['evento'];
				$Latitud             =  $oeRegistro['latitud'];
				$Longitud            =  $oeRegistro['longitud'];
				$Canbus              =  $oeRegistro['canbus'];
				$Odometro            =  (isset($oeRegistro['odometro']))?(float)($oeRegistro['odometro']):0.0;
				$Odometro            =  (float)($Odometro/1000);
				$Kilometraje         =  (isset($oeRegistro['kilometraje']))?(float)($oeRegistro['kilometraje']):0.0;
				$Ubicacion           =  $oeRegistro['ubicacion'];
				$TipoCombustible     =  '';//(isset($oeRegistro['tipocombustible']))?$oeRegistro['tipocombustible']:'';
				$ConsumoCombustible  = 	(float)$oeRegistro['combustible'];
				$NivelCombustible    =  (float)$oeRegistro['nivelcombustible'];
				$RPM           		 =  (float)$oeRegistro['rpm'];
				$Horometro           =  (float)$oeRegistro['horometro'];
				
				// return json_encode(compact('IdProveedorGps','IdGps','IdPlaca','Placa','Fecha','Hora','FechaRegistro','Calle','Locaidad','Distrito','Pais','Velocidad','Brujula','Evento','Latitud','Longitud','Canbus','Odometro','Kilometraje','Ubicacion','TipoCombustible','ConsumoCombustible','NivelCombustible','RPM'));
				$stmt              	 =   DB::connection('sqlsrvtel')->getPdo()->prepare('SET NOCOUNT ON;EXEC INSERTAR_DATOS_GPS_TRACKLOG_MASIVO 
			                                	@IdProveedorGps  	=   ?,
												@IdGps          	=   ?,
												@IdPlaca         	=   ?,
												@Placa           	=   ?,
												@Fecha           	=   ?,
												@Hora            	=   ?,
												@FechaRegistro   	=   ?,
												@Calle           	=   ?,
												@Locaidad        	=   ?,
												@Distrito        	=   ?,
												@Pais            	=   ?,
												@Velocidad       	=   ?,
												@Brujula         	=   ?,
												@Evento          	=   ?,
												@Latitud         	=   ?,
												@Longitud        	=   ?,
												@Canbus          	=   ?,
												@Odometro        	=   ?,
												@Kilometraje     	=   ?,
												@Ubicacion       	=   ?,
												@TipoCombustible    =   ?,
												@ConsumoCombustible =   ?,
												@NivelCombustible   =   ?,
												@RPM       			=   ?,
												@Horometro  		=   ?
			                                ');



				$stmt->bindParam(1, $IdProveedorGps ,PDO::PARAM_STR);                   
				$stmt->bindParam(2, $IdGps  ,PDO::PARAM_STR);
				$stmt->bindParam(3, $IdPlaca  ,PDO::PARAM_STR);
				$stmt->bindParam(4, $Placa  ,PDO::PARAM_STR);
				$stmt->bindParam(5, $Fecha  ,PDO::PARAM_STR);
				$stmt->bindParam(6, $Hora ,PDO::PARAM_STR);
				$stmt->bindParam(7, $FechaRegistro  ,PDO::PARAM_STR);
				$stmt->bindParam(8, $Calle  ,PDO::PARAM_STR);
				$stmt->bindParam(9, $Locaidad  ,PDO::PARAM_STR);
				$stmt->bindParam(10,$Distrito  ,PDO::PARAM_STR);
				$stmt->bindParam(11, $Pais ,PDO::PARAM_STR);                   
				$stmt->bindParam(12, $Velocidad  ,PDO::PARAM_STR);
				$stmt->bindParam(13, $Brujula  ,PDO::PARAM_STR);
				$stmt->bindParam(14, $Evento  ,PDO::PARAM_STR);
				$stmt->bindParam(15, $Latitud  ,PDO::PARAM_STR);
				$stmt->bindParam(16, $Longitud ,PDO::PARAM_STR);
				$stmt->bindParam(17, $Canbus  ,PDO::PARAM_STR);
				$stmt->bindParam(18, $Odometro  ,PDO::PARAM_STR);
				$stmt->bindParam(19, $Kilometraje  ,PDO::PARAM_STR);
				$stmt->bindParam(20, $Ubicacion  ,PDO::PARAM_STR);

				$stmt->bindParam(21, $TipoCombustible  ,PDO::PARAM_STR);
				$stmt->bindParam(22, $ConsumoCombustible  ,PDO::PARAM_STR);
				$stmt->bindParam(23, $NivelCombustible  ,PDO::PARAM_STR);
				$stmt->bindParam(24, $RPM  ,PDO::PARAM_STR);
				$stmt->bindParam(25, $Horometro  ,PDO::PARAM_STR);
				$stmt->execute();

				$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
				$mensaje = $resultado['mensaje'];
				$error = $resultado['error'];
				if((int)$error>0){
					$mensajeerror = $mensaje;
					// goto Error_InsercionRegistro;
					$errors[] = ['id'=>$IdGps,'error'=>$error,'mensaje'=>$mensaje];
					$contError++;
				}
			}

			$responsecode = 200;
			$codigo = '0001';
			$mensaje = 'Registro Exitoso';
			if($contError>0){
				$rpta = json_encode(['errors'=>$errors]);
				$responsecode = 401;
				$codigo = '0000';
				$mensaje = 'Ocurrio un Error';
			}
			else{
				$rpta = json_encode(['rpta'=>'ok']);
			}

			$header = array (
			    'Content-Type'  => 'application/json; charset=UTF-8',
			    'charset'       => 'utf-8'
			);

			$arraydata    =     array(
			                        "codigo"                    => $codigo,
			                        "mensaje"                   => $mensaje,
			                        "data"                      => $rpta
			                        );

			return response()->json($arraydata, 
			        $responsecode, $header, JSON_UNESCAPED_UNICODE);

		}catch(\Exception $ex){

			$mensajeerror = $ex->getMessage();
			Error_InsercionRegistro:

			$array_respuesta    =   array(
				"codigo"                    => '0000',
				"mensaje"                   => 'Ocurrio un error '.$mensajeerror
			);

			$responsecode = 401;
			$header = array (
				'Content-Type'  => 'application/json; charset=UTF-8',
				'charset'       => 'utf-8'
			);
			return response()->json($array_respuesta, $responsecode, $header, JSON_UNESCAPED_UNICODE);

		}
	}

	
	public function actionRegistroDatosGpsTrackLogLive(Request $request) {

		header('Content-Type: application/json; charset=utf-8');
		
		try{ 

			$mensajeerror 	= 	'';
			// $oeDatos    	=   $request->all();
			$contError 		=	0;
			$responsecode 	= 	200;
			$header = array (
				'Content-Type'  => 'application/json; charset=UTF-8',
				'charset'       => 'utf-8'
			);
			$rpta = [];
			// $oeDatosRq    =   $request->all()['items'];
			// $oelDatos   =   $oeDatosRq['items'];
			$oelDatos    	=   $request->all()['items'];
			// return json_encode($oelDatos);
			$contDatos  	=   count($oelDatos);
			$errors			=	[];
			foreach ($oelDatos as $index => $oeRegistro) 
			{
				$IdProveedorGps     =   '1CH000000000001';
				$IdGps               =  $oeRegistro['id'];
				$IdPlaca             =  $oeRegistro['idplaca'];
				$Placa               =  $oeRegistro['placa'];
				$Fecha               =  $oeRegistro['fecha'];
				$Hora                =  $oeRegistro['hora'];
				$FechaRegistro       =  date('Y-m-j H:i:s',strtotime(trim($oeRegistro['fecha']).' '.trim($oeRegistro['hora'])));
				$Calle               =  $oeRegistro['calle'];
				$Locaidad            =  $oeRegistro['locaidad'];
				$Distrito            =  $oeRegistro['distrito'];
				$Pais                =  $oeRegistro['pais'];
				$Velocidad           =  $oeRegistro['velocidad'];
				$Brujula             =  $oeRegistro['brujula'];
				$Evento              =  $oeRegistro['evento'];
				$Latitud             =  $oeRegistro['latitud'];
				$Longitud            =  $oeRegistro['longitud'];
				$Canbus              =  $oeRegistro['canbus'];
				$Odometro            =  (isset($oeRegistro['odometro']))?(float)($oeRegistro['odometro']):0.0;
				$Kilometraje         =  (isset($oeRegistro['kilometraje']))?(float)($oeRegistro['kilometraje']):0.0;
				$Ubicacion           =  $oeRegistro['ubicacion'];
				
				$TipoCombustible     =  '';//(isset($oeRegistro['tipocombustible']))?$oeRegistro['tipocombustible']:'';
				$ConsumoCombustible  =  0.0;//(isset($oeRegistro['consumocombustible']))?(float)($oeRegistro['consumocombustible']):0.0;
				$NivelCombustible    =  0.0;//(isset($oeRegistro['nivelcombustible']))?(float)($oeRegistro['nivelcombustible']):0.0;
				$RPM           		 =  0.0;//(isset($oeRegistro['rpm']))?(float)($oeRegistro['rpm']):0.0;
				
				$stmt              	 =   DB::connection('sqlsrvtel')->getPdo()->prepare('SET NOCOUNT ON;EXEC INSERTAR_DATOS_GPS_TRACKLOG_MASIVO 
			                                	@IdProveedorGps  =   ?,
												@IdGps           =   ?,
												@IdPlaca         =   ?,
												@Placa           =   ?,
												@Fecha           =   ?,
												@Hora            =   ?,
												@FechaRegistro   =   ?,
												@Calle           =   ?,
												@Locaidad        =   ?,
												@Distrito        =   ?,
												@Pais            =   ?,
												@Velocidad       =   ?,
												@Brujula         =   ?,
												@Evento          =   ?,
												@Latitud         =   ?,
												@Longitud        =   ?,
												@Canbus          =   ?,
												@Odometro        =   ?,
												@Kilometraje     =   ?,
												@Ubicacion       =   ?,
												@TipoCombustible    =   ?,
												@ConsumoCombustible =   ?,
												@NivelCombustible   =   ?,
												@RPM       			=   ?
			                                ');



				$stmt->bindParam(1, $IdProveedorGps ,PDO::PARAM_STR);                   
				$stmt->bindParam(2, $IdGps  ,PDO::PARAM_STR);
				$stmt->bindParam(3, $IdPlaca  ,PDO::PARAM_STR);
				$stmt->bindParam(4, $Placa  ,PDO::PARAM_STR);
				$stmt->bindParam(5, $Fecha  ,PDO::PARAM_STR);
				$stmt->bindParam(6, $Hora ,PDO::PARAM_STR);
				$stmt->bindParam(7, $FechaRegistro  ,PDO::PARAM_STR);
				$stmt->bindParam(8, $Calle  ,PDO::PARAM_STR);
				$stmt->bindParam(9, $Locaidad  ,PDO::PARAM_STR);
				$stmt->bindParam(10,$Distrito  ,PDO::PARAM_STR);
				$stmt->bindParam(11, $Pais ,PDO::PARAM_STR);                   
				$stmt->bindParam(12, $Velocidad  ,PDO::PARAM_STR);
				$stmt->bindParam(13, $Brujula  ,PDO::PARAM_STR);
				$stmt->bindParam(14, $Evento  ,PDO::PARAM_STR);
				$stmt->bindParam(15, $Latitud  ,PDO::PARAM_STR);
				$stmt->bindParam(16, $Longitud ,PDO::PARAM_STR);
				$stmt->bindParam(17, $Canbus  ,PDO::PARAM_STR);
				$stmt->bindParam(18, $Odometro  ,PDO::PARAM_STR);
				$stmt->bindParam(19, $Kilometraje  ,PDO::PARAM_STR);
				$stmt->bindParam(20, $Ubicacion  ,PDO::PARAM_STR);

				$stmt->bindParam(21, $TipoCombustible  ,PDO::PARAM_STR);
				$stmt->bindParam(22, $ConsumoCombustible  ,PDO::PARAM_STR);
				$stmt->bindParam(23, $NivelCombustible  ,PDO::PARAM_STR);
				$stmt->bindParam(24, $RPM  ,PDO::PARAM_STR);
				$stmt->execute();

				$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
				$mensaje = $resultado['mensaje'];
				$error = $resultado['error'];
				if((int)$error>0){
					$mensajeerror = $mensaje;
					// goto Error_InsercionRegistro;
					$errors[] = ['id'=>$IdGps,'error'=>$error,'mensaje'=>$mensaje];
					$contError++;
				}
			}

			$responsecode = 200;
			$codigo = '0001';
			$mensaje = 'Registro Exitoso';
			if($contError>0){
				$rpta = json_encode(['errors'=>$errors]);
				$responsecode = 401;
				$codigo = '0000';
				$mensaje = 'Ocurrio un Error';
			}
			else{
				$rpta = json_encode(['rpta'=>'ok']);
			}

			$header = array (
			    'Content-Type'  => 'application/json; charset=UTF-8',
			    'charset'       => 'utf-8'
			);

			$arraydata    =     array(
			                        "codigo"                    => $codigo,
			                        "mensaje"                   => $mensaje,
			                        "data"                      => $rpta
			                        );

			return response()->json($arraydata, 
			        $responsecode, $header, JSON_UNESCAPED_UNICODE);

		}catch(\Exception $ex){

			$mensajeerror = $ex->getMessage();
			Error_InsercionRegistro:

			$array_respuesta    =   array(
				"codigo"                    => '0000',
				"mensaje"                   => 'Ocurrio un error '.$mensajeerror
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
