<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ProfileController;
Route::get('/profile/{nama}/{kelas}/{npm}', 
[ProfileController::class, 'profile']); 

use App\Http\Controllers\UserController; // Import UserController

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/show/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/profile/{id}', [UserController::class, 'show'])->name('user.profile');
