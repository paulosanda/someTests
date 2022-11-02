<?php

use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyLogsController;


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

Route::post('teste', function () {
    return response()->json(['teste'], 200);
})->name('teste');

Route::post('daily-logs-store', [DailyLogsController::class, 'store'])
    ->middleware('blokjanedoe')
    ->name('daily-logs.store');

Route::put('daily-logs-update/{id}', [DailyLogsController::class, 'update'])->name('daily-logs.update');

Route::delete('daily-logs-delete/{id}', [DailyLogsController::class, 'destroy'])
    ->name('daily-logs.delete');
