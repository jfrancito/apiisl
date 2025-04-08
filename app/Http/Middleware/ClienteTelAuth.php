<?php

namespace App\Http\Middleware;

use Closure;

class ClienteTelAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {

        $AUTH_USER = 'TRACKLOG';
        $AUTH_PASS = 'TRACKLOG042025';
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

        $is_not_authenticated = (
            !$has_supplied_credentials ||
            $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
        );

        if ($is_not_authenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');

            $array_respuesta    =   array(
                "codigo"                    => '0000',
                "mensaje"                   => 'Acceso Denegado'
            );


            $responsecode = 401;
            $header = array (
                'Content-Type'  => 'application/json; charset=UTF-8',
                'charset'       => 'utf-8'
            );

            return response()->json($array_respuesta, $responsecode, $header, JSON_UNESCAPED_UNICODE);

            // return response([

            // ], 401, ['WWW-Authenticate' => 'Basic']);
            exit;
        }
        return $next($request);


    }
}
