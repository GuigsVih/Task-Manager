<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\User\LoginValidation;
use App\Http\Middleware\User\RegisterValidation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', ['uses' => 'UserController@register'])
    ->middleware(RegisterValidation::class);
Route::post('/login', ['uses' => 'AuthController@login'])
    ->middleware(LoginValidation::class);
Route::post('/me', ['uses' => 'AuthController@me']);
Route::post('/logout', ['uses' => 'AuthController@logout']);
