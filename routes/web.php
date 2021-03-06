<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TestNotification;

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
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

//Rutas E-Learning
Route::get('/elearning/', [App\Http\Controllers\ClassroomController::class, 'index'])->name('ol_home')->middleware('auth');
Route::post('/elearning/acciones/crear', [App\Http\Controllers\ClassroomController::class, 'crear'])->middleware('auth');
Route::post('/elearning/acciones/unirme', [App\Http\Controllers\ClassroomController::class, 'unirme'])->middleware('auth');
Route::get('/elearning/j/{code?}', [App\Http\Controllers\ClassroomController::class, 'unirme'])->middleware('auth');

//Rutas E-Learning, pero ya en la clase
Route::get('/elearning/c/{hash}', [App\Http\Controllers\ClassroomController::class, 'classroom'])->middleware('auth');
Route::post('/elearning/c/{hash}/config/u', [App\Http\Controllers\ClassroomController::class, 'class_u_config'])->middleware('auth');
Route::get('/elearning/c/{hash}/del', [App\Http\Controllers\ClassroomController::class, 'eliminar'])->middleware('auth');
#Tablón
Route::post('/elearning/c/{hash}/tablon/crear', [App\Http\Controllers\ClassroomController::class, 'crearanuncio'])->middleware('auth');
Route::post('/elearning/c/{hash}/tablon/comentar', [App\Http\Controllers\ClassroomController::class, 'comentaranuncio'])->middleware('auth');
Route::post('/elearning/c/{hash}/tablon/eliminar', [App\Http\Controllers\ClassroomController::class, 'eliminaranuncio'])->middleware('auth');
#Trabajo de clase
Route::get('/elearning/c/{hash}/trabajodeclase/', [App\Http\Controllers\ClassroomController::class, 'class_work'])->middleware('auth');
#Acciones trabajo de clase
Route::get('/elearning/c/{hash}/trabajodeclase/', [App\Http\Controllers\ClassroomController::class, 'class_work'])->middleware('auth');
Route::get('/elearning/c/{hash}/trabajodeclase/v/{id}', [App\Http\Controllers\ClassroomController::class, 'class_work_view'])->middleware('auth');
Route::post('/elearning/c/{hash}/trabajodeclase/v/{id}/evaluar', [App\Http\Controllers\ClassroomController::class, 'evaluar_actividad'])->middleware('auth');
Route::post('/elearning/c/{hash}/trabajodeclase/entregar', [App\Http\Controllers\ClassroomController::class, 'entregar_actividad'])->middleware('auth');
Route::post('/elearning/c/{hash}/trabajodeclase/crear', [App\Http\Controllers\ClassroomController::class, 'class_work_crear'])->middleware(['role:profesor', 'auth']);
Route::post('/elearning/c/{hash}/trabajodeclase/ord', [App\Http\Controllers\ClassroomController::class, 'class_work_save_ord'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/c/material', [App\Http\Controllers\ClassroomController::class, 'class_work_c_material'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/c/tarea', [App\Http\Controllers\ClassroomController::class, 'class_work_c_tarea'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/c/pregunta', [App\Http\Controllers\ClassroomController::class, 'class_work_c_pregunta'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/c/h5p', [App\Http\Controllers\ClassroomController::class, 'class_work_c_h5p'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/c/examen', [App\Http\Controllers\ClassroomController::class, 'class_work_c_examen'])->middleware(['role:profesor', 'auth']);
Route::post('/elearning/c/{hash}/trabajodeclase/c/tema', [App\Http\Controllers\ClassroomController::class, 'class_work_c_tema'])->middleware(['role:profesor', 'auth']);
Route::post('/elearning/c/{hash}/trabajodeclase/e/', [App\Http\Controllers\ClassroomController::class, 'class_work_u_activity'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/e/{id}', [App\Http\Controllers\ClassroomController::class, 'class_work_e_activity'])->middleware(['role:profesor', 'auth']);
Route::get('/elearning/c/{hash}/trabajodeclase/d/{id}', [App\Http\Controllers\ClassroomController::class, 'class_work_d_activity'])->middleware(['role:profesor', 'auth']);
#Compañeros de clase
Route::get('/elearning/c/{hash}/companerosdeclase/', [App\Http\Controllers\ClassroomController::class, 'class_students'])->middleware('auth');
#Alumnos
Route::get('/elearning/c/{hash}/alumnos/', [App\Http\Controllers\ClassroomController::class, 'class_students'])->middleware('auth');
Route::get('/elearning/c/{hash}/alumnos/{id}', [App\Http\Controllers\ClassroomController::class, 'class_students'])->middleware('auth');
//Rutas notificaciones
Route::get('/notificaciones/', [App\Http\Controllers\NotificacionesController::class, 'index'])->name('notificaciones_home')->middleware(['auth']);
Route::post('/notificaciones/acciones/crear', [App\Http\Controllers\NotificacionesController::class, 'crear'])->middleware(['auth']);
Route::get('/notificaciones/acciones/editar/{id}', [App\Http\Controllers\NotificacionesController::class, 'editar'])->middleware(['auth']);
Route::get('/notificaciones/acciones/eliminar/{id}', [App\Http\Controllers\NotificacionesController::class, 'eliminar'])->middleware(['auth']);
Route::post('/notificaciones/acciones/actualizar/', [App\Http\Controllers\NotificacionesController::class, 'actualizar'])->middleware(['auth']);
Route::get('/notificaciones/v/{id}', [App\Http\Controllers\NotificacionesController::class, 'leer'])->middleware(['auth']);

//Rutas Agenda
Route::get('/agenda/', [App\Http\Controllers\AgendapersonalController::class, 'index'])->name('agenda_home')->middleware('auth');

//Rutas biblioteca
Route::get('/biblioteca/', [App\Http\Controllers\BibliotecaController::class, 'index'])->name('biblio_home')->middleware('auth');
Route::get('/biblioteca/misprestamos', [App\Http\Controllers\BibliotecaController::class, 'misprestamos'])->name('biblio_misprestamos')->middleware(['role:alumno','auth']);
Route::get('/biblioteca/misestadisticas', [App\Http\Controllers\BibliotecaController::class, 'misestadisticas'])->name('biblio_misestadisticas')->middleware(['role:alumno','auth']);
Route::get('/biblioteca/misvaloraciones', [App\Http\Controllers\BibliotecaController::class, 'misvaloraciones'])->name('biblio_misvaloraciones')->middleware(['role:alumno','auth']);
Route::get('/biblioteca/misdesideratas', [App\Http\Controllers\BibliotecaController::class, 'misdesideratas'])->name('biblio_misdesideratas')->middleware(['role:alumno','auth']);
Route::get('/biblioteca/prestamos', [App\Http\Controllers\BibliotecaController::class, 'prestamos'])->name('biblio_prestamos')->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/desideratas', [App\Http\Controllers\BibliotecaController::class, 'desideratas'])->name('biblio_desideratas')->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/valoraciones', [App\Http\Controllers\BibliotecaController::class, 'valoraciones'])->name('biblio_valoraciones')->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/configuracion', [App\Http\Controllers\BibliotecaController::class, 'configuracion'])->name('biblio_configuracion')->middleware(['role:bibliotecario|secretaria|vicedirector|director','auth']);
Route::post('/biblioteca/acciones/crear/', [App\Http\Controllers\BibliotecaController::class, 'crear'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/editar/{id}', [App\Http\Controllers\BibliotecaController::class, 'editar'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/eliminar/{id}', [App\Http\Controllers\BibliotecaController::class, 'eliminar'])->middleware(['role:bibliotecario', 'auth']);
Route::post('/biblioteca/acciones/actualizar/', [App\Http\Controllers\BibliotecaController::class, 'actualizar'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/prestar/{id}', [App\Http\Controllers\BibliotecaController::class, 'prestar'])->middleware(['role:bibliotecario', 'auth']);
Route::post('/biblioteca/acciones/prestamo/', [App\Http\Controllers\BibliotecaController::class, 'prestamo'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/prorroga/{id}', [App\Http\Controllers\BibliotecaController::class, 'prorrogar'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/devolver/{id}', [App\Http\Controllers\BibliotecaController::class, 'devolver'])->middleware(['role:bibliotecario', 'auth']);
Route::post('/biblioteca/acciones/borrarcatalogo/', [App\Http\Controllers\BibliotecaController::class, 'borrarcatalogo'])->middleware(['role:bibliotecario', 'auth']);
Route::post('/biblioteca/acciones/subir/abies', [App\Http\Controllers\BibliotecaController::class, 'subirabies'])->middleware(['role:bibliotecario', 'auth']);
Route::post('/biblioteca/acciones/subir/biblioweb', [App\Http\Controllers\BibliotecaController::class, 'subirbiblioweb'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/desideratas/aprobar/{id}', [App\Http\Controllers\BibliotecaController::class, 'desiderata_aprobar'])->middleware(['role:bibliotecario', 'auth']);
Route::get('/biblioteca/acciones/desideratas/rechazar/{id}', [App\Http\Controllers\BibliotecaController::class, 'desiderata_denegar'])->middleware(['role:bibliotecario', 'auth']);
Route::post('/biblioteca/acciones/consultorio/usuarios', [App\Http\Controllers\BibliotecaController::class, 'consultorio_usuarios'])->middleware(['role:bibliotecario', 'auth']);

//Rutas Admin
Route::get('/admin/configuracion', [App\Http\Controllers\AdminController::class, 'configuracion'])->name('admin_configuracion')->middleware(['role:director','auth']);

//Rutas consultorio

