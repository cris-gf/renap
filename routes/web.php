<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PersonController;
use App\Http\Controllers\Backend\RequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//En página principal redirigir a formulario
Route::get('/', function ()
{
    return redirect('/public/create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas para formulario
Route::resource('/public', PersonController::class);
//Rutas para administador
Route::resource('/admin', RequestController::class)->middleware('auth'); //Autenticación necesaria
//Editar url en el navegador
Route::redirect('/public', '/public/create');
//Iniciar sesión
Route::redirect('/home', '/admin');