<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorUsuario;
use App\Http\Controllers\ControladorPanel;
use App\Http\Controllers\ControladorPacientes;
use App\Http\Controllers\ControladorMedicos;
use App\Http\Controllers\ControladorProductos;



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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::name('login')->get('/login', [ControladorLogin::class, 'login']);
Route::name('login_aceptar')->post('/login_aceptar', [ControladorLogin::class, 'login_aceptar']);
Route::name('login_alta')->get('/login_alta', [ControladorLogin::class, 'login_alta']);
Route::name('login_registrar')->post('/login_registrar', [ControladorLogin::class, 'login_registrar']);
Route::name('logados')->get('/logados', [ControladorLogin::class, 'logados']);
Route::name('logout')->post('/logout', [ControladorLogin::class, 'logout']);

Route::name('home_user')->get('/home_user', [ControladorUsuario::class, 'home_user']);
Route::name('panel_admin')->get('/panel_admin', [ControladorPanel::class, 'panel_admin']);


// Rutas agregadas para las gráficas
//Route::name('user_tabla')->get('/user_tabla', [ControladorUsuario::class, 'user_tabla'])->middleware('auth');
//Route::name('user_graficas')->get('/user_graficas', [ControladorUsuario::class, 'user_graficas'])->middleware('auth');
//Route::name('medico')->get('/medico', [ControladorUsuario::class, 'medico'])->middleware('auth');


//-----------------------------Rutas_pacientes-------------------------------------------------------------------
Route::name('pacientes')->get('/pacientes',[ControladorPacientes::class, 'pacientes']);
Route::name('paciente_alta')->get('/paciente_alta', [ControladorPacientes::class, 'paciente_alta']);
Route::name('paciente_registrar')->post('/paciente_registrar', [ControladorPacientes::class, 'paciente_registrar']);

Route::name('paciente_detalle')->get('/paciente_detalle/{id}', [ControladorPacientes::class, 'paciente_detalle']);
Route::name('paciente_actualizar')->get('/paciente_actualizar/{id}', [ControladorPacientes::class, 'paciente_actualizar']);
Route::name('paciente_salvar')->post('/paciente_salvar/{id}', [ControladorPacientes::class, 'paciente_salvar']);
Route::name('paciente_borrar')->get('/paciente_borrar/{id}', [ControladorPacientes::class, 'paciente_borrar']);

//------------------------Exportacion e Importación excel--------------------------------------------------------------------------
Route::post('/pacientes/import', [ControladorPacientes::class, 'import'])->name('import.pacientes');
Route::get('/export-pacientes', [ControladorPacientes::class, 'export'])->name('export-pacientes');


//-----------------------------Rutas_medicos--------------------------------------------------------------------
Route::name('medicos')->get('/medicos',[ControladorMedicos::class, 'medicos']);
Route::name('medico_alta')->get('/medico_alta', [ControladorMedicos::class, 'medico_alta']);
Route::name('medico_registrar')->post('/medico_registrar', [ControladorMedicos::class, 'medico_registrar']);

Route::name('medico_detalle')->get('/medico_detalle/{id}', [ControladorMedicos::class, 'medico_detalle']);
Route::name('medico_actualizar')->get('/medico_actualizar/{id}', [ControladorMedicos::class, 'medico_actualizar']);
Route::name('medico_salvar')->post('/medico_salvar/{id}', [ControladorMedicos::class, 'medico_salvar']);
Route::name('medico_borrar')->get('/medico_borrar/{id}', [ControladorMedicos::class, 'medico_borrar']);

//------------------------Exportacion e Importación excel--------------------------------------------------------------------------
Route::post('/medicos/import', [ControladorMedicos::class, 'import'])->name('import.medicos');
Route::get('/export-medicos', [ControladorMedicos::class, 'export'])->name('export-medicos');

//-----------------------------Rutas_productos--------------------------------------------------------------------
Route::name('productos')->get('/productos',[ControladorProductos::class, 'productos']);
Route::name('producto_alta')->get('/producto_alta', [ControladorProductos::class, 'producto_alta']);
Route::name('producto_registrar')->post('/producto_registrar', [ControladorProductos::class, 'producto_registrar']);

Route::name('producto_detalle')->get('/producto_detalle/{id}', [ControladorProductos::class, 'producto_detalle']);
Route::name('producto_actualizar')->get('/producto_actualizar/{id}', [ControladorProductos::class, 'producto_actualizar']);
Route::name('producto_salvar')->post('/producto_salvar/{id}', [ControladorProductos::class, 'producto_salvar']);
Route::name('producto_borrar')->get('/producto_borrar/{id}', [ControladorProductos::class, 'producto_borrar']);