<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();

//login routes
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login'); //   -> /login
Route::post('login', 'Auth\LoginController@login')->name('login-ingreso');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Register routes
Route::get('registro', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registroForm', 'Auth\RegisterController@register')->name('registroForm');

//password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['permission:Editar datos']], function () {
    //editar datos users
    Route::get('/datos-usuario', 'UsersController@index')->name('datos-usuario');
    Route::get('/datos-usuario/foto', 'UsersController@foto')->name('datos-usuario.foto');
    Route::get('/datos-usuario/cambiarPassword', 'UsersController@cambiarPassword')->name('datos-usuario.cambiar-password');
    Route::post('/datos-usuario/cambiarPassword', 'UsersController@cambiarPasswordResult')->name('datos-usuario.cambiar-password');
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

    //busco medico por id del motivo de cita
    Route::get('cita/mostrarMedicosEvento/{id_motivoCita}', 'MedicosController@mostrarMedicosEvento');

    Route::get('/medico/{idmedico}/{day}', 'MedicosController@show')->name('medico.show'); //indispensable para mostrar
    
    Route::resource('/cita', 'CitaController'); //modificar esto a rutas
    Route::get('/cita/buscamosTurnos/{dia}/{idMedico}', 'CitaController@buscamosTurnos');
    Route::get('/cita/buscarCitaMedico/{idMedico}/{fechaCita}', 'CitaController@buscarCitaMedico');

    //buscamos consultario en base a la hora
    Route::get('cita/buscar/consultorio/{id_medico}/{hora_inicio}/{dia_turno}', 'ConsultariosController@buscarConsultorioPorHora')->name('cita/buscar/consultorio');

    //hora
    Route::get('horas/{fechaDia}/{idMedico}', 'HoraController@show')->name('horas.show'); //indispensable para citas

    //eps
    Route::get('eps/{idtipo}', 'EpsController@mostrarEps')->name('eps.mostrarEps');
    Route::get('eps/update/{idEps}', 'EpsController@mostrarEpsUpdate')->name('eps.mostrarEps.Update');
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
    /*filtro citas agendadas*/
    Route::get('citas-agendadas', 'FiltroCitasController@index')->name('citas-agendadas');
    Route::post('citas-filtro/mostrar', 'FiltroCitasController@show')->name('citas-filtro/mostrar'); //->muestra eventos

    /*asistencia  citas*/
    Route::delete('citas-filtro/mostrar/asistio/{idCita}', 'FiltroCitasController@asistioCita');
    Route::delete('citas-filtro/mostrar/noAsistio/{idCita}', 'FiltroCitasController@destroy');
    //eps
    Route::get('citas-filtro/mostrar/eps/{id}', 'EpsController@mostrarEpsOne')->name('citas-filtro/mostrar/eps');
});

Route::get('ubicacion-geografica', function () {
    $menu = 'ubicacion';
    return view('ubicaciongeografica.ubicacion', compact('menu'));
})->name('ubicacion-geografica');
