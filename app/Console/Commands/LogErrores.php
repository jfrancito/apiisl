<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;
use DB;
use DateTime;
use App\Traits\ErrorLogTraits;
class LogErrores extends Command
{    
    use ErrorLogTraits;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:error';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mensaje de error log';

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

        $ffin    =   date('d-m-Y H:i:s');
        $emailde = 'soporte.notificacion.ar@gmail.com';

        $this->actionEnviarCorreoError($ffin,$emailde);


    }
}
