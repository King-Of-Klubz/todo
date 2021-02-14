<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/



/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

    Route::get('tasks/create')->name('tasks.create')->uses('TasksController@create')->middleware('auth');
    Route::post('tasks')->name('tasks.store')->uses('TasksController@store')->middleware('auth');
    Route::get('tasks/{task}/edit')->name('tasks.edit')->uses('TasksController@edit')->middleware('auth');

    Route::put('tasks/{task}')->name('tasks.update')->uses('TasksController@update')->middleware('auth');
    Route::delete('tasks/{task}')->name('tasks.destroy')->uses('TasksController@destroy')->middleware('auth');
    Route::put('tasks/{task}/restore')->name('tasks.restore')->uses('TasksController@restore')->middleware('auth');
 */
Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/', [\App\Http\Controllers\TasksController::class, 'index'])->name('home');
        Route::get('/dashboard', [\App\Http\Controllers\TasksController::class, 'index'])->name('dashboard');
        Route::get('tasks/{task}/edit', [\App\Http\Controllers\TasksController::class, 'edit'])->name('tasks.edit');
        Route::get('tasks/create', [\App\Http\Controllers\TasksController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [\App\Http\Controllers\TasksController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/{task}', [\App\Http\Controllers\TasksController::class, 'show'])->name('tasks.show');
        Route::put('/tasks/{task}', [\App\Http\Controllers\TasksController::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/{task}', [\App\Http\Controllers\TasksController::class, 'destroy'])->name('tasks.destroy');
        Route::get('appointments',[\App\Http\Controllers\AppointmentsController::class,'index'])->name('appointments');


    });
});
