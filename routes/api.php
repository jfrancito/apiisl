<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/reniec-buscar-dni/{dni}', 'DocumentoApiController@actionBuscarDni');

Route::get('/lista-viaje-dni-fechas/{dni}/{fechainicio}/{fechafin}', 'DocumentoApiController@actionListadoViaje01')->middleware('basicAuth');
Route::get('/lista-viaje-fechas/{fechainicio}/{fechafin}', 'DocumentoApiController@actionListadoViaje02')->middleware('basicAuth');
Route::get('/lista-direcciones-xruc/{ruc}', 'DocumentoApiController@actionListadoDirecciones')->middleware('basicAuth');

Route::post('/registro-error-guia', 'DocumentoApiController@actionRegistroErrorGuia')->middleware('basicAuth');

Route::post('/registro-guia-greta', 'DocumentoApiController@actionRegistroGuiaGreta')->middleware('basicAuth');

Route::post('/prueba-api/{dni}', 'ApiTelemetriaController@actionPruebaApi')->middleware('clienteTelAuth');
Route::post('/registro-datos-gps', 'ApiTelemetriaController@actionRegistroDatosGpsTrackLog')->middleware('clienteTelAuth');
Route::post('/registro-datos-gps-masivo', 'ApiTelemetriaController@actionRegistroDatosGpsTrackLogMasivo')->middleware('clienteTelAuth');
Route::post('/registro-datos-gps-live', 'ApiTelemetriaController@actionRegistroDatosGpsTrackLogLive')->middleware('clienteTelAuth');


