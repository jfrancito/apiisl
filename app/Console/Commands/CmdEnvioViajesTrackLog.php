<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;
use DB;
use DateTime;
// use App\Traits\SapInfApiTraits;
use App\Modelos\TbLogMigrarPanelDist;
use PDO;

class CmdEnvioViajesTrackLog extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'Api:EnvioViajesTrackLog';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Envio de Datos de Viajes Programados hacia Track Log para el PanelDist y seguimiento de los estados de Viaje';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		//
		$FECHAINI  =   date('Y-m-d',strtotime('2025-05-24'));
		$FECHAFIN  =   date('Y-m-d');
		//PREPARAR EL JSON PARA PODER INSERTAR LOS VIAJES MEDIANTE EL API
		$djson      =   $this->getJsonInsertarViajesPanelDist($FECHAINI,$FECHAFIN);

		dd($djson);

	}

	public function getJsonInsertarViajesPanelDist($FECHAINI,$FECHAFIN)
	{
		$DNI = '';
		$stmt       =   DB::connection('sqlsrv')->getPdo()
							->prepare('SET NOCOUNT ON;EXEC OPE.ListarViajesTrackLog
										@DniPiloto = ?,
										@FechaInicio = ?,
										@FechaFin = ?
									');

		$stmt->bindParam(1, $DNI ,PDO::PARAM_STR);                   
		$stmt->bindParam(2, $FECHAINI  ,PDO::PARAM_STR);
		$stmt->bindParam(3, $FECHAFIN  ,PDO::PARAM_STR);
		$stmt->execute();

		$olViajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// dd($olViajes);
		$dtsjson = [];
		$dtsprog = [];
		foreach($olViajes as $oeViaje){
			$fila = [
				"placa"				=>	$oeViaje['Tracto'],
				"remolque"			=>	$oeViaje['Carreta'],
				"codigo"			=>	$oeViaje['Viaje'],
				"servicio"			=>	"",
				"origen"			=>	$oeViaje['GeocercaOrigen'],
				"destino"			=>	$oeViaje['GeocercaDestino'],
				"codigo_origen"		=>	substr($oeViaje['Origen'], 0, 10),
				"codigo_destino"	=>	substr($oeViaje['Destino'], 0, 10),
				"poly_origen"		=>	"",
				"poly_destino"		=>	"",
				"hora_inicio"		=>	date('H:i:s',strtotime($oeViaje['Fecha'])),
				"fecha_inicio"		=>	date('Y-m-d',strtotime($oeViaje['Fecha'])),
				"conductor"			=>	$oeViaje['Conductor'],
				"telefono"			=>	"",
				"zona"				=>	"",
				"operacion"			=>	"",
				"cliente"			=>	$oeViaje['Cliente'],
				"documento"			=>	"",
				"pedido"			=>	"",
				"segmento"			=>	"",
				"cantidad"			=>	0,
				"volumen"			=>	0,
				"peso"				=>	0.00,
				"valor"				=>	0.00,
				"minutos_ruta"		=>	(int)(((float)$oeViaje['Horas'])*60),
				"fecha_ruta"		=>	date('H:i:s',strtotime($oeViaje['FechaLlegada'])),
				"horas_ruta"		=>	date('Y-m-d',strtotime($oeViaje['FechaLlegada'])),
				"estado"			=>	"PROGRAMADO"
			];
		    $dtsprog[] = $fila;
		}
		$dtsjson = ['program'=>$dtsprog];
		return json_encode($dtsjson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}


}
