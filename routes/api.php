<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'produtos'], function() {
    Route::get('', [ProdutoController::class, 'index']);
    Route::post('', [ProdutoController::class, 'store']);
    Route::get('{id}/item', [ProdutoController::class, 'item'])->whereNumber('id');
    Route::put('{id}/update', [ProdutoController::class, 'update'])->whereNumber('id');
    Route::delete('{id}/delete', [ProdutoController::class, 'delete'])->whereNumber('id');
});