<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
Route::get('/', [ApiController::class, 'index']);
Route::get('/home', [ApiController::class, 'home']);
Route::get('/getwisata', [ApiController::class, 'apigetWisata']);
Route::post('/login', [ApiController::class, 'apiLogin']);
Route::get('/logout', [ApiController::class, 'apiLogout']);
