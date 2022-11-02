<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(InvitationController::class)
    ->prefix('invitations')
    ->as('invitations.')
    ->group(function () {
        Route::post('/invite', 'invite')->name('store');
        Route::post('/accept/{invitation:code}', 'acceptInvite')->name('accept');
    });
