<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;
use DB;
use DateTime;

class CrearPdfSap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crear:pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CREAR PDF';
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

        $url = 'http://172.16.20.8:8080';
        //dd($url);
        //FACTURA Y BOLETA
        file_get_contents($url.'/leerxml/leerxmlsinvoicemigrar');
        file_get_contents($url.'/leerxml/generarpdfinvoice');
        //RETENCION
        file_get_contents($url.'/leerxml/leerxmlsretencionmigrar');
        file_get_contents($url.'/leerxml/generarpdfretencion');
        //GUIA
        file_get_contents($url.'/leerxml/leerxmlguiamigrar');
        file_get_contents($url.'/leerxml/generarpdfguia');
        //NOTA CREDITO
        file_get_contents($url.'/leerxml/leerxmlnotacreditomigrar');
        file_get_contents($url.'/leerxml/generarpdfnc');             


    }
}
