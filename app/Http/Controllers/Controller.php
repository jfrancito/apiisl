<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public $fin;
	public $emailde='';

	
	public function __construct()
	{

		$this->emailde = 'soporte.notificacion.ar@gmail.com';
		$this->fin 		= date_format(date_create(date('Y-m-d')), 'd-m-Y');

	}



}
