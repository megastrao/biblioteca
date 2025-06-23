<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;

// Rota padrão redirecionando para o dashboard
Route::get('/', function () {
    return redirect('/login');
});

// Rota para o painel administrativo
Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::resource('user', UserController::class);
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('/editora', App\Http\Controllers\EditoraController::class);
    
    Route::resource('/genero', App\Http\Controllers\GeneroController::class);
    
    Route::resource('/autor', App\Http\Controllers\AutorController::class);

    Route::resource('/cliente', App\Http\Controllers\ClienteController::class);
});