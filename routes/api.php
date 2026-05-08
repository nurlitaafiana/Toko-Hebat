<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllerWrong;
use App\Http\Controllers\AuthControllerFix;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/wrong/admin/{id}', function ($id) {
    return response()->json([
        'message' => 'Data admin berhasil diakses',
        'admin_id' => $id
    ]);

});

Route::prefix('wrong')->group(function () { //prefix digunakan untuk mengelompokkan route login dan register
    Route::post('/register', [AuthControllerWrong::class, 'register']);
    Route::post('/login', [AuthControllerWrong::class, 'login']);
});

Route::middleware(['auth:sanctum', 'admin'])->get('/fix/admin', function () {
    return response()->json([
        'message' => 'Selamat datang admin'
    ]);
});

Route::prefix('fix')->group(function () { //prefix digunakan untuk mengelompokkan route login dan register
    Route::post('/register', [AuthControllerFix::class, 'register']);
    Route::post('/login', [AuthControllerFix::class, 'login']);
});