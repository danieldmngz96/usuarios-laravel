<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsuariosController;
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

Route::prefix('v1/user')->group(function () {
    Route::get('/all',[ UsuariosController::class, 'get']);
    Route::post('/',[ UsuariosController::class, 'create']); 
    Route::get('/{id}',[ UsuariosController::class, 'getById']);
    Route::put('/{id}',[ UsuariosController::class, 'update']);
    Route::delete('/{id}',[ UsuariosController::class, 'delete']);
});