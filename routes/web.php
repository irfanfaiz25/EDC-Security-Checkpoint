<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/', function () {
    return view('content.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/checkpoint', function () {
    return view('content.checkpoint');
})->name('checkpoint-data')->middleware('auth');

Route::get('/scan-office1', function () {
    return view('content.scan-office1');
})->name('scan-office1')->middleware('auth');

Route::get('/scan-office2', function () {
    return view('content.scan-office2');
})->name('scan-office2')->middleware('auth');

Route::get('/scan-dmc1', function () {
    return view('content.scan-dmc1');
})->name('scan-dmc1')->middleware('auth');

Route::get('/scan-dmc2', function () {
    return view('content.scan-dmc2');
})->name('scan-dmc2')->middleware('auth');

Route::get('/scan-outdoor', function () {
    return view('content.scan-outdoor');
})->name('scan-outdoor')->middleware('auth');

Route::get('/scan-history', function () {
    return view('content.scan-history');
})->name('scan-history')->middleware('auth');

Route::get('/message', function () {
    return view('content.message');
})->name('message')->middleware('auth');