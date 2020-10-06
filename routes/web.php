<?php

use Illuminate\Routing\Router;
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



//Auth::routes();

//login routes
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login'); //   -> /login
Route::post('login', 'Auth\LoginController@login')->name('login-ingreso');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Register routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['permission:Editar datos']], function () {
    //editar datos users
    Route::resource('datos-user', 'UsersController');
});

Route::group(['middleware' => ['permission:Crear Rol']], function () {

    //HomeController
    Route::get('/creaRol', 'HomeController@index')->name('crearRol');
    Route::post('/creaRol.store', 'HomeController@store')->name('creaRol.store');
    Route::put('/UpdateRol/{id}', 'HomeController@UpdateRol')->name('UpdateRol');
    Route::get('/editRol/{id}', 'HomeController@editRol')->name('editRol');
    Route::delete('/eliminar-Rol/{id}', 'HomeController@eliminarRol')->name('eliminar-Rol');


    Route::post('/cambiarRolUser', 'HomeController@cambiarRolUser')->name('cambiarRolUser');
});

Route::group(['middleware' => ['permission:Asignar Rol']], function () {

    Route::get('/asignarRolUser', 'HomeController@asignarRolUser')->name('asignarRolUser');
    Route::get('/asignarRolUserEdit', 'HomeController@asignarRolUserEdit')->name('asignarRolUserEdit');
});
//mostrar medicos
Route::get('medicos-perfil', 'MedicosController@medicos_perfil')->name('medicos-perfil');   //ver medico perfil

Route::group(['middleware' => ['permission:Asunto cita']], function () {
    //motivo cita 
    Route::resource('/Asunto-cita', 'MotivoCitaController');
});

Route::group(['middleware' => ['permission:Agendar Cita']], function () {

    Route::get('/medico/{idmedico}/{day}', 'MedicosController@show')->name('medico.show'); //indispensable para citas
    Route::resource('/cita', 'CitaController');

    //hora
    Route::get('horas/{fechaDia}/{idMedico}', 'HoraController@show')->name('horas.show'); //indispensable para citas
});


Route::group(['middleware' => ['permission:Crear Usuarios']], function () {
    // vista crear usuario 
    Route::get('/crear-usuario', 'HomeController@vistaCrearUsuario')->name('vistaCrearUsuario');
});


Route::group(['middleware' => ['permission:Crear agenda']], function () {
    //turno
    Route::resource('turno', 'TurnoController');
});

Route::group(['middleware' => ['permission:Consultorios']], function () {
    //crud consultorios
    Route::get('consultorios', 'ConsultariosController@index')->name('consultorios');
    Route::get('consultorio/{id}/edit', 'ConsultariosController@edit')->name('consultorio.edit');
    Route::post('consultorio', 'ConsultariosController@store')->name('consultorio');
    Route::delete('consultorio-eliminar/{id}', 'ConsultariosController@destroy')->name('consultorio-eliminar');
    Route::put('consultorio-update/{id}', 'ConsultariosController@update')->name('consultorio-update');
});

Route::group(['middleware' => ['permission:Ver citas y filtrar']], function () {
    //filtro citas agendadas
    Route::get('citas-agendadas', 'FiltroCitasController@index')->name('citas-agendadas');
    Route::get('citas-filtro/mostrar', 'FiltroCitasController@show')->name('citas-filtro/mostrar');
});
