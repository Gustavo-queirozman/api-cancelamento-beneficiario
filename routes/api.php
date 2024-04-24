<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cancelamento\CriarController;
use App\Http\Controllers\Solicitacao\Beneficiario\ListarController;
use App\Http\Controllers\Usuario\DeleteController;
use App\Http\Controllers\Usuario\EditarController;
use App\Http\Controllers\Usuario\ListarController as UsuarioListarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot', [AuthController::class, 'forgot']);
Route::post('reset', [AuthController::class, 'reset']);



Route::middleware('auth:api')->group(function () {
    Route::get('usuarios', UsuarioListarController::class);
    Route::post('usuario/{id}', EditarController::class);
    Route::delete('usuario/{id}', DeleteController::class);


    Route::get('solicitar-cancelamento', ListarController::class);
    Route::post('fazer-cancelamento', CriarController::class);
});
