<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ComunidadController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MedidasController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\UmProduccionController;
use App\Http\Controllers\Admin\UmTerrenoController;
use App\Models\Comunidad;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::resource('registro', HomeController::class)->names('registro');
Route::resource('inicio', AdminController::class)->names('inicio');
Route::resource('municipio', MunicipioController::class)->names('municipio');
Route::resource('comunidad', ComunidadController::class)->names('comunidad');
Route::resource('medidas', MedidasController::class)->names('medidas');
Route::resource('um_terreno', UmTerrenoController::class)->names('um_terreno');
Route::resource('um_produccion', UmProduccionController::class)->names('um_produccion');
Route::resource('categoria', CategoriaController::class)->names('categoria');
Route::resource('productos', ProductoController::class)->names('productos');

Route::post('importRegistros', [HomeController::class, 'importRegister'])->name('importRegister');

Route::put('buscarx', [HomeController::class, 'buscarPor'])->name('buscarx');
Route::put('filtrarcomunidades',[HomeController::class,'filtraComunidades'])->name('filtrarcomunidades');