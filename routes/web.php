<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorUsuario;
use App\Http\Controllers\ControladorPanel;



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
    return view('welcome');
});

Route::name('login')->get('/login',[ControladorLogin::class, 'login']);
Route::name('login_aceptar')->post('/login_aceptar',[ControladorLogin::class, 'login_aceptar']);
Route::name('login_alta')->get('/login_alta',[ControladorLogin::class, 'login_alta']);
Route::name('login_registrar')->post('/login_registrar',[ControladorLogin::class, 'login_registrar']);
Route::name('logados')->get('/logados',[ControladorLogin::class, 'logados']);
Route::name('logout')->post('/logout',[ControladorLogin::class, 'logout']);

Route::name('home_user')->get('/home_user',[ControladorUsuario::class, 'home_user'])->middleware('auth');

Route::name('panel_admin')->get('/panel_admin',[ControladorPanel::class, 'panel_admin'])->middleware('auth');
