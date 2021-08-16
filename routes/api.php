<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\TagController;

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

Route::apiResource('post', PostController::class)->except('show');
Route::apiResource('tag', TagController::class)->except('show');
