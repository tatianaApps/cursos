<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\VideosController;

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

Route::prefix('usuarios')->group(function(){
	Route::put('/crear',[UsuariosController::class,'crear']);
	Route::post('/desactivar_usuario/{id}',[UsuariosController::class,'desactivar_usuario']);
	Route::post('/editar/{id}',[UsuariosController::class,'editar']);
	Route::get('/ver/{id}',[UsuariosController::class,'ver']);
	Route::put('/adquirirCursos/{id}/{id_curso}',[UsuariosController::class,'adquirirCursos']);
	Route::get('/verCursosAdquiridos/{id}',[UsuariosController::class,'verCursosAdquiridos']);
});

Route::prefix('cursos')->group(function(){
	Route::put('/crear',[CursosController::class,'crear']);
	Route::post('/editar/{id}',[CursosController::class,'editar']);
	Route::get('/listar',[CursosController::class,'listar']);
	Route::get('/ver/{id}',[CursosController::class,'ver']);
});

Route::prefix('videos')->group(function(){
	Route::put('/crear',[VideosController::class,'crear']);
	Route::post('/desactivar_usuario/{id}',[VideosController::class,'desactivar_usuario']);
	Route::post('/editar/{id}',[VideosController::class,'editar']);
	Route::get('/listar',[VideosController::class,'listar']);
	Route::get('/ver/{id}',[VideosController::class,'ver']);
});