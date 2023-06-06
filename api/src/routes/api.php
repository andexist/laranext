<?php

use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\DataExporterController;
use App\Http\Controllers\API\V1\UserController;
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

Route::group(
    [
        'prefix' => 'v1', 
        'middleware' => 'auth:sanctum'
    ], 
    function() {
        Route::apiResource('tasks', TaskController::class);

        Route::get('authors/{user}', [AuthorController::class, 'show'])->name('authors');

        Route::get('/user', UserController::class);

       // Route::post('/export', [DataExporterController::class, 'export']);
});
