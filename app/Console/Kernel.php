<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use App\Console\Commands\ApiProducto;
// use App\Console\Commands\CrearPdfSap;
// use App\Console\Commands\LogErrores;
use App\Console\Commands\CmdEnvioViajesTrackLog;


class Kernel extends ConsoleKernel {
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
            // ApiProducto::class,
            // CrearPdfSap::class,
            // LogErrores::class   
            CmdEnvioViajesTrackLog::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        /************************PRODUCTO*************************/
        //enviar a inforest productos
        // $schedule->command('api:productonuevo')->everyMinute();//ACTIVAR

        // /*******************GENERR PDF*****************/
        // $schedule->command('crear:pdf')->everyMinute();//ACTIVAR

        // /*******************ENVIAR LOG MENSAJE*****************/
        //  $schedule->command('log:error')->dailyAt('15:00');
        //  $schedule->command('log:error')->dailyAt('09:00');
        // //$schedule->command('log:error')->everyMinute();//ACTIVAR
        
        // //$schedule->command('log:error')->everyMinute();//ACTIVAR


    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands() {
        require base_path('routes/console.php');
    }
}
