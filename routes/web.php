<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
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

Route::get('/',[TaskController::class,'index'])->name('main');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/tasks/completed', [TaskController::class,'completed'])->name('tasks.completedView');
    Route::resource('tasks',TaskController::class);
    Route::resource('tags',TagController::class);
    Route::patch('/tasks/{task}/completed', [TaskController::class,'markAsCompleted'])->name('tasks.completed');


});
Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[UserController::class,'loginForm'])->name('loginForm');
    Route::get('/register',[UserController::class,'registerForm'])->name('registerForm');
    Route::post('/register',[UserController::class,'register'])->name('register');
    Route::post('/login',[UserController::class,'login'])->name('login');
});
