<?php

use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\GestionController;
use  App\Mail\ResetPasswordNotify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TwoFactorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//RUTAS DE LOGIN, LOGOUT, PRIVADO Y REDIRECCIÓN SI NO ESTA AUTENTIFICADOS
Route::controller(AuthController::class)->group(function(){
    Route::get('/login','login')->name('login'); //Devolvemos vista de Login
    Route::post('/login','loginStore')->name('loginStore'); //Validamos datos del formulario contra la BD 
    Route::get('/index', 'index')->name('index'); //evolvemos vista privada
    Route::post('/logout','logout')->middleware('auth')->name('logout'); //Cerramos sesion
});

//RUTAS 2FA VIA EMAIL
Route::controller(TwoFactorController::class)->group(function(){
    Route::get('/twofactor', 'twoFactor')->name('twofactor');
    Route::post('/twofactor', 'twoFactorStore')->name('twofactorstore');
});

//RUTAS RECUPERACION DE CONTRASEÑA VIA CORREO
Route::controller(ForgetPasswordController::class)->group(function(){
    Route::get('/auth/forgetPassword', 'forgetPassword')->name('forgetPassword'); //Formulario de recuperacion de contraseña
    Route::post('/auth/forgetPassword', 'forgetPasswordStore')->name('forgetPasswordStore'); //Enviamos el formulario a la BD validando datos
    Route::get('/auth/newPassword/{token}', 'passwordReset')->name('passwordReset'); //Formulario de modificacio de contraseña
    Route::post('/auth/newPassword', 'passwordResetStore')->name('passwordResetStore'); //Formulario de modificacio de contraseña
});
//RUTAS GESTION USUARIOS Y AÑADIR USUARIOS
Route::controller(GestionController::class)->group(function(){
    Route::get('gestion/usuarios', 'gestionUsuarios')->name('gestionUsuarios'); //Devolvemos vista de Gestion de usuarios
    Route::post('gestion/usuarios', 'usuarios')->name('gestionUsuarios');
    Route::get('gestion/creacionUsuarios', 'creacionUsuarios')->name('creacionUsuarios');
    Route::post('gestion/creacionUsuarios', 'creacionUsuariosStore')->name('creacionUsuariosStore');
});







