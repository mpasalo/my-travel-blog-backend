<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostsController::class, 'index']);
Route::get('posts/{post}', [PostsController::class, 'show'])->middleware('auth:sanctum');
Route::post('posts', [PostsController::class, 'store'])->middleware('auth:sanctum');
Route::put('posts/{post}', [PostsController::class, 'update'])->middleware('auth:sanctum');
Route::delete('posts/{post}', [PostsController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('user/create', [UserController::class, 'create']);

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:sanctum');