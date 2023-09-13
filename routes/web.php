<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ShowPosts;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Usando a livewire como controlador
    // Route::get('/dashboard', ShowPosts::class)->name('dashboard');
});

// Enviar parámetro
// Route::get('/parametro/{name}', ShowPosts::class);