<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUD;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/registrar', [CRUD::class, 'create'])->name('registrar');
Route::post('/editar', [CRUD::class, 'update'])->name('editar');
Route::get('/eliminar{id}', [CRUD::class, 'delete'])->name('eliminar');