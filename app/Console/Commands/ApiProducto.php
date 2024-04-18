<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;
use DB;
use DateTime;
use App\Traits\SapInfApiTraits;
class ApiProducto extends Command
{    
    use SapInfApiTraits;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:productonuevo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Api Producto Nuevo';

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
        /************************FECHAS PARA CONSULTAR******************************/
        $fechaactual    =   date('d-m-Y H:i:s');
        /****************************************************************************/
        $this->actionEnviarProductoTrait($fechaactual);
        $this->actionEnviarArticuloTrait($fechaactual);
        $this->actionEnviarRecetaTrait($fechaactual);
        $this->actionEnviarPropiedadTrait($fechaactual);

    }
}
