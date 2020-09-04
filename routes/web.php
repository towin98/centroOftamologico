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




//routes middleware
Route::group(['middleware' => ['permission:view|edit|delete|create']], function () {

    Route::resource('/cita', 'CitaController');

    //HomeController
    Route::get('/creaRol', 'HomeController@index')->name('crearRol');
    Route::post('/creaRol.store', 'HomeController@store')->name('creaRol.store');
    Route::put('/UpdateRol/{id}', 'HomeController@UpdateRol')->name('UpdateRol');
    Route::get('/editRol/{id}', 'HomeController@editRol')->name('editRol');
    Route::delete('/eliminar-Rol/{id}', 'HomeController@eliminarRol')->name('eliminar-Rol');

    Route::get('/asignarRolUser', 'HomeController@asignarRolUser')->name('asignarRolUser');
    Route::get('/asignarRolUserEdit', 'HomeController@asignarRolUserEdit')->name('asignarRolUserEdit');
    Route::post('/cambiarRolUser', 'HomeController@cambiarRolUser')->name('cambiarRolUser');

    //medico crud
    Route::get('medicos-perfil', 'MedicosController@medicos_perfil')->name('medicos-perfil');   //ver medico perfil
    Route::get('medicos-registro', 'MedicosController@medicos_registro')->name('medicos-registro');   //registrar medico
    Route::get('/medico/{idmedico}/{day}', 'MedicosController@show')->name('medico.show'); //indispensable para citas

    //editar datos users
    Route::resource('datos-user', 'UsersController');

    //turno
    Route::resource('turno', 'TurnoController');
});
