<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorrespondeceController;
use App\Http\Controllers\ProtocolInternalExternalController;
use App\Http\Controllers\UsersController;

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



Route::post('/register',  [UsersController::class, 'store']);
Route::post('/login',  [UsersController::class, 'login']);



Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('correspondences', CorrespondeceController::class);
    Route::get('/correspondences/{quantity?}/{orderBy?}', [ProtocolInternalExternalController::class, 'list']);


    Route::resource('protocol-internal-externals', ProtocolInternalExternalController::class);
    Route::get('/protocol-internal-externals/{quantity?}/{orderBy?}', [ProtocolInternalExternalController::class, 'list']);
});
