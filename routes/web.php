<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/home', [TodoController::class, 'home'])->name('home');
    Route::get('todos/{id}', [TodoController::class, 'show'])->name('todo.show');
    Route::post('todos', [TodoController::class, 'store'])->name('todo.store');
    Route::put('todos/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('todos/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::get('/burndown', [TodoController::class, 'burndown'])->name('burndown');
});


