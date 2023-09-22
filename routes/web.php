<?php

use Illuminate\Support\Facades\Route;

// se hace referencia a la Clase de los Controladores
use App\Http\Controllers\PersonasController;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

// Creacion de la Ruta para Acceso a las Vistas de Personas
//Route::get('/personas', function () {
//    return view('personas.index');
//});

// se crea la ruta para acceder por el Controlador
//Route::get('/personas/create',[PersonasController::class,'create']);

// para acceder a todas las URL y los Metodos del Controlador
//route::resource('personas',PersonasController::class);
route::resource('personas',PersonasController::class)->middleware('auth');
   
Auth::routes();

//Route::get('/home', [App\Http\Controllers\PersonasController::class, 'index'])->name('home');
//Route::get('/home', [PersonasController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    //Route::get('/', [App\Http\Controllers\PersonasController::class, 'index'])->name('home');
    Route::get('/', [PersonasController::class, 'index'])->name('home');
});


