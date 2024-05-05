<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\ProfesoresMateriasController;
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
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->middleware('auth'); // Aplicar el middleware 'auth' aquí

Auth::routes();

Route::resource('/alumnos', AlumnosController::class)->middleware('auth'); // Aplicar el middleware 'auth' aquí
Route::get('/buscar-alumnos', 'App\Http\Controllers\AlumnosController@buscar')->name('buscar-alumnos')->middleware('auth'); // Aplicar el middleware 'auth' aquí

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth'); // Aplicar el middleware 'auth' aquí
Route::resource('/profesores', ProfesorController::class)->middleware('auth');
Route::resource('/materias', MateriaController::class)->middleware('auth');
Route::resource('/aulas', SalonController::class)->middleware('auth');
Route::resource('/asignarMateria', ProfesoresMateriasController::class)->middleware('auth');
