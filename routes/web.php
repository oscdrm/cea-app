<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){

    return view('auth/login');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Middlaware solo admin
Route::middleware(['auth', 'admin'])->group(function () {
    
    //Rutas para tipo de inscripcion
    Route::get('/tipoInscripcion', 'TipoInscripcionController@index'); //Listado
    Route::get('/tipoInscripcion/create', 'TipoInscripcionController@create'); //Crear
    Route::post('/tipoInscripcion', 'TipoInscripcionController@store'); //Guardar 
    Route::get('/tipoInscripcion/edit/{id}', 'TipoInscripcionController@edit'); //Editar
    Route::post('/tipoInscripcion/edit/{id}', 'TipoInscripcionController@update'); //actualizar
    Route::delete('/tipoInscripcion/{id}', 'TipoInscripcionController@delete'); //Eliminar

    //Rutas para modalidad
    Route::get('/modalidad', 'ModalidadController@index'); //Listado
    Route::get('/modalidad/create', 'ModalidadController@create'); //Crear
    Route::post('/modalidad', 'ModalidadController@store'); //Guardar 
    Route::get('/modalidad/edit/{id}', 'ModalidadController@edit'); //Editar
    Route::post('/modalidad/edit/{id}', 'ModalidadController@update'); //actualizar
    Route::delete('/modalidad/{id}', 'ModalidadController@delete'); //Eliminar

    //Rutas para carreras
    Route::get('/carrera', 'CarreraController@index'); //Listado
    Route::get('/carrera/create', 'CarreraController@create'); //Crear
    Route::post('/carrera', 'CarreraController@store'); //Guardar 
    Route::get('/carrera/edit/{id}', 'CarreraController@edit'); //Editar
    Route::post('/carrera/edit/{id}', 'CarreraController@update'); //actualizar
    Route::delete('/carrera/{id}', 'CarreraController@delete'); //Eliminar

    //Rutas para carreras
    Route::get('/concepto', 'ConceptoController@index'); //Listado
    Route::get('/concepto/create', 'ConceptoController@create'); //Crear
    Route::post('/concepto', 'ConceptoController@store'); //Guardar 
    Route::get('/concepto/edit/{id}', 'ConceptoController@edit'); //Editar
    Route::post('/concepto/edit/{id}', 'ConceptoController@update'); //actualizar
    Route::delete('/concepto/{id}', 'ConceptoController@delete'); //Eliminar

    //Rutas para Alumnos
    Route::delete('/alumno/{id}', 'AlumnosController@delete'); //Eliminar

    //Rutas para MOvimientos Caja
    Route::get('/movimientos/edit/{id}', 'MovimientosCajaController@edit'); //Editar
    Route::post('/movimientos/edit/{id}', 'MovimientosCajaController@update'); //actualizar
    Route::delete('/movimientos/{id}', 'MovimientosCajaController@delete'); //Eliminar

    //Rutas para corte
    Route::get('/corteCaja', 'CorteCajaController@index'); 
    Route::post('/corteCaja/calcular', 'CorteCajaController@calcular');

    //Rutas para cajeros
    Route::get('/users/{role}/index', 'UsersController@index'); //Listado
    Route::get('/users/{role}/create', 'UsersController@create'); //Crear
    Route::post('users/{role}/', 'UsersController@store'); //Guardar 
    Route::get('users/{role}/{id}/edit', 'UsersController@edit'); //Editar
    Route::post('users/{id}/edit', 'UsersController@update'); //actualizar
    Route::delete('users/{id}', 'UsersController@delete'); //Eliminar

});

//Middlaware para ADMIN y CAJERO
Route::middleware(['auth', 'cashier'])->group(function () {
    //RUTAS PARA Alumnos
    Route::get('/alumno', 'AlumnosController@index'); //Listado
    Route::get('/alumno/create', 'AlumnosController@create'); //Crear
    Route::post('/alumno', 'AlumnosController@store'); //Guardar 
    Route::get('/alumno/edit/{id}', 'AlumnosController@edit'); //Editar
    Route::post('/alumno/edit/{id}', 'AlumnosController@update'); //actualizar

    //Rutas para MOvimientos Caja
    Route::get('/movimientos', 'MovimientosCajaController@index'); //Listado
    Route::get('/movimientos/create', 'MovimientosCajaController@create'); //Crear
    Route::post('/movimientos', 'MovimientosCajaController@store'); //Guardar 

    //Rutas para Adeudos
    Route::get('/adeudos', 'AdeudosController@index'); //Listado
    Route::get('/adeudos/create', 'AdeudosController@create'); //Crear
    Route::post('/adeudos', 'AdeudosController@store'); //Guardar 
    Route::get('/adeudos/edit/{id}', 'AdeudosController@edit'); //Editar
    Route::post('/adeudos/edit/{id}', 'AdeudosController@update'); //actualizar
    Route::delete('/adeudos/{id}', 'AdeudosController@delete'); //Eliminar

    //RUTA PARA CAJA
    Route::get('/cashier/cash', 'HomeController@cash');

});